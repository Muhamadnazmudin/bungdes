<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_besar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Buku_besar_model');
    }

    public function index()
    {
        $data['title'] = 'Buku Besar';
        $data['akun']  = $this->Buku_besar_model->get_akun();
        $data['data']  = [];
        $data['akun_aktif'] = null;

        if ($this->input->get('akun_id')) {
            $akun_id = $this->input->get('akun_id');
            $data['akun_aktif'] = $this->Buku_besar_model->get_akun_by_id($akun_id);
            $data['data'] = $this->Buku_besar_model->get_buku_besar($akun_id);
        }

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('buku_besar/index', $data);
        $this->load->view('templates/footer');
    }
}
