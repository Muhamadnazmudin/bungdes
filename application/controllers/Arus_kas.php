<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arus_kas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Arus_kas_model');
    }

    public function index()
    {
        $data['title']        = 'Laporan Arus Kas';
        $data['operasional'] = $this->Arus_kas_model->get_operasional();
        $data['investasi']   = $this->Arus_kas_model->get_investasi();
        $data['pendanaan']   = $this->Arus_kas_model->get_pendanaan();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('arus_kas/index', $data);
        $this->load->view('templates/footer');
    }
}
