<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Pembayaran_model');
        $this->load->model('Siswa_model'); // Load model Siswa_model
    }

    public function indexPembayaran()
    {
        // Ambil idpendaftar dari session
        $idpendaftar = $this->session->userdata('idpendaftar');

        //ambil tanggal hari ini dan tambahkan library date

        $tanggal = date('Y-m-d');

        // Mengambil data siswa berdasarkan idpendaftar dari model
        $data['data_siswa'] = $this->Pembayaran_model->getSiswaByIdPendaftar($idpendaftar);

        $this->load->view('layout/dash_header');
        $this->load->view('pembayaran/index', $data); // Mengirim data siswa ke view
        $this->load->view('layout/dash_footer');
    }

    public function uploadBuktiBayarFormulir() {
        $idsiswa = $this->input->post('idsiswa');
        $idpendaftar = $this->session->userdata('idpendaftar');
        
        // Konfigurasi upload file
        $config['upload_path'] = './buktipembayaran/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = $idsiswa . '_formulir_' . rand(100, 999);
        
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload('buktiPembayaran')) {
            // Jika upload gagal, tampilkan error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error_message', $error);
            redirect('pembayaran/indexPembayaran');
        } else {
            // Jika upload berhasil, simpan nama file ke dalam database
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            
            // Simpan nama file ke dalam tabel tbl_pembayaran
            $data = array(
                'idsiswa' => $idsiswa,
                'tgl_formulir' => date('Y-m-d'),
                'bukti_formulir' => $file_name,
                'idpendaftar' => $idpendaftar
            );
            $this->Pembayaran_model->insertPembayaran($data);
            
            // Update status pada tbl_siswa menjadi 7
            $updateData = array('status' => 7);
            $this->Siswa_model->updateStatus($idsiswa, $updateData);
            
            $this->session->set_flashdata('success_message', 'Bukti pembayaran formulir berhasil diupload.');
            redirect('pembayaran/indexPembayaran');
        }
    }

    public function indexFormulirAdmin()
    {
        $data['data_pembayaran'] = $this->Pembayaran_model->getPembayaranData();
        
        $this->load->view('layout/dash_header');
        $this->load->view('pembayaran/formulirAdmin', $data); // Kirim data pembayaran ke view
        $this->load->view('layout/dash_footer');
    }

    public function updateFormulir($idsiswa, $newStatus) {

        if ($this->Pembayaran_model->updateStatusFormulir($idsiswa, $newStatus)) {
            $this->session->set_flashdata('success_message', 'Status formulir berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error_message', 'Gagal memperbarui status formulir.');
        }

        redirect('pembayaran/indexFormulirAdmin');
    }

    public function indexKategoriBiaya()
    {
        $this->load->model('Pembayaran_model');
        $data['data_kategori'] = $this->Pembayaran_model->getKategoriData();
    
        $this->load->view('layout/dash_header');
        $this->load->view('pembayaran/kategoriBiaya', $data); // Kirim data kategori biaya ke view
        $this->load->view('layout/dash_footer');
    }
    
    
    public function TambahKategori()
    {
        // Konfigurasi aturan validasi
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('total_biaya', 'Total Biaya', 'required|numeric');
    
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_message', validation_errors());
        } else {
            $data = array(
                'nama_bms' => $this->input->post('nama_kategori'),
                'detail_bms' => $this->input->post('keterangan'),
                'total_bms' => $this->input->post('total_biaya')
            );
    
            if ($this->Pembayaran_model->insertKategori($data)) {
                $this->session->set_flashdata('success_message', 'Kategori biaya berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error_message', 'Gagal menambahkan kategori biaya.');
            }
        }
    
        redirect('pembayaran/indexKategoriBiaya');
    }

    public function getKategoriById($id)
{
    $kategori = $this->Pembayaran_model->getKategoriById($id);
    echo json_encode($kategori);
}

public function EditKategori()
{
    $id = $this->input->post('idbms');
    $data = array(
        'nama_bms' => $this->input->post('nama_kategori'),
        'detail_bms' => $this->input->post('keterangan'),
        'total_bms' => $this->input->post('total_biaya')
    );

    if ($this->Pembayaran_model->updateKategori($id, $data)) {
        $this->session->set_flashdata('success_message', 'Kategori biaya berhasil diupdate.');
    } else {
        $this->session->set_flashdata('error_message', 'Gagal mengupdate kategori biaya.');
    }

    redirect('pembayaran/indexKategoriBiaya');
}

public function hapusKategori($id)
{
    $result = $this->Pembayaran_model->hapusKategori($id);
    if ($result) {
        $this->session->set_flashdata('success_message', 'Kategori biaya berhasil dihapus.');
    } else {
        $this->session->set_flashdata('error_message', 'Gagal menghapus kategori biaya.');
    }
    
    redirect('pembayaran/indexKategoriBiaya');
}

    

}