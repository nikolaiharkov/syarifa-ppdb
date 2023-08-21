<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function getPendaftarData() {
        // Ambil data pendaftar dari tabel tbl_pendaftar
        return $this->db->get('tbl_pendaftar')->result_array();
    }

    public function update($idpendaftar, $data) {
        $this->db->where('idpendaftar', $idpendaftar);
        return $this->db->update('tbl_pendaftar', $data);
    }

    public function deletePendaftar($idpendaftar) {
        // Hapus pendaftar dari tabel berdasarkan ID
        $this->db->where('idpendaftar', $idpendaftar);
        return $this->db->delete('tbl_pendaftar');
    }
}
