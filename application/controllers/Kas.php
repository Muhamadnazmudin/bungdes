<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model(['Kas_model','Akun_model']);
    }

    public function index()
    {
        $data['title'] = 'Kas & Bank';
        $data['kas']   = $this->Kas_model->get_all();

        $this->load->view('templates/header',$data);
        
        
        $this->load->view('kas/index',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Kas_model->insert($this->input->post());
            redirect('kas');
        }

        $data['title'] = 'Tambah Kas';
        $data['akun']  = $this->Akun_model->get_kas_bank(); // hanya akun kas/bank

        $this->load->view('templates/header',$data);
        
        
        $this->load->view('kas/tambah',$data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->Kas_model->update($id,$this->input->post());
            redirect('kas');
        }

        $data['title'] = 'Edit Kas';
        $data['kas']   = $this->Kas_model->get_by_id($id);
        $data['akun']  = $this->Akun_model->get_kas_bank();

        $this->load->view('templates/header',$data);
        
        
        $this->load->view('kas/edit',$data);
        $this->load->view('templates/footer');
    }
}
