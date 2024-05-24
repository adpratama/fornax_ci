<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_Auth', 'M_Setting', 'M_User']);

        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			You have to login first.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>');
            redirect('auth');
        }

        // if ($this->session->userdata('user_role') != 1) {
        // }
    }

    public function menu()
    {
        $data = [
            'title' => 'Menu',
            'pages' => 'pages/dashboard/settings/v_menu',
            'menu' => $this->M_Setting->get_menus(),
            'login_menu' => $this->M_User->getUserMenu($this->session->userdata('username')),
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function user()
    {
        $data = [
            'title' => 'User',
            'pages' => 'pages/dashboard/users/v_user',
            'menu' => $this->M_Setting->get_menus(),
            'login_menu' => $this->M_User->getUserMenu($this->session->userdata('username')),
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function getDataUser()
    {
        $results = $this->M_User->getDataUser();
        $data = [];

        $no = 1;
        foreach ($results as $r) {
            $btn_edit = base_url('integrasiap2/invoice/' . $r->user_id);
            $btn_access = base_url('setting/user_access/' . $r->user_id);
            $btn_toggle_status = base_url('setting/' . ($r->is_active == "1" ? "hold" : "activate") . '/' . $r->user_id);
            $btn_border = $r->is_active == "1" ? "danger" : "primary";
            $user_status = $r->is_active == "1" ? "Active" : "Non-active";
            $user_status_icon = $r->is_active == "1" ? "Hold" : "Activate";

            $row = [
                $no++,
                $r->user_name,
                $r->user_id,
                $r->user_phone,
                $user_status,
                "<a href='$btn_edit' class='btn btn-outline-info btn-sm'>Edit</a>
                <a href='$btn_access' class='btn btn-outline-success btn-sm'>Access menu</a>
                <a href='$btn_toggle_status' class='btn btn-outline-$btn_border btn-sm btn-process'>$user_status_icon</a>"
            ];
            $data[] = $row;
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_User->count_all_data(),
            "recordsFiltered" => $this->M_User->count_filtered_data(),
            "data" => $data
        ];
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function user_access($id)
    {
        $data = [
            'title' => 'User Access',
            'pages' => 'pages/dashboard/users/v_access',
            'menu' => $this->M_Setting->get_menus(),
            'user_menu' => $this->M_User->getUserMenu($id),
            'login_menu' => $this->M_User->getUserMenu($this->session->userdata('username')),
        ];

        $this->load->view('pages/dashboard/index', $data);
    }

    public function update_access($id)
    {
        $access_menu = $this->input->post('input_menu');
        $access_submenu = $this->input->post('input_sub_menu');
        $access_submenu = $this->input->post('input_submenu');

        $formatted_menu = '[' . implode(',', $access_menu) . ']';
        $formatted_submenu = '[' . implode(',', $access_submenu) . ']';

        $data = [
            'access_menu' => $formatted_menu,
            'access_sub_menu' => $formatted_submenu,
        ];

        $this->M_User->update_user($data, $id);

        $this->session->set_flashdata('message_name', 'The access updated successfully.');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function activate($id)
    {
        $data = [
            'is_active' => '1'
        ];

        $this->M_User->update_user($data, $id);

        $this->session->set_flashdata('message_name', 'The user account has been activated successfully.');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function hold($id)
    {
        $data = [
            'is_active' => '0'
        ];

        $this->M_User->update_user($data, $id);

        $this->session->set_flashdata('message_name', 'The user account has been activated successfully.');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addNewMenu()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        $data_parent = [
            'nama_menu' => trim($this->input->post('nama_menu')),
            'url' => trim($this->input->post('url')),
            'has_child' => trim($this->input->post('has_child')),
            'controller' => trim($this->input->post('url')),
        ];

        $menu_childs = $this->input->post('menu_child');
        $url_childs = $this->input->post('url_child');

        $id_parent = $this->M_Setting->addMenu($data_parent);

        $child_data = [];

        if (is_array($menu_childs)) {
            for ($i = 0; $i < count($menu_childs); $i++) {
                $menu_child = $menu_childs[$i];
                $url_child = $url_childs[$i];

                $child_data[] = [
                    'nama_menu' => trim($menu_child),
                    'url' => trim($url_child),
                    'parent_id' => $id_parent,
                ];
            }

            // echo '<pre>';
            // print_r($child_data);
            // echo '</pre>';
            // exit;

            if (!empty($child_data)) {
                $insert = $this->M_Setting->addChildMenu($child_data);

                if ($insert) {
                    $this->session->set_flashdata('message_name', 'New menu has been successfully added.');
                    // After that you need to used redirect function instead of load view such as 
                    redirect("setting/menu");
                }
            }
        }
    }
}
