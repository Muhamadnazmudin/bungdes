<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_hidup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ayam_hidup_model');
        $this->load->library('dompdf_lib');
    }

    public function index()
    {
        $data['title'] = 'Ayam Hidup';
        $data['data']  = $this->Ayam_hidup_model->getBukuPopulasi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('ayam_hidup/index', $data);
        $this->load->view('templates/footer');
    }
    public function cetak_pdf()
{
    // PAKAI METHOD YANG ADA
    $data['data'] = $this->Ayam_hidup_model->getBukuPopulasi();

    $html = $this->load->view(
        'ayam_hidup/cetak_pdf',
        $data,
        true
    );

    $pdf = $this->dompdf_lib->create();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'portrait');
    $pdf->render();
    $pdf->stream(
        'Laporan_Ayam.pdf',
        ['Attachment' => false]
    );
}

}
