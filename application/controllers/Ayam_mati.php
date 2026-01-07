<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_mati extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ayam_mati_model');
        $this->load->model('Kandang_model');
    }

    public function index()
    {
        $data['title'] = 'Ayam Mati';
        $data['data']  = $this->Ayam_mati_model->getAll();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('ayam_mati/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title']   = 'Input Ayam Mati';
        $data['kandang'] = $this->Kandang_model->get_all();

        if ($this->input->post()) {
            $this->Ayam_mati_model->insert();
            redirect('ayam_mati');
        }

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('ayam_mati/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title']   = 'Edit Ayam Mati';
        $data['row']     = $this->Ayam_mati_model->getById($id);
        $data['kandang'] = $this->Kandang_model->get_all();

        if ($this->input->post()) {
            $this->Ayam_mati_model->update($id);
            redirect('ayam_mati');
        }

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('ayam_mati/form', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($id)
    {
        $this->Ayam_mati_model->delete($id);
        redirect('ayam_mati');
    }
}
