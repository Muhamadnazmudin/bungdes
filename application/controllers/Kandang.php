<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandang extends CI_Controller {

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

        $this->load->model('Kandang_model');
    }

    public function index()
    {
        $data['title'] = 'Kandang';

        if ($this->session->userdata('role_id') == 1) {
            $data['kandang'] = $this->Kandang_model->get_all_with_inactive();
        } else {
            $data['kandang'] = $this->Kandang_model->get_all();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kandang/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Kandang_model->insert($this->input->post());
            redirect('kandang');
        }

        $data['title'] = 'Tambah Kandang';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kandang/tambah');
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->Kandang_model->update($id, $this->input->post());
            redirect('kandang');
        }

        $data['title']   = 'Edit Kandang';
        $data['kandang'] = $this->Kandang_model->get_by_id($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('kandang/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        // hanya admin
        if ($this->session->userdata('role_id') != 1) {
            show_error('Akses ditolak');
        }

        $this->Kandang_model->soft_delete($id);
        redirect('kandang');
    }
}
