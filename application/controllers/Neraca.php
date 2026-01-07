<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Neraca_model');
    }

   public function index()
{
    $data['title'] = 'Neraca';

    $this->load->model('Laba_rugi_model');

    $data['aset']       = $this->Neraca_model->get_aset();
    $data['kewajiban']  = $this->Neraca_model->get_kewajiban();
    $data['modal']      = $this->Neraca_model->get_modal();

    // 👉 INI YANG KURANG
    $data['laba_ditahan'] = $this->Laba_rugi_model->get_laba_rugi();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('neraca/index', $data);
    $this->load->view('templates/footer');
}

}
