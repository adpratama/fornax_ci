<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_KategoriHarga extends CI_Model
{
    public function hargaInvKhususRa()
    {
        return $this->db->where('hold !=', '1')->order_by('uid', 'ASC')->get('inv_khusus_bill_catg')->result();
    }
}
