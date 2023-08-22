<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function getPendaftarData() {
        $query = $this->db->get('tbl_pendaftar'); // Ambil semua data dari tabel tbl_pendaftar
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }
    
    public function getPendaftarById($idpendaftar) {
        $this->db->select('*');
        $this->db->from('tbl_pendaftar');
        $this->db->where('idpendaftar', $idpendaftar);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
