<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        // hanya admin & bendahara
        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model('Akun_model');
    }

    public function index()
{
    $data['title'] = 'Master Akun';

    if ($this->session->userdata('role_id') == 1) {
        $data['akun'] = $this->Akun_model->get_all_with_inactive();
    } else {
        $data['akun'] = $this->Akun_model->get_all();
    }

    $this->load->view('templates/header', $data);
    
    
    $this->load->view('akun/index', $data);
    $this->load->view('templates/footer');
}


    public function tambah()
    {
        if ($_POST) {
            $this->Akun_model->insert($this->input->post());
            redirect('akun');
        }

        $data['title'] = 'Tambah Akun';
        $data['parent'] = $this->Akun_model->get_all();

        $this->load->view('templates/header', $data);
        
        
        $this->load->view('akun/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
{
    if ($this->input->post()) {
        $this->Akun_model->update($id, $this->input->post());
        redirect('akun');
    }

    $data['title']  = 'Edit Akun';
    $data['akun']   = $this->Akun_model->get_by_id($id);
    $data['parent'] = $this->Akun_model->get_all_with_inactive();

    $this->load->view('templates/header', $data);
    
    
    $this->load->view('akun/edit', $data);
    $this->load->view('templates/footer');
}

    public function delete($id)
{
    if ($this->session->userdata('role_id') != 1) {
        show_error('Akses ditolak');
    }

    $this->Akun_model->soft_delete($id);
    redirect('akun');
}

}
