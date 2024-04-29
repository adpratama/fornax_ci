<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvKhususRA extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Auth', 'M_Invoice', 'M_KategoriHarga', 'M_Agen', 'M_Smu']);

        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
            redirect('auth');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Inv Khusus RA LJA',
            'pages' => 'pages/dashboard/invkhusus_ralja/v_table',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getData()
    {
        $results = $this->M_Invoice->getDataInvKhususRA();

        $data = [];

        foreach ($results as $r) {
            $row = array();

            // $btn_send = base_url('invkhususra/send/' . $r->no_invoice);
            $btn_invoice = base_url('invkhususra/invoice/' . $r->no_invoice);
            $dateString = $r->tanggal_invoice;
            $dateObject = DateTime::createFromFormat('YmdHis', $dateString);
            $tanggal_inv = $dateObject->format('Y-m-d H:i:s');

            $kop = $r->catg_kop;
            $bulan = date('m', strtotime($tanggal_inv));
            $tahun = date('y', strtotime($tanggal_inv));
            $no_inv = $r->no_invoice . '/' . $kop . 'WH' . '/' . intToRoman($bulan) . '/' . $tahun;
            $row[] = $r->catg_kop;
            $row[] = $no_inv;
            $row[] = format_indo_non_hari($tanggal_inv);
            $row[] = $r->smu;
            $row[] = $r->nama_agent;
            $row[] = (!$r->grand_total_gdg) ? 0 : "Rp " . number_format($r->grand_total_gdg);
            $row[] = $r->name;
            $row[] = "
            <a href='$btn_invoice' target='_blank' class='btn btn-success btn-xs'>Invoice</a>";
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_Invoice->count_all_data(),
            "recordsFiltered" => $this->M_Invoice->count_filtered_data(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function create()
    {
        $data = [
            'title' => 'Inv Khusus RA LJA',
            'agents' => $this->M_Agen->invKhususRa(),
            'kategoriHarga' => $this->M_KategoriHarga->hargaInvKhususRa(),
            'pages' => 'pages/dashboard/invkhusus_ralja/v_create',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getSmu()
    {
        $searchTerm = $this->input->get('term');
        print_r($searchTerm);

        $data = $this->M_Smu->getSmuInvKhususRa($searchTerm);

        echo json_encode($data);
    }

    public function store()
    {
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';
    }
}
