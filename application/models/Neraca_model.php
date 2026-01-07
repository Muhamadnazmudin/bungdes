<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca_model extends CI_Model {

    // ASET = saldo akun ASET
    public function get_aset()
    {
        return $this->db
            ->select('a.kode, a.nama,
                SUM(d.debit - d.kredit) as saldo')
            ->from('akun a')
            ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
            ->where('a.jenis', 'ASET')
            ->group_by('a.id')
            ->having('saldo !=', 0)
            ->get()
            ->result();
    }

    // KEWAJIBAN
    public function get_kewajiban()
    {
        return $this->db
            ->select('a.kode, a.nama,
                SUM(d.kredit - d.debit) as saldo')
            ->from('akun a')
            ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
            ->where('a.jenis', 'KEWAJIBAN')
            ->group_by('a.id')
            ->having('saldo !=', 0)
            ->get()
            ->result();
    }

    // MODAL
    public function get_modal()
    {
        return $this->db
            ->select('a.kode, a.nama,
                SUM(d.kredit - d.debit) as saldo')
            ->from('akun a')
            ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
            ->where('a.jenis', 'MODAL')
            ->group_by('a.id')
            ->having('saldo !=', 0)
            ->get()
            ->result();
    }
    public function get_laba_ditahan()
{
    $this->load->model('Laba_rugi_model');
    return $this->Laba_rugi_model->get_laba_rugi();
}

}
