<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Auth');

        // Periksa cookie "remember me"
        if ($this->input->cookie('remember_me_cookie')) {
            // Dapatkan nilai cookie dan gunakan untuk autentikasi
            $cookie_value = $this->input->cookie('remember_me_cookie');
            // Autentikasi pengguna berdasarkan nilai cookie
            $user = $this->M_Auth->get_user_by_cookie_value($cookie_value);
            if ($user) {
                // Autentikasi berhasil, set session
                $this->session->set_userdata('user_id', $user->id); // Contoh, gantilah dengan kunci sesi dan nilai sesuai kebutuhan Anda
                // Lakukan tindakan lainnya, misalnya pengalihan ke halaman utama
                redirect('home');
            } else {
                // Cookie tidak valid, lakukan tindakan yang sesuai, misalnya hapus cookie
                delete_cookie('remember_me_cookie');
            }
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        } else {
            if ($this->form_validation->run() ==  false) {
                $data = [
                    "title" => "Login",
                ];
                $this->load->view('pages/auth/index', $data);
            } else {
                // validasinya sukses
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin_user', ['user_id' => $username])->row_array();

        if ($user) {

            // usernya ada
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'user_id' => $user['id'],
                        'username' => $user['user_id'],
                        'name' => $user['user_name'],
                        'role' => $user['role'],
                        'is_logged_in' => true,
                    ];
                    $this->session->set_userdata($data);

                    if ($this->input->post('remember_me')) {
                        $this->load->helper('cookie');
                        $cookie = array(
                            'name'   => 'remember_me_cookie',
                            'value'  => 'some_value', // sesuaikan dengan nilai yang sesuai
                            'expire' => '86400', // sesuaikan dengan durasi cookie (dalam detik)
                            'secure' => TRUE // atur ke TRUE jika menggunakan HTTPS
                        );
                        $this->input->set_cookie($cookie);
                    }

                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Wrong password.
					<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
					</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Username has not been activated.
				<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
				</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message_name', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Username has not been registered.
			<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
			</div>');

            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dash/dashboard');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'The email has already registered'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'The username has already registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() ==  false) {

            $data = [
                'title' => 'User Registration',
            ];

            $this->load->view('pages/auth/index', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => $this->input->post('username'),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => '2',
                'is_active' => '1',
                'date_created' => time()
            ];

            $this->M_Auth->registration($data);
        }
    }

    public function change_password($id)
    {

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('is_logged_in');

        $this->session->set_flashdata('message_name', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		You have been logout.
		<button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
		</div>');
        redirect('auth');
    }
}
