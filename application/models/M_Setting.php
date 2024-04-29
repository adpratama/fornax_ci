<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Setting extends CI_Model
{
    public function get_menus()
    {
        $this->db->where('parent_id', NULL);
        $this->db->order_by('nama_menu', 'ASC');
        return $this->db->get('menu')->result();
    }

    public function get_submenus($id)
    {
        $this->db->where('parent_id', $id);
        $this->db->order_by('id', 'ASC');
        return $this->db->get('menu')->result();
    }
}
