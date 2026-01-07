<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_kas_umum extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Buku_kas_umum_model');
    }

    public function index()
    {
        $data['title'] = 'Buku Kas Umum';
        $data['kas']   = $this->Buku_kas_umum_model->get_kas_list();
        $data['data']  = [];

        if ($this->input->get('kas_id')) {
            $data['data'] = $this->Buku_kas_umum_model
                ->get_buku_kas($this->input->get('kas_id'));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('buku_kas_umum/index', $data);
        $this->load->view('templates/footer');
    }
}
