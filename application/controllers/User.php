<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Auth', 'M_User']);

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
            'title' => 'User',
            'pages' => 'pages/user/v_user',
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getData()
    {
        $results = $this->M_User->getDataUser();

        $data = [];

        $no = 1;
        foreach ($results as $r) {
            $row = array();

            $btn_invoice = base_url('integrasiap2/invoice/' . $r->user_name);

            $user_status = ($r->is_active == "1") ? "Active" : "Non-active";

            $row[] = $no++;
            $row[] = $r->user_name;
            $row[] = $r->user_id;
            $row[] = $r->user_phone;
            $row[] = $user_status;
            $row[] = "
            <a href='$btn_invoice' class='btn btn-success btn-xs'><i class='bi bi-pencil'></i></a>";
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_User->count_all_data(),
            "recordsFiltered" => $this->M_User->count_filtered_data(),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
