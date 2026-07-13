<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_kas_umum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Buku_kas_umum_model');
    }

    /* =====================================================
     * BUKU KAS UMUM
     * ===================================================== */

    public function index()
    {
        $kas_id    = $this->input->get('kas_id');

        $tgl_awal  = $this->input->get('tgl_awal');

        $tgl_akhir = $this->input->get('tgl_akhir');

        $data = [

            'title' => 'Buku Kas Umum',

            'kas'   => $this->Buku_kas_umum_model->get_kas_list(),

            'kas_id'    => $kas_id,

            'tgl_awal'  => $tgl_awal,

            'tgl_akhir' => $tgl_akhir,

            'detail_kas' => null,

            'saldo_awal' => 0,

            'total_debit' => 0,

            'total_kredit' => 0,

            'saldo_akhir' => 0,

            'data' => []

        ];

        if(!empty($kas_id)){

            $rows = $this->Buku_kas_umum_model
                        ->get_buku_kas(
                            $kas_id,
                            $tgl_awal,
                            $tgl_akhir
                        );

            $data['detail_kas'] = $this->Buku_kas_umum_model
                                        ->get_kas($kas_id);

            $data['saldo_awal'] = $this->Buku_kas_umum_model
                                        ->get_saldo_awal($kas_id);

            $data['total_debit'] = $this->Buku_kas_umum_model
                                        ->total_debit($rows);

            $data['total_kredit'] = $this->Buku_kas_umum_model
                                        ->total_kredit($rows);

            $data['saldo_akhir'] = $this->Buku_kas_umum_model
                                        ->saldo_akhir(
                                            $kas_id,
                                            $rows
                                        );

            $data['data'] = $rows;

        }

        $this->load->view('templates/header',$data);

        $this->load->view('buku_kas_umum/index',$data);

        $this->load->view('templates/footer');
    }

}