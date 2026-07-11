<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan extends CI_Controller
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
            'Transaksi_keuangan_model',
            'Kas_model',
            'Akun_model',
            'Unit_usaha_model'
        ]);
    }

    /* =====================================================
     * LIST DATA
     * ===================================================== */

    public function index()
    {
        $data['title'] = 'Transaksi Keuangan';
        $data['data']  = $this->Transaksi_keuangan_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/index', $data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * FORM TAMBAH
     * ===================================================== */

    public function tambah()
    {
        $data['title'] = 'Tambah Transaksi Keuangan';

        $data['kas']        = $this->Kas_model->get_all();
        $data['akun']       = $this->Akun_model->get_all();
        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/tambah', $data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * SIMPAN
     * ===================================================== */

    public function simpan()
    {
        $this->Transaksi_keuangan_model->insert($this->input->post());

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil disimpan.'
        );

        redirect('transaksi_keuangan');
    }

    /* =====================================================
     * FORM EDIT
     * ===================================================== */

    public function edit($id)
    {
        $data['title'] = 'Edit Transaksi Keuangan';

        $data['transaksi'] = $this->Transaksi_keuangan_model->get_by_id($id);

        if (!$data['transaksi']) {
            show_404();
        }

        $data['kas']        = $this->Kas_model->get_all();
        $data['akun']       = $this->Akun_model->get_all();
        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/edit', $data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id)
    {
        $this->Transaksi_keuangan_model->delete_jurnal($id);

        $this->Transaksi_keuangan_model->update(
            $id,
            $this->input->post()
        );

        $this->Transaksi_keuangan_model->recreate_jurnal($id);

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil diperbarui.'
        );

        redirect('transaksi_keuangan');
    }

    /* =====================================================
     * HAPUS
     * ===================================================== */

    public function hapus($id)
    {
        $this->Transaksi_keuangan_model->delete_jurnal($id);

        $this->Transaksi_keuangan_model->delete($id);

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil dihapus.'
        );

        redirect('transaksi_keuangan');
    }

}