<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_telur extends CI_Controller
{

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

    /* =====================================================
     * LIST
     * ===================================================== */

    public function index()
    {
        $data['title'] = 'Produksi Telur';
        $data['data']  = $this->Produksi_telur_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('produksi_telur/index',$data);
        $this->load->view('templates/footer');
    }


    /* =====================================================
     * FORM TAMBAH
     * ===================================================== */

    public function tambah()
    {
        $data['title'] = 'Input Produksi Telur';

        $data['kandang'] = $this->Kandang_model->get_all();

        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('produksi_telur/tambah',$data);
        $this->load->view('templates/footer');
    }


    /* =====================================================
     * SIMPAN
     * ===================================================== */

    public function simpan()
    {
        $this->Produksi_telur_model->insert($this->input->post());

        $this->session->set_flashdata(
            'success',
            'Produksi telur berhasil disimpan.'
        );

        redirect('produksi_telur');
    }


    /* =====================================================
     * FORM EDIT
     * ===================================================== */

    public function edit($id)
    {
        $data['title'] = 'Edit Produksi Telur';

        $data['data'] = $this->Produksi_telur_model->get_by_id($id);

        if(!$data['data']){
            show_404();
        }

        $data['kandang'] = $this->Kandang_model->get_all();

        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('produksi_telur/edit',$data);
        $this->load->view('templates/footer');
    }


    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id)
    {
        $this->Produksi_telur_model->update(
            $id,
            $this->input->post()
        );

        $this->session->set_flashdata(
            'success',
            'Produksi telur berhasil diperbarui.'
        );

        redirect('produksi_telur');
    }


    /* =====================================================
     * HAPUS
     * ===================================================== */

    public function hapus($id)
    {
        $this->Produksi_telur_model->delete($id);

        $this->session->set_flashdata(
            'success',
            'Produksi telur berhasil dihapus.'
        );

        redirect('produksi_telur');
    }

}