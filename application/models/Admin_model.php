<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Load database
        $this->load->database();
    }

public function tambah_admin($data) {
        return $this->db->insert('tbl_admin', $data);
}

public function get_admins_desc() {
    $this->db->order_by('idadmin', 'DESC');
    return $this->db->get('tbl_admin')->result();
}

public function hapus_admin($idadmin) {
    $this->db->where('idadmin', $idadmin);
    return $this->db->delete('tbl_admin');
}

public function edit_admin($idadmin, $data) {
    $this->db->where('idadmin', $idadmin);
    return $this->db->update('tbl_admin', $data);
}

public function edit_password($idadmin, $data) {
    $this->db->where('idadmin', $idadmin);
    return $this->db->update('tbl_admin', $data);
}


}
