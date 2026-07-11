<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model('Laba_rugi_model');
        $this->load->library('dompdf_lib');
    }

    /* =====================================================
     * LAPORAN
     * ===================================================== */

    public function index()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$tahun) {
            $tahun = date('Y');
        }

        $data['title'] = 'Laporan Laba Rugi';

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['pendapatan'] = $this->Laba_rugi_model
            ->get_pendapatan($bulan,$tahun);

        $data['beban'] = $this->Laba_rugi_model
            ->get_beban($bulan,$tahun);

        $this->load->view('templates/header',$data);
        $this->load->view('laba_rugi/index',$data);
        $this->load->view('templates/footer');
    }


    /* =====================================================
     * CETAK PDF
     * ===================================================== */

    public function cetak_pdf()
    {
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');

        if (!$tahun) {
            $tahun = date('Y');
        }

        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $data['pendapatan'] = $this->Laba_rugi_model
            ->get_pendapatan($bulan,$tahun);

        $data['beban'] = $this->Laba_rugi_model
            ->get_beban($bulan,$tahun);

        $html = $this->load->view(
            'laba_rugi/cetak_pdf',
            $data,
            true
        );

        $pdf = $this->dompdf_lib->create();

        $pdf->loadHtml($html);

        $pdf->setPaper('A4','portrait');

        $pdf->render();

        $pdf->stream(
            'Laporan_Laba_Rugi.pdf',
            ['Attachment'=>false]
        );
    }


    /* =====================================================
     * EXPORT EXCEL
     * ===================================================== */

    public function export_excel()
    {
        echo "Export Excel akan dibuat pada Part 4";
    }

}