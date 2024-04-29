<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
		$data = [
			'title' => 'Home',
			'pages' => 'pages/home/v_home',
		];

		$this->load->view('index', $data);
	}
}
