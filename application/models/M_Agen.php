<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Agen extends CI_Model
{
    public function invKhususRa()
    {
        return $this->db->where('hold !=', '1')->order_by('uid', 'ASC')->get('inv_khusus_agent')->result();
    }
}
