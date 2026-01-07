<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_sakit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ayam_sakit_model');
        $this->load->model('Unit_usaha_model');
        $this->load->model('Kandang_model');
    }

    public function index()
    {
        $data['title'] = 'Ayam Sakit';
        $data['data']  = $this->Ayam_sakit_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('ayam_sakit/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
{
    $data['title']   = 'Input Ayam Sakit';
    $data['unit']    = $this->Unit_usaha_model->get_all();
    $data['kandang'] = $this->Kandang_model->get_all();

    if ($this->input->post()) {
        $this->Ayam_sakit_model->insert();
        redirect('ayam_sakit');
    }

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('ayam_sakit/form', $data);
    $this->load->view('templates/footer');
}


    public function edit($id)
    {
        $data['title']   = 'Edit Ayam Sakit';
        $data['row']     = $this->Ayam_sakit_model->getById($id);
        $data['unit']    = $this->Unit_usaha_model->get_all();
        $data['kandang'] = $this->Kandang_model->get_all();

        if ($this->input->post()) {
            $this->Ayam_sakit_model->update($id);
            redirect('ayam_sakit');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('ayam_sakit/form', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Ayam_sakit_model->delete($id);
        redirect('ayam_sakit');
    }
}
