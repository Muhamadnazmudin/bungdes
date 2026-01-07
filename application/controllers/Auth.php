<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function login()
    {
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->cek_user($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'login' => true,
                'user_id' => $user->id,
                'nama' => $user->nama,
                'role_id' => $user->role_id
            ]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
