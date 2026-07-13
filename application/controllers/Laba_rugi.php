<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        $this->load->model([
            'Laba_rugi_model',
            'Posting_shu_model',
            'Transaksi_keuangan_model'
        ]);

        $this->load->library('dompdf_lib');
    }

    /* =====================================================
     * LAPORAN
     * ===================================================== */

   public function index()
{
    $dari   = $this->input->get('dari', TRUE);
    $sampai = $this->input->get('sampai', TRUE);

    /*
    |--------------------------------------------------------------------------
    | Default Periode
    |--------------------------------------------------------------------------
    */

    if (empty($dari)) {
        $dari = date('Y-01-01');
    }

    if (empty($sampai)) {
        $sampai = date('Y-12-31');
    }

    $laporan = $this->Laba_rugi_model
                    ->get_laporan($dari, $sampai);

    $data = [

        'title'   => 'Laporan Laba Rugi',

        'dari'    => $dari,

        'sampai'  => $sampai,

        'laporan' => $laporan,

        'pendapatan' => $laporan['pendapatan'],

        'beban' => $laporan['beban'],

        'posting_shu' => $this->Transaksi_keuangan_model
                              ->sudah_posting_shu(
                                  $dari,
                                  $sampai
                              )

    ];

    $this->load->view('templates/header',$data);
    $this->load->view('laba_rugi/index',$data);
    $this->load->view('templates/footer');
}
    /* =====================================================
 * CETAK PDF
 * ===================================================== */

/* =====================================================
 * CETAK PDF
 * ===================================================== */

public function cetak_pdf()
{
    /*
    |--------------------------------------------------------------------------
    | Periode
    |--------------------------------------------------------------------------
    */

    $dari   = $this->input->get('dari', TRUE);
    $sampai = $this->input->get('sampai', TRUE);

    if (empty($dari)) {
        $dari = date('Y-01-01');
    }

    if (empty($sampai)) {
        $sampai = date('Y-12-31');
    }

    /*
    |--------------------------------------------------------------------------
    | Ambil Data Laporan
    |--------------------------------------------------------------------------
    */

    $laporan = $this->Laba_rugi_model
                    ->get_laporan(
                        $dari,
                        $sampai
                    );

    $data = [

        'title'      => 'Laporan Laba Rugi',

        'dari'       => $dari,

        'sampai'     => $sampai,

        'laporan'    => $laporan,

        'pendapatan' => $laporan['pendapatan'],

        'beban'      => $laporan['beban']

    ];

    /*
    |--------------------------------------------------------------------------
    | HTML
    |--------------------------------------------------------------------------
    */

    $html = $this->load->view(
        'laba_rugi/cetak_pdf',
        $data,
        TRUE
    );

    /*
    |--------------------------------------------------------------------------
    | Dompdf
    |--------------------------------------------------------------------------
    */

    $this->load->library('dompdf_lib');

    $pdf = $this->dompdf_lib->create();

    $pdf->loadHtml($html);

    $pdf->setPaper('A4', 'portrait');

    $pdf->render();

    /*
    |--------------------------------------------------------------------------
    | Output
    |--------------------------------------------------------------------------
    */

    $pdf->stream(

        'Laporan_Laba_Rugi_' .
        date('Ymd', strtotime($dari)) .
        '_' .
        date('Ymd', strtotime($sampai)) .
        '.pdf',

        [
            'Attachment' => true
        ]

    );
}

    /* =====================================================
     * EXPORT EXCEL
     * ===================================================== */

    public function export_excel()
    {
        echo "Export Excel akan dibuat pada Part 4";
    }
/* =====================================================
 * POSTING SHU
 * ===================================================== */

public function posting_shu()
{
    /*
    |--------------------------------------------------------------------------
    | Ambil Periode
    |--------------------------------------------------------------------------
    */

    $bulan = (int) $this->input->post('bulan');
    $tahun = (int) $this->input->post('tahun');

    if ($bulan < 1 || $bulan > 12 || $tahun < 2000) {

        $this->session->set_flashdata(
            'error',
            'Periode tidak valid.'
        );

        redirect('laba_rugi');
    }

    /*
    |--------------------------------------------------------------------------
    | Periode
    |--------------------------------------------------------------------------
    */

    $dari = $tahun . '-' . sprintf('%02d', $bulan) . '-01';

    $sampai = date(
        'Y-m-t',
        strtotime($dari)
    );

    /*
    |--------------------------------------------------------------------------
    | Generate Posting SHU
    |--------------------------------------------------------------------------
    */

    $hasil = $this->Transaksi_keuangan_model
                  ->generate_shu($bulan, $tahun);

    if ($hasil) {

        $this->session->set_flashdata(
            'success',
            'Posting SHU berhasil dilakukan.'
        );

    } else {

        $this->session->set_flashdata(
            'error',
            'Posting SHU gagal atau SHU sudah pernah diposting.'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | Kembali ke periode yang sama
    |--------------------------------------------------------------------------
    */

    redirect(
        'laba_rugi?dari=' . $dari .
        '&sampai=' . $sampai
    );
}

}