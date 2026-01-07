<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_telur extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model([
            'Produksi_telur_model',
            'Kandang_model',
            'Unit_usaha_model'
        ]);
    }

    public function index()
    {
        $data['title'] = 'Produksi Telur';
        $data['data']  = $this->Produksi_telur_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('produksi_telur/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Produksi_telur_model->insert($this->input->post());
            redirect('produksi_telur');
        }

        $data['title']      = 'Input Produksi Telur';
        $data['kandang']    = $this->Kandang_model->get_all();
        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('produksi_telur/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->Produksi_telur_model->update($id, $this->input->post());
            redirect('produksi_telur');
        }

        $data['title']      = 'Edit Produksi Telur';
        $data['data']       = $this->Produksi_telur_model->get_by_id($id);
        $data['kandang']    = $this->Kandang_model->get_all();
        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('produksi_telur/edit', $data);
        $this->load->view('templates/footer');
    }
}
