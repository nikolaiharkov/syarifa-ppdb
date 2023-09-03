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
        $this->db->select('s.idsiswa, s.nama_lengkap, p.nama_pendaftar, pb.tgl_formulir, s.status, pb.bukti_bms, pb.bukti_formulir');
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

    public function insertKategori($data)
    {
        return $this->db->insert('tbl_kategori_bms', $data);
    }

    public function getKategoriData()
{
    return $this->db->get('tbl_kategori_bms')->result_array();
}

public function getKategoriById($id)
{
    return $this->db->get_where('tbl_kategori_bms', array('idbms' => $id))->row_array();
}

public function updateKategori($id, $data)
{
    $this->db->where('idbms', $id);
    return $this->db->update('tbl_kategori_bms', $data);
}

public function hapusKategori($id)
{
    $this->db->where('idbms', $id);
    $this->db->delete('tbl_kategori_bms');
    
    return $this->db->affected_rows() > 0;
}

public function getKategoriBMS()
{
    // Query untuk mengambil data kategori dari tbl_kategori_bms
    $this->db->select('*');
    $this->db->from('tbl_kategori_bms');

    // Lakukan query dan kembalikan hasilnya dalam bentuk array
    return $this->db->get()->result_array();
}

public function getTotalBiayaByIdsiswa($idsiswa) {
    // Query untuk mengambil total biaya dari tbl_kategori_bms berdasarkan idsiswa
    $this->db->select_sum('total_bms', 'total_biaya');
    $this->db->from('tbl_kategori_bms');
    $this->db->join('tbl_siswa', 'tbl_kategori_bms.idbms = tbl_siswa.idbms');
    $this->db->where('tbl_siswa.idsiswa', $idsiswa);

    // Eksekusi query dan ambil hasilnya
    $query = $this->db->get();
    $result = $query->row();

    // Jika ada hasil, kembalikan total biaya
    if ($result) {
        return $result->total_biaya;
    } else {
        return 0; // Jika tidak ada hasil, kembalikan 0
    }
}

public function updateStatusSiswa($idsiswa, $newStatus)
{
    // Update status pada tbl_siswa menjadi $newStatus
    $data = array(
        'status' => $newStatus
    );
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_siswa', $data);
}

public function updateDiskonPembayaran($idsiswa, $diskon)
{
    // Update diskon pada tbl_pembayaran
    $data = array(
        'diskon_bms' => $diskon
    );
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_pembayaran', $data);
}

public function getDataKategoriBMS($idsiswa) {
    // Query untuk mengambil data dari tbl_kategori_bms dan tbl_pembayaran berdasarkan idsiswa
    $this->db->select('tbl_kategori_bms.nama_bms, tbl_kategori_bms.detail_bms, tbl_kategori_bms.total_bms, tbl_pembayaran.diskon_bms');
    $this->db->from('tbl_siswa');
    $this->db->join('tbl_kategori_bms', 'tbl_kategori_bms.idbms = tbl_siswa.idbms');
    $this->db->join('tbl_pembayaran', 'tbl_pembayaran.idsiswa = tbl_siswa.idsiswa');
    $this->db->where('tbl_siswa.idsiswa', $idsiswa);

    // Lakukan query
    $query = $this->db->get();

    // Mengembalikan hasil dalam bentuk array
    return $query->row_array();
}

public function updatePembayaran($idsiswa, $data) {
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_pembayaran', $data);
}

public function updateStatusSiswa2($idsiswa, $data) {
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_siswa', $data);
}

public function terimaSiswaBMS($idsiswa) {
    // Ubah status siswa dengan ID tertentu menjadi 6 (sesuaikan dengan status yang sesuai dalam tabel Anda)
    $data = array('status' => 6);
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_siswa', $data);
}

public function tolakSiswaBMS($idsiswa) {
    // Ubah status siswa dengan ID tertentu menjadi 6 (sesuaikan dengan status yang sesuai dalam tabel Anda)
    $data = array('status' => 5);
    $this->db->where('idsiswa', $idsiswa);
    return $this->db->update('tbl_siswa', $data);
}


}