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
    $bulan = $this->input->get('bulan');
    $tahun = $this->input->get('tahun');

    if (!$bulan) {
        $bulan = date('n');
    }

    if (!$tahun) {
        $tahun = date('Y');
    }

    $laporan = $this->Laba_rugi_model->get_laporan($bulan, $tahun);

    $data = [

        'title'      => 'Laporan Laba Rugi',

        'bulan'      => $bulan,

        'tahun'      => $tahun,

        'pendapatan' => $laporan['pendapatan'],

        'beban'      => $laporan['beban'],

        'laporan'    => $laporan,

        'posting_shu' => $this->Transaksi_keuangan_model
                              ->sudah_posting_shu($bulan,$tahun)

    ];

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

        $$laporan = $this->Laba_rugi_model->get_laporan($bulan,$tahun);

$data = [
    'bulan'=>$bulan,
    'tahun'=>$tahun,
    'laporan'=>$laporan,
    'pendapatan'=>$laporan['pendapatan'],
    'beban'=>$laporan['beban']
];

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
/* =====================================================
 * POSTING SHU
 * ===================================================== */

public function posting_shu()
{
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');

    if (!$bulan || !$tahun) {

        $this->session->set_flashdata(
            'error',
            'Periode belum dipilih.'
        );

        redirect('laba_rugi');
    }

    /*
|--------------------------------------------------------------------------
| Sudah posting?
|--------------------------------------------------------------------------
*/

if ($this->Transaksi_keuangan_model
        ->sudah_posting_shu($bulan,$tahun)) {

    $this->session->set_flashdata(

        'error',

        'SHU periode tersebut sudah pernah diposting.'

    );

    redirect(
        'laba_rugi?bulan='.$bulan.'&tahun='.$tahun
    );

}

    /*
    |--------------------------------------------------------------------------
    | Hitung SHU
    |--------------------------------------------------------------------------
    */

    $hasil = $this->Laba_rugi_model
                ->get_laporan($bulan,$tahun);

    /*
    |--------------------------------------------------------------------------
    | Simpan Header Posting
    |--------------------------------------------------------------------------
    */

    $posting_id = $this->Posting_shu_model
                        ->simpanPosting(
                            $bulan,
                            $tahun,
                            $hasil
                        );

    /*
    |--------------------------------------------------------------------------
    | Tanggal Posting
    |--------------------------------------------------------------------------
    */

    $tanggal = date(
        'Y-m-t',
        strtotime($tahun.'-'.$bulan.'-01')
    );

    /*
    |--------------------------------------------------------------------------
    | Data Pembagian SHU
    |--------------------------------------------------------------------------
    */

    foreach($hasil['pembagian'] as $item){

        $akun_id = $this->getAkunShu($item['nama']);

        if(!$akun_id){
            continue;
        }

        $this->Transaksi_keuangan_model->insert([

            'tanggal'         => $tanggal,

            'jenis'           => 'KELUAR',

            'kas_id' => $hasil['kas_id'],

            'akun_id'         => $akun_id,

            'unit_usaha_id' => $hasil['unit_usaha_id'],

            'posting_shu_id'  => $posting_id,

            'sumber'          => 'POSTING_SHU',

            'referensi_id'    => $posting_id,

            'nominal'         => $item['nominal'],

            'keterangan'      => $item['nama'].' Bulan '.$bulan.' Tahun '.$tahun

        ]);

    }

    $this->session->set_flashdata(
        'success',
        'Posting SHU berhasil dilakukan.'
    );

    redirect(
        'laba_rugi?bulan='.$bulan.'&tahun='.$tahun
    );

}
/* =====================================================
 * MAPPING AKUN SHU
 * ===================================================== */

private function getAkunShu($nama)
{

    $mapping = [

        'Insentif Penasehat / Kepala Desa' => 'Beban Insentif Kepala Desa',

        'PADes' => 'Beban PADes',

        'Dana Sosial' => 'Beban Dana Sosial',

        'Jasa Produksi' => 'Beban Jasa Produksi',

        'Cadangan' => 'Beban Cadangan',

        'Kesejahteraan' => 'Beban Kesejahteraan'

    ];

    if(!isset($mapping[$nama])){
        return null;
    }

    $akun = $this->db
                ->where('nama',$mapping[$nama])
                ->get('akun')
                ->row();

    return $akun ? $akun->id : null;

}
}