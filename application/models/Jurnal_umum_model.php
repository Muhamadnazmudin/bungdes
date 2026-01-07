<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_umum_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('
                j.id,
                j.tanggal,
                j.no_bukti,
                j.keterangan,
                u.nama AS nama_unit,
                a.kode AS kode_akun,
                a.nama AS nama_akun,
                d.debit,
                d.kredit
            ')
            ->from('jurnal j')
            ->join('jurnal_detail d', 'd.jurnal_id = j.id')
            ->join('akun a', 'a.id = d.akun_id')
            ->join('unit_usaha u', 'u.id = j.unit_usaha_id', 'left')
            ->order_by('j.tanggal', 'ASC')
            ->order_by('j.id', 'ASC')
            ->get()
            ->result();
    }
}
