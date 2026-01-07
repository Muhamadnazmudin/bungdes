<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arus_kas_model extends CI_Model {

    /**
     * Ambil semua jurnal yang melibatkan akun KAS/BANK
     * Sekalian ambil akun lawannya untuk klasifikasi
     */
    private function base_query()
    {
        return $this->db
            ->select('
                j.id,
                j.tanggal,
                j.keterangan,
                dk.debit,
                dk.kredit,
                al.jenis AS jenis_lawan
            ')
            ->from('jurnal j')
            ->join('jurnal_detail dk', 'dk.jurnal_id = j.id')
            ->join('kas k', 'k.akun_id = dk.akun_id') // HANYA baris kas
            ->join('jurnal_detail dl', 'dl.jurnal_id = j.id AND dl.id != dk.id')
            ->join('akun al', 'al.id = dl.akun_id');
    }

    /**
     * OPERASIONAL
     * Lawan kas = pendapatan / beban
     */
    public function get_operasional()
    {
        return $this->base_query()
            ->where_in('al.jenis', ['PENDAPATAN', 'BEBAN'])
            ->get()
            ->result();
    }

    /**
     * INVESTASI / PENGEMBANGAN USAHA
     * Lawan kas = aset (selain kas)
     */
    public function get_investasi()
    {
        return $this->base_query()
            ->where('al.jenis', 'ASET')
            ->get()
            ->result();
    }

    /**
     * PENDANAAN
     * Lawan kas = modal
     */
    public function get_pendanaan()
    {
        return $this->base_query()
            ->where('al.jenis', 'MODAL')
            ->get()
            ->result();
    }
}
