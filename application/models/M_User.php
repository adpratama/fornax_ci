<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
    private $order = ['user_id' => 'ASC']; // Tambahkan properti order

    // Datatable serverside - Start
    public function getDataUser()
    {
        $this->_get_data_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    private function _get_data_query()
    {
        $this->db->select('user_id, user_name, user_phone, is_active')
            ->from('admin_user');

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $search_value = $_POST['search']['value'];
            $this->db->group_start()
                ->like('user_name', $search_value)
                ->or_like('user_id', $search_value)
                ->group_end();
        }

        if (isset($_POST['order']) && is_array($_POST['order']) && count($_POST['order']) > 1) {
            $this->db->order_by($this->order[$_POST['order'][0]['column']], $_POST['order'][0]['dir']);
        } else {
            $this->db->order_by('user_id', 'ASC');
        }
    }

    public function count_filtered_data()
    {
        $this->_get_data_query();
        $query = $this->db->get(); // Panggil get() setelah where()
        return $query->num_rows();
    }

    public function count_all_data()
    {
        $this->db->select('user_id, user_name, user_phone, is_active')
            ->from('admin_user');

        return $this->db->count_all_results();
    }

    public function getUserMenu($id)
    {
        return $this->db->select('access_menu, access_sub_menu')->where('user_id', $id)->get('admin_user')->row_array();
    }

    public function update_user($data, $id)
    {
        return $this->db->where('user_id', $id)->update('admin_user', $data);
    }
}
