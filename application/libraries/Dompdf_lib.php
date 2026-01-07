<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib {

    public function create()
    {
        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);

        return new Dompdf($options);
    }
}
