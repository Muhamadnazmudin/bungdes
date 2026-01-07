<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_besar_model extends CI_Model {

    // daftar akun aktif
    public function get_akun()
    {
        return $this->db
            ->select('id, kode, nama, saldo_normal')
            ->where('aktif', 1)
            ->order_by('kode', 'ASC')
            ->get('akun')
            ->result();
    }

    // ambil akun by id
    public function get_akun_by_id($akun_id)
    {
        return $this->db
            ->select('id, kode, nama, saldo_normal')
            ->where('id', $akun_id)
            ->get('akun')
            ->row();
    }

    // buku besar per akun (SALDO DIHITUNG DI SINI)
    public function get_buku_besar($akun_id)
    {
        $akun = $this->get_akun_by_id($akun_id);
        if (!$akun) return [];

        $rows = $this->db
            ->select('
                j.tanggal,
                j.no_bukti,
                j.keterangan,
                d.debit,
                d.kredit
            ')
            ->from('jurnal_detail d')
            ->join('jurnal j', 'j.id = d.jurnal_id')
            ->where('d.akun_id', $akun_id)
            ->order_by('j.tanggal', 'ASC')
            ->order_by('j.id', 'ASC')
            ->get()
            ->result();

        $saldo = 0;
        $result = [];

        foreach ($rows as $r) {

            if ($akun->saldo_normal === 'DEBIT') {
                // ASET / BEBAN
                $saldo += ($r->debit - $r->kredit);
            } else {
                // KEWAJIBAN / MODAL / PENDAPATAN
                $saldo += ($r->kredit - $r->debit);
            }

            $r->saldo = $saldo;
            $result[] = $r;
        }

        return $result;
    }
}
