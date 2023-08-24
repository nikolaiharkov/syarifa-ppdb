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


}