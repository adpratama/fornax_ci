<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(['string', 'date', 'debug']);
		$this->load->model(['M_Auth', 'M_Dashboard']);

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
		$filter_yearmonth = date("Ym");

		$data = [
			'title' => 'Dashboard',
			'pages' => 'pages/dashboard/v_dashboard',
			'outstanding' => $this->M_Dashboard->outstanding_agent(),
			'import' => $this->M_Dashboard->import($filter_yearmonth),
			'export' => $this->M_Dashboard->export($filter_yearmonth),
			'in_cgk' => $this->M_Dashboard->in_cgk($filter_yearmonth),
			'out_cgk' => $this->M_Dashboard->out_cgk($filter_yearmonth),
			'in_hlp' => $this->M_Dashboard->in_hlp($filter_yearmonth),
			'out_hlp' => $this->M_Dashboard->out_hlp($filter_yearmonth),
			// 'menu' => $this->M_Setting->get_menus(),
			// 'login_menu' => $this->M_User->getUserMenu($this->session->userdata('username')),
		];

		$this->load->view('pages/dashboard/index', $data);
	}
}
