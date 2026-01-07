<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_umum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model('Jurnal_umum_model');
    }

    public function index()
    {
        $data['title']  = 'Jurnal Umum';
        $data['jurnal'] = $this->Jurnal_umum_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('jurnal_umum/index', $data);
        $this->load->view('templates/footer');
    }
}
