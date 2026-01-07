<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function get_summary()
    {
        return [
            'saldo_kas' => 0,
            'pendapatan' => 0,
            'beban' => 0
        ];
    }
}
