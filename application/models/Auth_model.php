<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function insert($data) {
        return $this->db->insert('tbl_pendaftar', $data); // Ubah 'pendaftar' sesuai dengan nama tabel Anda
    }

}