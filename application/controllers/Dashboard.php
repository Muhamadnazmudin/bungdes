<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        if (!$this->session->userdata('login')) {
        redirect('auth/login');
    }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
}
