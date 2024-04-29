<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Invoice extends CI_Model
{
    private $order = ['no_invoice' => 'DESC']; // Tambahkan properti order

    // Datatable serverside - Start
    public function getDataInvKhususRA()
    {
        $this->_get_data_query();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    private function _get_data_query()
    {
        $this->db->select('a.uid as id_invoice, catg_kop, no_invoice, tanggal_invoice, smu, d.nama_agent, grand_total_gdg, name')
            ->from('inv_khusus a')
            ->join('inv_khusus_detail b', 'a.uid = b.bill_uid')
            ->join('member_staff c', 'a.user_uid = c.uid')
            ->join('inv_khusus_agent d', 'a.agent_uid=d.uid');

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $search_value = $_POST['search']['value'];
            $this->db->group_start()
                ->like('no_invoice', $search_value)
                ->or_like('smu', $search_value)
                ->or_like('d.nama_agent', $search_value)
                ->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['1']['column']], $_POST['order']['1']['dir']);
        } else {
            $this->db->order_by('a.uid', 'DESC');
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
        $this->db->select('a.uid as id_invoice, catg_kop, no_invoice, tanggal_invoice, smu, nama_agent, grand_total_gdg, name')
            ->from('inv_khusus a')
            ->join('inv_khusus_detail b', 'a.uid = b.bill_uid')
            ->join('member_staff c', 'a.user_uid = c.uid')
            ->join('inv_khusus_agent d', 'a.agent_uid=d.uid');

        return $this->db->count_all_results();
    }
}
