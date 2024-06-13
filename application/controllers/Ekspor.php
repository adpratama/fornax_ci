<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekspor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Auth', 'M_Ekspor']);
        $this->load->library(['pdfgenerator']);

        if (!$this->session->userdata('is_logged_in')) {

            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
            redirect('auth');
        }
    }

    public function customer($id)
    {
        $data = [
            'title' => ucfirst($id) . ' - Ekspor',
            'pages' => 'pages/dashboard/ekspor/v_customer',
            'tipe' => $id
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getCustomer($jenis)
    {
        $jenis = $this->uri->segment(3);

        $results = $this->M_Ekspor->getDataCustomer($jenis);

        $data = [];

        foreach ($results as $r) {
            $row = array();

            $row[] = $r->code;
            $row[] = $r->name;
            $row[] = $r->kota;
            $row[] = $r->contact_number;
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Ekspor->count_all_data_customer($jenis),
            "recordsFiltered" => $this->M_Ekspor->count_filtered_data_customer($jenis),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function billing()
    {
        $data = [
            'title' => 'Billing - Ekspor',
            'pages' => 'pages/dashboard/ekspor/v_billing',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getBilling()
    {
        $results = $this->M_Ekspor->getDataBilling();

        $data = [];

        foreach ($results as $r) {
            $row = array();

            $kategori = ($r->fr_class == "1") ? "Airline" : (($r->fr_class == "2") ? "Transhipment" : "");

            $dateString = $r->billing_date;
            $tgl_billing = date("Y-m-d H:i:s", strtotime($dateString));

            $btn_invoice = base_url('ekspor/print_invoice/' . $r->uid);

            $pay_status = $r->pay_status;
            $total_cir = $r->total_cir;

            $postdate = $r->post_date;

            $shipper_uid = $r->shipper_uid;

            $shipper = $this->M_Ekspor->getCustomerById($shipper_uid, $postdate);

            $shipper_name = ($shipper) ? $shipper['name'] : "";

            $print = ($pay_status == "2")
                ? (($total_cir > 0)
                    ? "
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> BTB</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> Invoice</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> CIR</a>"
                    : "
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> BTB</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> Invoice</a>")
                : (($pay_status > "0")
                    ? (($total_cir > 0)
                        ? "
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> BTB</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> Invoice</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> CIR</a>"
                        : "
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> BTB</a>
                        <a class='btn btn-primary btn-sm' href='$btn_invoice' target='_web'><i class='bi bi-printer'></i> Invoice</a>")
                    : "<font color=#BBBBBB>Unpaid</font>");

            $row[] = $kategori;
            $row[] = $r->awb_num;
            $row[] = $r->invoice_num;
            $row[] = $shipper_name;
            $row[] = number_format($r->weight_charge);
            $row[] = number_format($r->all_grand_total);
            $row[] = format_indo_non_hari($tgl_billing);
            $row[] = $r->name;
            $row[] = $print;
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Ekspor->count_all_data_billing(),
            "recordsFiltered" => $this->M_Ekspor->count_filtered_data_billing(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function print_invoice($id)
    {
        $inv =  $this->M_Ekspor->show($id);

        $data = [
            'title_pdf' => 'Invoice Ekspor No. ' . $id,
            'invoice' => $inv,
        ];

        // filename dari pdf ketika didownload
        $file_pdf = 'Invoice Ekspor No. ' . $id;

        // setting paper
        $paper = 'A4';

        //orientasi paper potrait / landscape
        $orientation = "portrait";

        $html = $this->load->view('pages/dashboard/ekspor/v_invoice_pdf', $data, true);

        // run dompdf
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
}
