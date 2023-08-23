<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Siswa_model'); // Memuat model Siswa_model
        $this->load->library('upload');
        $this->load->helper('file');
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

    public function indexSiswa()
    {
        $idpendaftar = $_SESSION['idpendaftar'];
        $data['data_siswa'] = $this->Siswa_model->getSiswaByPendaftar($idpendaftar);
    
        $this->load->view('layout/dash_header');
        $this->load->view('siswa/siswa', $data); // Mengirim data siswa ke view
        $this->load->view('layout/dash_footer');
    }
    

    public function tambahSiswa() {
// Set validation rules for each input field
$this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'required');
$this->form_validation->set_rules('namaPanggilan', 'Nama Panggilan', 'required');
$this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required');
$this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'required');
$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'required');
$this->form_validation->set_rules('asalSekolah', 'Asal Sekolah', 'trim');
$this->form_validation->set_rules('agama', 'Agama', 'required');
$this->form_validation->set_rules('alamat', 'Alamat Tempat Tinggal', 'required');
$this->form_validation->set_rules('noTelepon', 'Nomor Telepon', 'required');
$this->form_validation->set_rules('jarakRumah', 'Jarak Rumah ke Sekolah', 'required');
$this->form_validation->set_rules('tinggalBersama', 'Tinggal Bersama', 'required');
$this->form_validation->set_rules('transportasi', 'Transportasi ke Sekolah', 'required');
$this->form_validation->set_rules('jumlahSaudara', 'Jumlah Saudara', 'trim');
$this->form_validation->set_rules('beratBadan', 'Berat Badan', 'required');
$this->form_validation->set_rules('tinggiBadan', 'Tinggi Badan', 'required');
$this->form_validation->set_rules('sakitRingan', 'Sakit Ringan yang Sering Diderita', 'trim');
$this->form_validation->set_rules('sakitBerat', 'Sakit Berat yang Pernah Diderita', 'trim');
$this->form_validation->set_rules('alergi', 'Alergi yang Diderita', 'trim');
$this->form_validation->set_rules('kelainanLahir', 'Kelainan Sejak Lahir', 'trim');
$this->form_validation->set_rules('operasi', 'Operasi yang Pernah Dialami', 'trim');
$this->form_validation->set_rules('kecelakaan', 'Kecelakaan yang Pernah Dialami', 'trim');

if ($this->form_validation->run() == false) {
    // Form validation failed, redirect back to siswa/indexSiswa with error_message
    $this->session->set_flashdata('error_message', 'Gagal menambahkan data siswa. Silakan periksa kembali isian Anda.');
    redirect('siswa/indexSiswa'); // Replace 'your_form_view' with your actual view name
        } else {
            // Form validation passed, prepare data for insertion
            $data = array(
                'idpendaftar' => $this->input->post('idPendaftar'),
                'nama_lengkap' => $this->input->post('namaLengkap'),
                'nama_panggilan' => $this->input->post('namaPanggilan'),
                'jenis_kelamin' => $this->input->post('jenisKelamin'),
                'tempat_lahir' => $this->input->post('tempatLahir'),
                'tanggal_lahir' => $this->input->post('tanggalLahir'),
                'asal_sekolah' => ($this->input->post('asalSekolah') != "") ? $this->input->post('asalSekolah') : "-",
                'agama' => $this->input->post('agama'),
                'alamat' => $this->input->post('alamat'),
                'no_telepon' => $this->input->post('noTelepon'),
                'jarak_rumah' => $this->input->post('jarakRumah'),
                'tinggal_bersama' => $this->input->post('tinggalBersama'),
                'transportasi' => $this->input->post('transportasi'),
                'jumlah_saudara' => ($this->input->post('jumlahSaudara') != "") ? $this->input->post('jumlahSaudara') : "-",
                'berat_badan' => $this->input->post('beratBadan'),
                'tinggi_badan' => $this->input->post('tinggiBadan'),
                'sakit_ringan' => ($this->input->post('sakitRingan') != "") ? $this->input->post('sakitRingan') : "-",
                'sakit_berat' => ($this->input->post('sakitBerat') != "") ? $this->input->post('sakitBerat') : "-",
                'alergi' => ($this->input->post('alergi') != "") ? $this->input->post('alergi') : "-",
                'kelainan_sejak_lahir' => ($this->input->post('kelainanLahir') != "") ? $this->input->post('kelainanLahir') : "-",
                'operasi' => ($this->input->post('operasi') != "") ? $this->input->post('operasi') : "-",
                'kecelakaan' => ($this->input->post('kecelakaan') != "") ? $this->input->post('kecelakaan') : "-",
                'status' => 1
            );
            
            
            // Insert data using the model
            if ($this->Siswa_model->insertSiswa($data)) {
                // Insertion successful, set flashdata and redirect
                $this->session->set_flashdata('success_message', 'Data siswa berhasil ditambahkan.');
                redirect('siswa/indexSiswa'); // Redirect to the desired page
            } else {
                // Insertion failed, set flashdata and redirect
                $this->session->set_flashdata('error_message', 'Terjadi kesalahan saat menambahkan data siswa.');
                redirect('siswa/indexSiswa'); // Redirect to the desired page
            }
        }
    }

    public function getDetailSiswa($idsiswa) {
        // Mengambil data siswa berdasarkan idsiswa
        $data_siswa = $this->Siswa_model->getDetailSiswa($idsiswa);

        if ($data_siswa) {
            // Jika data ditemukan, kirimkan response JSON dengan data siswa
            echo json_encode($data_siswa);
        } else {
            // Jika data tidak ditemukan, kirimkan response JSON dengan pesan error
            echo json_encode(array('error' => 'Data siswa tidak ditemukan.'));
        }
    }

    public function uploadDokumen() {
        $this->form_validation->set_rules('siswaId', 'ID Siswa', 'required');
        $this->form_validation->set_rules('fotoAnak', 'Foto Anak');
        $this->form_validation->set_rules('akteKelahiran', 'Akte Kelahiran');
        $this->form_validation->set_rules('kk', 'KK');
    
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error_message', 'Upload dokumen gagal. 1');
        } else {
            $idsiswa = $this->input->post('siswaId');
            $randomNumber = rand(100, 999);
    
            $fotoAnakName = '';
            $akteKelahiranName = '';
            $kkName = '';
    
            $config['upload_path'] = './dokumen/';
            $config['allowed_types'] = 'jpg|png|pdf';
    
            // Upload foto anak
            if (!empty($_FILES['fotoAnak']['name'])) {
                $fileExtension = pathinfo($_FILES['fotoAnak']['name'], PATHINFO_EXTENSION);
                $fotoAnakName = $idsiswa . '_foto_' . $randomNumber . '.' . $fileExtension;
                $config['file_name'] = 'foto/' . $fotoAnakName;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('fotoAnak')) {
                    $this->session->set_flashdata('error_message', 'Upload foto anak gagal.');
                    redirect('siswa/indexSiswa');
                }
            }
    
            // Upload akte kelahiran
            if (!empty($_FILES['akteKelahiran']['name'])) {
                $fileExtension = pathinfo($_FILES['akteKelahiran']['name'], PATHINFO_EXTENSION);
                $akteKelahiranName = $idsiswa . '_akte_' . $randomNumber . '.' . $fileExtension;
                $config['file_name'] = 'akte/' . $akteKelahiranName;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('akteKelahiran')) {
                    $this->session->set_flashdata('error_message', 'Upload akte kelahiran gagal.');
                    redirect('siswa/indexSiswa');
                }
            }
    
            // Upload kartu keluarga
            if (!empty($_FILES['kk']['name'])) {
                $fileExtension = pathinfo($_FILES['kk']['name'], PATHINFO_EXTENSION);
                $kkName = $idsiswa . '_kk_' . $randomNumber . '.' . $fileExtension;
                $config['file_name'] = 'kk/' . $kkName;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('kk')) {
                    $this->session->set_flashdata('error_message', 'Upload kartu keluarga gagal.');
                    redirect('siswa/indexSiswa');
                }
            }
    
            // Insert data into tbl_dokumen
            $insertData = array(
                'idsiswa' => $idsiswa,
                'foto_anak' => isset($fotoAnakName) ? 'foto' . $fotoAnakName : '',
                'akte_kelahiran' => isset($akteKelahiranName) ? 'akte' . $akteKelahiranName : '',
                'kartu_keluarga' => isset($kkName) ? 'kk' . $kkName : ''
            );
            
            $this->Siswa_model->insertDokumen($insertData);
            $updateData = array('status' => 2);
            $this->Siswa_model->updateStatus($idsiswa, $updateData);
    
            $this->session->set_flashdata('success_message', 'Dokumen berhasil diupload.');
        }
    
        redirect('siswa/indexSiswa');
    }
    
    
    
    

    public function indexSiswaAdmin()
    {
        $data['data_siswa'] = $this->Siswa_model->getAllSiswaDesc();

        $this->load->view('layout/dash_header');
        $this->load->view('siswa/siswaAdmin', $data); // Mengirim data siswa ke view
        $this->load->view('layout/dash_footer');
    }

    public function getDokumenByIdsiswa($idsiswa) {
        $dokumen = $this->Siswa_model->getDokumentByIdsiswa($idsiswa);
    
        if ($dokumen) {
            $response['success'] = true;
            $response['data'] = $dokumen;
        } else {
            $response['success'] = false;
        }
    
        echo json_encode($response);
    }
    
    
}
