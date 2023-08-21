<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Pendaftar_model');
    }
    
    public function index()
    {
        // Ambil data pendaftar dari model
        $data['pendaftar_data'] = $this->Pendaftar_model->getPendaftarData();
    
        $this->load->view('layout/dash_header');
        $this->load->view('pendaftar/index', $data); // Kirim data pendaftar ke view
        $this->load->view('layout/dash_footer');
    }

    public function editPendaftar() {
        // Set aturan validasi untuk setiap field
        $this->form_validation->set_rules('nama_pendaftar', 'Nama Pendaftar', 'required');
        $this->form_validation->set_rules('nomor_telepon', 'Nomor Telepon', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_message', 'Gagal mengedit pendaftar. Pastikan semua kolom telah diisi dengan benar.');
        } else {
            $idpendaftar = $this->input->post('idpendaftar');
            $data = array(
                'nama_pendaftar' => $this->input->post('nama_pendaftar'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
                // Tambahkan data lainnya sesuai kebutuhan
            );

            if ($this->Pendaftar_model->update($idpendaftar, $data)) {
                $this->session->set_flashdata('success_message', 'Pendaftar berhasil diupdate.');
            } else {
                $this->session->set_flashdata('error_message', 'Gagal mengedit pendaftar. Silakan coba lagi.');
            }
        }

        redirect('pendaftar/index');
    }

    public function hapusPendaftar() {
        $this->load->model('Pendaftar_model'); // Load model Pendaftar_model

        $idpendaftar = $this->input->post('idpendaftar');

        // Hapus pendaftar berdasarkan ID
        if ($this->Pendaftar_model->deletePendaftar($idpendaftar)) {
            echo "sukses"; // Jika sukses, kirimkan pesan sukses ke ajax
        } else {
            echo "gagal"; // Jika gagal, kirimkan pesan gagal ke ajax
        }
    }
    
}
