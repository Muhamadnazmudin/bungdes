<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
        
        // Admin & Bendahara
        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            show_error('Akses ditolak');
        }

        $this->load->model('Pajak_model');
    }

    public function index()
    {
        $data['title'] = 'Master Pajak';
        $data['pajak'] = $this->Pajak_model->get_all();
        if ($this->session->userdata('role_id') == 1) {
    $data['pajak'] = $this->Pajak_model->get_all_with_inactive();
} else {
    $data['pajak'] = $this->Pajak_model->get_all();
}


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pajak/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Pajak_model->insert($this->input->post());
            redirect('pajak');
        }

        $data['title'] = 'Tambah Pajak';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pajak/tambah');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->Pajak_model->update($id, $this->input->post());
            redirect('pajak');
        }

        $data['title'] = 'Edit Pajak';
        $data['pajak'] = $this->Pajak_model->get_by_id($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('pajak/edit', $data);
        $this->load->view('templates/footer');
    }
    public function delete($id)
{
    if ($this->session->userdata('role_id') != 1) {
        show_error('Akses ditolak');
    }

    $this->Pajak_model->soft_delete($id);
    redirect('pajak');
}

}
