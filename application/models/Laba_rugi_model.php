<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi_model extends CI_Model {

    // Pendapatan (saldo normal KREDIT)
    public function get_pendapatan()
    {
        return $this->db
            ->select('a.kode, a.nama,
                SUM(d.kredit - d.debit) as total')
            ->from('akun a')
            ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
            ->where('a.jenis', 'PENDAPATAN')
            ->group_by('a.id')
            ->having('total !=', 0)
            ->get()
            ->result();
    }

    // Beban (saldo normal DEBIT)
    public function get_beban()
    {
        return $this->db
            ->select('a.kode, a.nama,
                SUM(d.debit - d.kredit) as total')
            ->from('akun a')
            ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
            ->where('a.jenis', 'BEBAN')
            ->group_by('a.id')
            ->having('total !=', 0)
            ->get()
            ->result();
    }
    public function get_laba_rugi()
{
    $pendapatan = $this->db
        ->select('SUM(d.kredit - d.debit) as total')
        ->from('akun a')
        ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
        ->where('a.jenis', 'PENDAPATAN')
        ->get()->row()->total ?? 0;

    $beban = $this->db
        ->select('SUM(d.debit - d.kredit) as total')
        ->from('akun a')
        ->join('jurnal_detail d', 'd.akun_id = a.id', 'left')
        ->where('a.jenis', 'BEBAN')
        ->get()->row()->total ?? 0;

    return $pendapatan - $beban;
}

}
