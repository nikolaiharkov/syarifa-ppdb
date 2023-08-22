<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Siswa_model'); // Memuat model Siswa_model
    }

    public function indexOrtu()
    {
        $data['pendaftar_data'] = $this->Siswa_model->getPendaftarData(); // Mengambil data pendaftar dari model
        $this->load->view('layout/dash_header');
        $this->load->view('siswa/ortu', $data); // Mengirim data pendaftar ke view
        $this->load->view('layout/dash_footer');
    }

    public function getDetailPendaftar($idpendaftar) {
        $data['pendaftar'] = $this->Siswa_model->getPendaftarById($idpendaftar);
        echo json_encode($data['pendaftar']); // Mengembalikan data dalam format JSON
    }

    
}
