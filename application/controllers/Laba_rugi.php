<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Laba_rugi_model');
    }

    public function index()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['pendapatan'] = $this->Laba_rugi_model->get_pendapatan();
        $data['beban']      = $this->Laba_rugi_model->get_beban();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('laba_rugi/index', $data);
        $this->load->view('templates/footer');
    }
}
