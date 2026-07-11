<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi_model extends CI_Model
{

    /* =====================================================
     * PENDAPATAN
     * ===================================================== */

    public function get_pendapatan($bulan = null, $tahun = null)
    {

        $this->db
            ->select("
                a.id,
                a.kode,
                a.nama,
                SUM(d.kredit-d.debit) AS total
            ")
            ->from('akun a')
            ->join('jurnal_detail d','d.akun_id=a.id')
            ->join('jurnal j','j.id=d.jurnal_id')
            ->where('a.jenis','PENDAPATAN');

        if($bulan){

            $this->db->where('MONTH(j.tanggal)', $bulan);

        }

        if($tahun){

            $this->db->where('YEAR(j.tanggal)', $tahun);

        }

        return $this->db
            ->group_by('a.id')
            ->having('total <>',0)
            ->order_by('a.kode','ASC')
            ->get()
            ->result();

    }


    /* =====================================================
     * BEBAN
     * ===================================================== */

    public function get_beban($bulan = null,$tahun = null)
    {

        $this->db
            ->select("
                a.id,
                a.kode,
                a.nama,
                SUM(d.debit-d.kredit) AS total
            ")
            ->from('akun a')
            ->join('jurnal_detail d','d.akun_id=a.id')
            ->join('jurnal j','j.id=d.jurnal_id')
            ->where('a.jenis','BEBAN');

        if($bulan){

            $this->db->where('MONTH(j.tanggal)', $bulan);

        }

        if($tahun){

            $this->db->where('YEAR(j.tanggal)', $tahun);

        }

        return $this->db
            ->group_by('a.id')
            ->having('total <>',0)
            ->order_by('a.kode','ASC')
            ->get()
            ->result();

    }


    /* =====================================================
     * TOTAL LABA
     * ===================================================== */

    public function get_laba_rugi($bulan = null,$tahun = null)
    {

        $pendapatan = 0;

        foreach($this->get_pendapatan($bulan,$tahun) as $r){

            $pendapatan += $r->total;

        }

        $beban = 0;

        foreach($this->get_beban($bulan,$tahun) as $r){

            $beban += $r->total;

        }

        return $pendapatan - $beban;

    }

}