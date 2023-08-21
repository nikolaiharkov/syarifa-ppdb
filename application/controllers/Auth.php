<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Auth_model');
    }

	public function index()
	{
		$this->load->view('layout/login_header');
		$this->load->view('login');
		$this->load->view('layout/login_footer');
	}

    public function daftarPendaftar() {
        $this->form_validation->set_rules('inputNomorTelepon', 'Nomor Telepon Pendaftar', 'required');
        $this->form_validation->set_rules('inputNamaPendaftar', 'Nama Pendaftar', 'required');
        $this->form_validation->set_rules('namaAyah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nikAyah', 'NIK Ayah', 'required');
        $this->form_validation->set_rules('tempatLahirAyah', 'Tempat Lahir Ayah', 'required');
        $this->form_validation->set_rules('tanggalLahirAyah', 'Tanggal Lahir Ayah', 'required');
        $this->form_validation->set_rules('pendidikanAyah', 'Pendidikan Terakhir Ayah', 'required');
        $this->form_validation->set_rules('alamatAyah', 'Alamat Lengkap Ayah', 'required');
        $this->form_validation->set_rules('teleponAyah', 'Nomor Telepon Ayah', 'required');
        $this->form_validation->set_rules('agamaAyah', 'Agama Ayah', 'required');
        $this->form_validation->set_rules('pekerjaanAyah', 'Pekerjaan Ayah', 'required');
        $this->form_validation->set_rules('alamatKantorAyah', 'Alamat Kantor Ayah', 'required');
        $this->form_validation->set_rules('gajiAyah', 'Gaji Ayah', 'required');
// Validasi data Ibu
$this->form_validation->set_rules('namaIbu', 'Nama Ibu', 'required');
$this->form_validation->set_rules('nikIbu', 'NIK Ibu', 'required');
$this->form_validation->set_rules('tempatLahirIbu', 'Tempat Lahir Ibu', 'required');
$this->form_validation->set_rules('tanggalLahirIbu', 'Tanggal Lahir Ibu', 'required');
$this->form_validation->set_rules('pendidikanIbu', 'Pendidikan Terakhir Ibu', 'required');
$this->form_validation->set_rules('alamatIbu', 'Alamat Lengkap Ibu', 'required');
$this->form_validation->set_rules('teleponIbu', 'Nomor Telepon Ibu', 'required');
$this->form_validation->set_rules('agamaIbu', 'Agama Ibu', 'required');
$this->form_validation->set_rules('pekerjaanIbu', 'Pekerjaan Ibu', 'required');
$this->form_validation->set_rules('alamatKantorIbu', 'Alamat Kantor Ibu', 'required');
$this->form_validation->set_rules('gajiIbu', 'Gaji Ibu', 'required');
// Validasi data Wali
$this->form_validation->set_rules('namaWali', 'Nama Wali');
$this->form_validation->set_rules('nikWali', 'NIK Wali');
$this->form_validation->set_rules('tempatLahirWali', 'Tempat Lahir Wali');
$this->form_validation->set_rules('tanggalLahirWali', 'Tanggal Lahir Wali');
$this->form_validation->set_rules('pendidikanWali', 'Pendidikan Terakhir Wali');
$this->form_validation->set_rules('alamatWali', 'Alamat Lengkap Wali');
$this->form_validation->set_rules('teleponWali', 'Nomor Telepon Wali');
$this->form_validation->set_rules('agamaWali', 'Agama Wali');
$this->form_validation->set_rules('pekerjaanWali', 'Pekerjaan Wali');
$this->form_validation->set_rules('alamatKantorWali', 'Alamat Kantor Wali');
$this->form_validation->set_rules('gajiWali', 'Gaji Wali');

        // Jalankan validasi
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_message', 'Pendaftaran gagal. Pastikan semua kolom telah diisi dengan benar.');
            redirect('auth/index'); // Redirect kembali ke halaman utama dengan pesan error
        } else {
            // Ambil data dari formulir
            $data = array(
                'nomor_telepon' => $this->input->post('inputNomorTelepon'),
                'level' => $this->input->post('level'), // Level diambil dari input hidden
                'nama_pendaftar' => $this->input->post('inputNamaPendaftar'),
                // Isi data lainnya sesuai dengan nama input di formulir
                // ...

// Data Ayah
'nama_ayah' => $this->input->post('namaAyah'),
'nik_ayah' => $this->input->post('nikAyah'),
'tempat_lahir_ayah' => $this->input->post('tempatLahirAyah'),
'tanggal_lahir_ayah' => $this->input->post('tanggalLahirAyah'),
'pendidikan_ayah' => $this->input->post('pendidikanAyah'),
'alamat_ayah' => $this->input->post('alamatAyah'),
'telepon_ayah' => $this->input->post('teleponAyah'),
'agama_ayah' => $this->input->post('agamaAyah'),
'pekerjaan_ayah' => $this->input->post('pekerjaanAyah'),
'alamat_kantor_ayah' => $this->input->post('alamatKantorAyah'),
'gaji_ayah' => $this->input->post('gajiAyah'),
// Isi data lainnya sesuai dengan nama input di formulir
// ...


// Data Ibu
'nama_ibu' => $this->input->post('namaIbu'),
'nik_ibu' => $this->input->post('nikIbu'),
'tempat_lahir_ibu' => $this->input->post('tempatLahirIbu'),
'tanggal_lahir_ibu' => $this->input->post('tanggalLahirIbu'),
'pendidikan_ibu' => $this->input->post('pendidikanIbu'),
'alamat_ibu' => $this->input->post('alamatIbu'),
'telepon_ibu' => $this->input->post('teleponIbu'),
'agama_ibu' => $this->input->post('agamaIbu'),
'pekerjaan_ibu' => $this->input->post('pekerjaanIbu'),
'alamat_kantor_ibu' => $this->input->post('alamatKantorIbu'),
'gaji_ibu' => $this->input->post('gajiIbu'),
// Isi data lainnya sesuai dengan nama input di formulir
// ...


    // Data Wali (Opsional)
    'nama_wali' => $this->input->post('namaWali') ?: '-',
    'nik_wali' => $this->input->post('nikWali') ?: '-',
    'tempat_lahir_wali' => $this->input->post('tempatLahirWali') ?: '-',
    'tanggal_lahir_wali' => $this->input->post('tanggalLahirWali') ?: '-',
    'pendidikan_wali' => $this->input->post('pendidikanWali') ?: '-',
    'alamat_wali' => $this->input->post('alamatWali') ?: '-',
    'telepon_wali' => $this->input->post('teleponWali') ?: '-',
    'agama_wali' => $this->input->post('agamaWali') ?: '-',
    'pekerjaan_wali' => $this->input->post('pekerjaanWali') ?: '-',
    'alamat_kantor_wali' => $this->input->post('alamatKantorWali') ?: '-',
    'gaji_wali' => $this->input->post('gajiWali') ?: '-',
    // Isi data lainnya sesuai dengan nama input di formulir
    // ...

            );

            // Panggil model untuk menyimpan data
            if ($this->Auth_model->insert($data)) {
                $this->session->set_flashdata('success_message', 'Pendaftaran Sukses.');
                redirect('auth/index'); // Redirect ke halaman utama setelah mengatur pesan sukses
            } else {
                $this->session->set_flashdata('error_message', 'Pendaftaran gagal. Silakan coba lagi.');
                redirect('auth/index'); // Redirect kembali ke halaman utama dengan pesan error
            }
        }
    }
}
