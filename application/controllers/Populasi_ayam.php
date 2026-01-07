<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Populasi_ayam extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model(['Populasi_ayam_model','Kandang_model']);
    }

    public function index()
    {
        $data['title'] = 'Populasi Ayam';
        $data['data']  = $this->Populasi_ayam_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('populasi_ayam/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Populasi_ayam_model->insert($this->input->post());
            redirect('populasi_ayam');
        }

        $data['title']   = 'Input Populasi Ayam';
        $data['kandang'] = $this->Kandang_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('populasi_ayam/tambah', $data);
        $this->load->view('templates/footer');
    }
    public function edit($id)
{
    if ($this->input->post()) {
        $this->Populasi_ayam_model->update($id, $this->input->post());
        redirect('populasi_ayam');
    }

    $data['title']    = 'Edit Populasi Ayam';
    $data['data']     = $this->Populasi_ayam_model->get_by_id($id);
    $data['kandang']  = $this->Kandang_model->get_all();

    $this->load->view('templates/header', $data);
    
    
    $this->load->view('populasi_ayam/edit', $data);
    $this->load->view('templates/footer');
}

}
