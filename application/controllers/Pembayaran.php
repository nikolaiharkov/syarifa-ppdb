<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Pembayaran_model');
        $this->load->model('Siswa_model');
    }

    public function indexPembayaran()
    {
        // Ambil idpendaftar dari session
        $idpendaftar = $this->session->userdata('idpendaftar');

        //ambil tanggal hari ini dan tambahkan library date

        $tanggal = date('Y-m-d');

        // Mengambil data siswa berdasarkan idpendaftar dari model
        $data['data_siswa'] = $this->Pembayaran_model->getSiswaByIdPendaftar($idpendaftar);
        $data['kategori_bms'] = $this->Pembayaran_model->getKategoriBMS();

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
        
            // Mendapatkan idbms dari form
            $idbms = $this->input->post('kategori_bms');
            
            // Update status pada tbl_siswa menjadi 7 dan idbms
            $updateData = array(
                'status' => 7,
                'idbms' => $idbms
            );
            $this->Siswa_model->updateStatus2($idsiswa, $updateData);
            
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

    public function updateFormulir($idsiswa, $newStatus, $diskon)
    {
        // Update status pada tbl_siswa menjadi $newStatus
        if ($this->Pembayaran_model->updateStatusSiswa($idsiswa, $newStatus)) {
            // Update diskon pada tbl_pembayaran
            if ($this->Pembayaran_model->updateDiskonPembayaran($idsiswa, $diskon)) {
                $this->session->set_flashdata('success_message', 'Status formulir dan diskon berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error_message', 'Gagal memperbarui diskon pembayaran.');
            }
        } else {
            $this->session->set_flashdata('error_message', 'Gagal memperbarui status formulir.');
        }
    
        // Redirect atau tampilkan halaman sesuai dengan kebutuhan Anda
        // Contoh: redirect('nama_controller/nama_metode');
    }
    
    



    public function indexKategoriBiaya()
    {
        $this->load->model('Pembayaran_model');
        $data['data_kategori'] = $this->Pembayaran_model->getKategoriData();
    
        $this->load->view('layout/dash_header');
        $this->load->view('pembayaran/kategoriBiaya', $data); // Kirim data kategori biaya ke view
        $this->load->view('layout/dash_footer');
    }

        public function getTotalBiaya($idsiswa) {
        // Panggil model untuk mengambil total biaya berdasarkan idsiswa
        $total_biaya = $this->Pembayaran_model->getTotalBiayaByIdsiswa($idsiswa);

        // Kirim total biaya dalam format JSON
        echo json_encode(array('total_biaya' => $total_biaya));
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

public function indexBMS()
{
    $data['data_pembayaran'] = $this->Pembayaran_model->getPembayaranData();
        
    $this->load->view('layout/dash_header');
    $this->load->view('pembayaran/adminBMS', $data); // Kirim data pembayaran ke view
    $this->load->view('layout/dash_footer');
}

public function getDataPembayaranBMS($idsiswa) {
    // Ambil data dari tbl_kategori_bms berdasarkan idbms yang sesuai dengan siswa
    $data_kategori_bms = $this->Pembayaran_model->getDataKategoriBMS($idsiswa);

    // jika diskon_bms bukan 0 berarti akan ada perkalian total_bms * 0,diskon_bms
    if ($data_kategori_bms['diskon_bms'] != 0) {
        $biaya_harus_dibayarkan = $data_kategori_bms['total_bms'] * (1 - ($data_kategori_bms['diskon_bms'] / 100));
    } else {
        $biaya_harus_dibayarkan = $data_kategori_bms['total_bms'];
    }

    // Buat array data untuk dikirim ke AJAX
    $data = array(
        'nama_bms' => $data_kategori_bms['nama_bms'],
        'detail_bms' => $data_kategori_bms['detail_bms'],
        'total_bms' => $data_kategori_bms['total_bms'],
        'biaya_harus_dibayarkan' => $biaya_harus_dibayarkan
    );

    // Mengirim data dalam format JSON
    echo json_encode($data);
}

public function uploadBuktiBayarBMS() {
    // Ambil id siswa dari form
    $idsiswa = $this->input->post('idsiswa');

    // Konfigurasi upload file
    $config['upload_path'] = './buktipembayaran/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['max_size'] = 2048; // 2MB
    $config['file_name'] = $idsiswa . '_BMS_' . rand(100, 999);

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('buktiPembayaran')) {
        // Jika upload gagal, tampilkan error
        $error = $this->upload->display_errors();
        $this->session->set_flashdata('error_message', $error);
    } else {
        // Jika upload berhasil, simpan nama file ke dalam database
        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];

        // Update bukti_bms pada tbl_pembayaran
        $updateData = array('bukti_bms' => $file_name);
        if ($this->Pembayaran_model->updatePembayaran($idsiswa, $updateData)) {
            // Update status pada tbl_siswa menjadi 8
            $updateStatus = array('status' => 8);
            $this->Pembayaran_model->updateStatusSiswa2($idsiswa, $updateStatus);

            $this->session->set_flashdata('success_message', 'Bukti pembayaran berhasil diupload.');
        } else {
            $this->session->set_flashdata('error_message', 'Gagal mengupdate bukti pembayaran.');
        }
    }

    redirect('pembayaran/indexPembayaran');
}

public function terimaSiswaBMS($idsiswa) {
    // Panggil model untuk mengubah status siswa
    $result = $this->Pembayaran_model->terimaSiswaBMS($idsiswa);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}

public function tolakSiswaBMS($idsiswa) {
    // Panggil model untuk mengubah status siswa
    $result = $this->Pembayaran_model->tolakSiswaBMS($idsiswa);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
    

}