<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Ekspor extends CI_Model
{
    // Datatable serverside Customer - Start
    public function getDataCustomer($jenis)
    {
        $this->_get_data_query_customer($jenis);

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->where('do_store_type', $jenis)->get()->result();
    }

    private function _get_data_query_customer($jenis)
    {
        $this->db->where('do_store_type', $jenis)->from('eks_member_new');

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $search_value = $_POST['search']['value'];
            $this->db->group_start()->like('name', $search_value)->or_like('kota', $search_value)->or_like('code', $search_value)->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('name', 'ASC');
        }
    }

    public function count_filtered_data_customer($jenis)
    {
        $this->_get_data_query_customer($jenis);

        $query = $this->db->where('do_store_type', $jenis)->order_by('name', 'ASC')->get();

        return $query->num_rows();
    }

    public function count_all_data_customer($jenis)
    {
        $this->db->where('do_store_type', $jenis)->from('eks_member_new');

        return $this->db->count_all_results();
    }

    public function getDataBilling()
    {
        $this->_get_data_query_billing();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    private function _get_data_query_billing()
    {
        $this->db->select('q.uid, o.fr_class, o.awb_num, o.cbill_name, q.invoice_num, q.weight_charge, q.billing_date, q.user_code, q.all_grand_total, q.checkout_date, q.pay_status, q.total_cir, m.name, IF(o.inv_consignee = "1", o.cbill_uid, o.shipper_uid) AS shipper_uid, q.post_date')
            ->from('eks_storage_order_qty q')
            ->join('eks_storage_order o', 'q.storage_uid = o.uid', 'left')
            ->join('member_staff m', 'q.user_code = m.code', 'left')
            ->where('q.status !=', '4')
            ->where('q.branch_code', 'CORP_03');

        if (isset($_POST['search']['value']) && !empty($_POST['search']['value'])) {
            $search_value = $_POST['search']['value'];
            $this->db->group_start()->like('invoice_num', $search_value)->or_like('cbill_name', $search_value)->or_like('o.awb_num', $search_value)->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('q.checkout_date', 'DESC')->order_by('q.uid', 'DESC');
        }
    }

    public function count_filtered_data_billing()
    {
        $this->_get_data_query_billing();

        $query = $this->db->get();

        return $query->num_rows();
    }

    public function count_all_data_billing()
    {
        $this->db->select('q.uid')
            ->from('eks_storage_order_qty q')
            ->join('eks_storage_order o', 'q.storage_uid = o.uid', 'left')
            ->join('member_staff m', 'q.user_code = m.code', 'left')
            ->where('q.status !=', '4')
            ->where('q.branch_code', 'CORP_03');

        return $this->db->count_all_results();
    }

    public function getCustomerById($id, $postdate)
    {
        $this->db->select('name');

        if ($postdate <= "20240601015000") {
            $this->db->from('eks_member');
        } else {
            $this->db->from('eks_member_new');
        }

        $this->db->where('uid', $id);
        return $this->db->get()->row_array();
    }

    public function show($id)
    {
        return $this->db
            ->select('kade, total_pjkp2u, total_kade, total_document_fee, total_house_surcharge, total_fwb, total_barcoding, total_charge_cargo, total_charge_store, total_charge_store_over, total_charge_loading, materai, total_charge_billing, total_charge_tax, grand_total_charge, grand_total_paid, total_charge_all, all_grand_total, invoice_num, q.checkin_date, q.checkout_date, o.inv_consignee, pay_methode, storage_uid, surcharge_name, surcharge_unit, surcharge_fee, print_awb, q.label, q.total_label, total_print_awb, doc_ppn, q.wrapping, q.total_wrapping, hum_fee, hum_fee_select, jml_house_surcharge, satuan_house_surcharge, total_document, q.tanggal_bayar, total_airport_contribution, diskon_aircon, besar_diskon, aircon, diskon_jasagudang, subtotal_new, opsi_ppn, biaya_csd, overtime, overtime_surcharge, opsi_fwb, opsi_fhl, opsi_nawb, total_harga_fwb, total_harga_fhl, total_harga_nawb, o.awb_num, o.hawb_num, o.origin, o.destination, o.gtreat, qty, weight_charge, o.flight_num, q.bill_catg')
            ->from('eks_storage_order_qty q')
            ->join('eks_storage_order o', 'q.storage_uid = o.uid')
            ->where('q.uid', $id)
            ->get()
            ->row_array();
    }

    public function show_detail($id)
    {
        return $this->db->where('uid', $id)->get('eks_storage_order')->row_array();
    }
}
