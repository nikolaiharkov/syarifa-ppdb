<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }


	public function index()
	{
        $data['admins'] = $this->Admin_model->get_admins_desc();
		$this->load->view('layout/dash_header');
		$this->load->view('admin/index', $data);
		$this->load->view('layout/dash_footer');
	}

    public function tambahadmin() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('ulangi_password', 'Ulangi Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == FALSE) {
            // Tampilkan view form dengan pesan error
            $this->session->set_flashdata('error_message', 'Gagal menambahkan admin.');
            redirect('admin/index');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'level' => 1,
                'notelepon' => $this->input->post('no_telepon'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );
            
            if ($this->Admin_model->tambah_admin($data)) {
                // Jika sukses, redirect ke halaman daftaradmin
                $this->session->set_flashdata('success_message', 'Admin berhasil ditambahkan.');
                redirect('admin/index');
            } else {
                // Jika gagal, redirect ke halaman admin/index
                $this->session->set_flashdata('error_message', 'Gagal menambahkan admin.');
                redirect('admin/index');
            }
        }
    }
    
    public function hapusadmin() {
        $idadmin = $this->input->post('idadmin');
        $result = $this->Admin_model->hapus_admin($idadmin);

        if ($result) {
            echo "sukses"; // Mengirimkan respons sukses ke AJAX
        } else {
            echo "gagal"; // Mengirimkan respons gagal ke AJAX
        }
    }

    public function editAdmin() {
        // Validasi input
        $this->form_validation->set_rules('editUsername', 'Username', 'required');
        $this->form_validation->set_rules('editNama', 'Nama', 'required');
        $this->form_validation->set_rules('editEmail', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('editNotelepon', 'No Telepon', 'required|min_length[10]');

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan view form edit dengan pesan error
            $this->session->set_flashdata('error_message', 'Gagal mengedit admin.');
            redirect('admin/index');
        } else {
            $idadmin = $this->input->post('idadmin');
            $data = array(
                'username' => $this->input->post('editUsername'),
                'nama' => $this->input->post('editNama'),
                'email' => $this->input->post('editEmail'),
                'notelepon' => $this->input->post('editNotelepon')
            );

            if ($this->Admin_model->edit_admin($idadmin, $data)) {
                // Jika sukses, redirect ke halaman daftaradmin
                $this->session->set_flashdata('success_message', 'Admin berhasil diubah.');
                redirect('admin/index');
            } else {
                // Jika gagal, redirect ke halaman admin/index
                $this->session->set_flashdata('error_message', 'Gagal mengedit admin.');
                redirect('admin/index');
            }
        }
    }

    public function editPassword() {
        // Validasi input
        $this->form_validation->set_rules('newPassword', 'Password Baru', 'required');
        $this->form_validation->set_rules('confirmPassword', 'Ulangi Password', 'required|matches[newPassword]');
        
        if ($this->form_validation->run() == FALSE) {
            // Tampilkan view form edit password dengan pesan error
            $this->session->set_flashdata('error_message', 'Gagal mengubah password admin.');
            redirect('admin/index');
        } else {
            $idadmin = $this->input->post('idadmin2');
            $data = array(
                'password' => password_hash($this->input->post('newPassword'), PASSWORD_BCRYPT)
            );

            if ($this->Admin_model->edit_password($idadmin, $data)) {
                // Jika sukses, redirect ke halaman daftaradmin
                $this->session->set_flashdata('success_message', 'Password admin berhasil diubah.');
                redirect('admin/index');
            } else {
                // Jika gagal, redirect ke halaman admin/index
                $this->session->set_flashdata('error_message', 'Gagal mengubah password admin.');
                redirect('admin/index');
            }
        }
    }

    
}
