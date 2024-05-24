<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Setting extends CI_Model
{
    public function get_menus()
    {
        $this->db->where('parent_id', NULL);
        $this->db->order_by('url', 'ASC');
        return $this->db->get('menu')->result();
    }

    public function get_submenus($id)
    {
        $this->db->where('parent_id', $id);
        $this->db->order_by('id', 'ASC');
        return $this->db->get('menu')->result();
    }

    public function addMenu($invoice_data)
    {
        $this->db->insert('menu', $invoice_data);

        // Dapatkan ID invoice yang baru saja di-generate
        return $this->db->insert_id();
    }

    public function addChildMenu($invoice_data)
    {
        return $this->db->insert_batch('menu', $invoice_data);
    }
}
