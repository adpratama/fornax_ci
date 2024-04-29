<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Integrasi extends CI_Model
{
    // Datatable serverside - Start
    public function getDataProduct($dom_int, $inc_out)
    {
        $this->_get_data_query($dom_int, $inc_out);

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->where('dom_int', $dom_int)->where('inc_out', $inc_out)->where('status_billing', '0')->get()->result();
    }

    private function _get_data_query($dom_int, $inc_out)
    {
        $this->db->where('dom_int', $dom_int)->where('inc_out', $inc_out)->where('status_billing', '0')->from('integrasi_ap2');

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $search_value = $_POST['search']['value'];
            $this->db->group_start()->like('no_invoice', $search_value)->or_like('no_smu', $search_value)->or_like('nama_agen', $search_value)->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('no_invoice', 'ASC');
        }
    }

    public function count_filtered_data($dom_int, $inc_out)
    {
        $this->_get_data_query($dom_int, $inc_out);

        $query = $this->db->where('dom_int', $dom_int)->where('inc_out', $inc_out)->where('status_billing', '0')->get();

        return $query->num_rows();
    }

    public function count_all_data($dom_int, $inc_out)
    {
        $this->db->where('dom_int', $dom_int)->where('inc_out', $inc_out)->where('status_billing', '0')->from('integrasi_ap2');

        return $this->db->count_all_results();
    }
    // Datatable serverside - End

    public function getInvoiceDetails($no_inv)
    {
        $this->db->select('no_invoice, tanggal_kirim, nama_agen, user_kasir, user_upload');
        $this->db->from('integrasi_ap2');
        $this->db->where('no_invoice', $no_inv);
        $data['invoice'] = $this->db->get()->row_array();

        $this->db->where('no_invoice', $no_inv);
        $data['details'] = $this->db->get('integrasi_ap2')->result();

        return $data;
    }

    public function details($no_inv)
    {
        return $this->db->where('no_invoice', $no_inv)->where('status_billing', '0')->get('integrasi_ap2')->result_array();
    }
}
