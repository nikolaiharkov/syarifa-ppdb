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

    public function insertSiswa($data) {
        // Insert data into tbl_siswa table
        return $this->db->insert('tbl_siswa', $data);
    }

    public function getSiswaByPendaftar($idpendaftar)
{
    $this->db->where('idpendaftar', $idpendaftar);
    return $this->db->get('tbl_siswa')->result_array();
}

public function getDetailSiswa($idsiswa) {
    // Ambil data siswa berdasarkan idsiswa
    $this->db->where('idsiswa', $idsiswa);
    $query = $this->db->get('tbl_siswa');

    if ($query->num_rows() > 0) {
        // Jika data ditemukan, kembalikan data siswa dalam bentuk array
        return $query->row_array();
    } else {
        // Jika data tidak ditemukan, kembalikan null
        return null;
    }
}

public function insertDokumen($insertData) {
    $this->db->insert('tbl_dokumen', $insertData);
    return $this->db->insert_id(); // Mengembalikan ID baris yang diinsert
}


public function getDokumenByIdsiswa($idsiswa) {
    $this->db->where('idsiswa', $idsiswa);
    $query = $this->db->get('tbl_dokumen');

    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        return null;
    }
}

public function updateStatus($idsiswa, $data) {
    $this->db->where('idsiswa', $idsiswa);
    $this->db->update('tbl_siswa', $data);
}

public function getAllSiswaDesc() {
    $this->db->order_by('idsiswa', 'DESC');
    return $this->db->get('tbl_siswa')->result_array();
}

public function getNamaPendaftarById($idpendaftar) {
    $this->db->select('nama_pendaftar');
    $this->db->where('idpendaftar', $idpendaftar);
    $query = $this->db->get('tbl_pendaftar');
    if ($query->num_rows() > 0) {
        $result = $query->row_array();
        return $result['nama_pendaftar'];
    } else {
        return '';
    }
}

public function getDokumentByIdsiswa($idsiswa) {
    $this->db->where('idsiswa', $idsiswa);
    $query = $this->db->get('tbl_dokumen');

    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        return false;
    }
}



}
