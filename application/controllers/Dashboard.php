<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('Dashboard_model');
        if (!$this->session->userdata('login')) {
        redirect('auth/login');

        $this->load->model('Dashboard_model');
    }
    }

    public function index()
{
    $data['title']='Dashboard';

    $data['pendapatan']=$this->Dashboard_model->totalPendapatan();

    $data['pengeluaran']=$this->Dashboard_model->totalPengeluaran();

    $data['saldo']=$this->Dashboard_model->saldoKas();

    $data['produksi']=$this->Dashboard_model->totalProduksi();

    $data['penjualan']=$this->Dashboard_model->totalPenjualan();

    $data['stok']=$this->Dashboard_model->stokTelur();

    $data['populasi_awal']
    = $this->Dashboard_model->populasiAwal();

$data['populasi']
    = $this->Dashboard_model->populasiAktif();

$data['ayam_mati']
    = $this->Dashboard_model->ayamMati();

$data['ayam_sakit']
    = $this->Dashboard_model->ayamSakit();

    $data['ayam_mati']=$this->Dashboard_model->ayamMati();

    $data['ayam_sakit']=$this->Dashboard_model->ayamSakit();

    $data['transaksi']=$this->Dashboard_model->transaksiTerbaru();

    $this->load->view('templates/header',$data);
    $this->load->view('dashboard/index',$data);
    $this->load->view('templates/footer');
}
}
