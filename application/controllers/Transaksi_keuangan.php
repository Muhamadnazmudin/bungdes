<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan extends CI_Controller {

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

    public function index()
    {
        $data['title'] = 'Transaksi Keuangan';
        $data['data']  = $this->Transaksi_keuangan_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi_keuangan/index',$data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->input->post()) {
            $this->Transaksi_keuangan_model->insert($this->input->post());
            redirect('transaksi_keuangan');
        }

        $data['title']      = 'Input Transaksi';
        $data['kas']        = $this->Kas_model->get_all();
        $data['akun']       = $this->Akun_model->get_all();
        $data['unit_usaha'] = $this->Unit_usaha_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('transaksi_keuangan/tambah',$data);
        $this->load->view('templates/footer');
    }
    public function edit($id)
{
    // ambil data transaksi
    $data['transaksi'] = $this->Transaksi_keuangan_model->get_by_id($id);

    if (!$data['transaksi']) {
        show_404();
    }

    // jika submit
    if ($_POST) {

        // 1. HAPUS JURNAL LAMA
        $this->Transaksi_keuangan_model->delete_jurnal($id);

        // 2. UPDATE TRANSAKSI
        $this->Transaksi_keuangan_model->update($id, $this->input->post());

        // 3. BUAT JURNAL BARU
        $this->Transaksi_keuangan_model->recreate_jurnal($id);

        redirect('transaksi_keuangan');
    }

    // data untuk form
    $data['title'] = 'Edit Transaksi Keuangan';
    $data['kas']   = $this->Transaksi_keuangan_model->get_kas();
    $data['akun']  = $this->Transaksi_keuangan_model->get_akun();
    $data['unit']  = $this->Transaksi_keuangan_model->get_unit_usaha();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar');
    $this->load->view('transaksi_keuangan/edit', $data);
    $this->load->view('templates/footer');
}

}
