<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Smu extends CI_Model
{
    public function getSmuInvKhususRa($search)
    {
        return $this->db->select('uid, smu, tujuan, jumlah_ra, berat_ra, komoditi, chargeable, nama_pengirim, nama_penerima, nama_agent')->where('tipe_invoice', 'rainvkhusus')->like('smu', $search)->order_by('smu', 'ASC')->get('out_list')->result();
    }
}
