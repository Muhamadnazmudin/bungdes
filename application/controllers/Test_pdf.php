<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_pdf extends CI_Controller {

    public function index()
    {
        $this->load->library('dompdf_lib');

        $pdf = $this->dompdf_lib->create();

        $html = '
            <h3>TEST PDF</h3>
            <p>Dompdf 2.0.8 berhasil di CI3 + PHP 7.4</p>
        ';

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('test.pdf', ['Attachment' => false]);
    }
}
