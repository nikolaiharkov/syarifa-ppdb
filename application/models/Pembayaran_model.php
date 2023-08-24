<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

    public function getSiswaByIdPendaftar($idpendaftar) {
        // Ambil data siswa dari tabel tbl_siswa berdasarkan idpendaftar
        $this->db->where('idpendaftar', $idpendaftar);
        $query = $this->db->get('tbl_siswa');
        
        // Mengembalikan hasil query dalam bentuk array
        return $query->result_array();
    }

    public function insertPembayaran($data) {
        // Masukkan data pembayaran ke dalam tabel tbl_pembayaran
        $this->db->insert('tbl_pembayaran', $data);
    }

    public function getPembayaranData() {
        $this->db->select('s.idsiswa, s.nama_lengkap, p.nama_pendaftar, pb.tgl_formulir, s.status');
        $this->db->from('tbl_pembayaran pb');
        $this->db->join('tbl_siswa s', 'pb.idsiswa = s.idsiswa');
        $this->db->join('tbl_pendaftar p', 's.idpendaftar = p.idpendaftar');
        
        return $this->db->get()->result_array();
    }

    public function updateStatusFormulir($idsiswa, $newStatus) {
        $data = array(
            'status' => $newStatus
        );

        $this->db->where('idsiswa', $idsiswa);
        return $this->db->update('tbl_siswa', $data);
    }
    

}