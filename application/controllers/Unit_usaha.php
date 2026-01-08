<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_usaha extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        // hanya Admin & Bendahara
        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model('Unit_usaha_model');
    }

    public function index()
    {
        $data['title'] = 'Unit Usaha';
        $data['unit']  = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('unit_usaha/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Unit_usaha_model->insert($this->input->post());
            redirect('unit_usaha');
        }

        $data['title'] = 'Tambah Unit Usaha';

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('unit_usaha/tambah');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->Unit_usaha_model->update($id, $this->input->post());
            redirect('unit_usaha');
        }

        $data['title'] = 'Edit Unit Usaha';
        $data['unit']  = $this->Unit_usaha_model->get_by_id($id);

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('unit_usaha/edit', $data);
        $this->load->view('templates/footer');
    }
    public function delete($id)
{
    // hanya admin
    if ($this->session->userdata('role_id') != 1) {
        show_error('Akses ditolak');
    }

    $this->Unit_usaha_model->soft_delete($id);
    redirect('unit_usaha');
}

}
