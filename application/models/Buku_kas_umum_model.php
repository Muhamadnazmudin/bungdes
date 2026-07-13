<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_kas_umum_model extends CI_Model
{

    /* =====================================================
     * DAFTAR KAS / BANK
     * ===================================================== */

    public function get_kas_list()
    {
        return $this->db
            ->select("
                k.id,
                k.kode,
                k.nama,
                k.akun_id,
                k.saldo_awal,
                a.kode AS kode_akun,
                a.nama AS nama_akun
            ")
            ->from('kas k')
            ->join('akun a','a.id=k.akun_id')
            ->where('k.aktif',1)
            ->order_by('k.nama','ASC')
            ->get()
            ->result();
    }

    /* =====================================================
     * DETAIL KAS
     * ===================================================== */

    public function get_kas($kas_id)
    {
        return $this->db
            ->where('id',$kas_id)
            ->get('kas')
            ->row();
    }

    /* =====================================================
     * SALDO AWAL
     * ===================================================== */

    public function get_saldo_awal($kas_id)
    {
        $kas = $this->get_kas($kas_id);

        if(!$kas){
            return 0;
        }

        return (float)$kas->saldo_awal;
    }

    /* =====================================================
     * BUKU KAS
     * ===================================================== */

    public function get_buku_kas($kas_id,$tgl_awal=null,$tgl_akhir=null)
    {
        $kas = $this->get_kas($kas_id);

        if(!$kas){
            return [];
        }

        $this->db
            ->select("
                j.id,
                j.tanggal,
                j.no_bukti,
                j.keterangan,
                d.debit,
                d.kredit
            ")
            ->from('jurnal_detail d')
            ->join('jurnal j','j.id=d.jurnal_id')
            ->where('d.akun_id',$kas->akun_id);

        if(!empty($tgl_awal)){
            $this->db->where('j.tanggal >=',$tgl_awal);
        }

        if(!empty($tgl_akhir)){
            $this->db->where('j.tanggal <=',$tgl_akhir);
        }

        $this->db
            ->order_by('j.tanggal','ASC')
            ->order_by('j.id','ASC');

        $rows = $this->db->get()->result();

        /*
        |----------------------------------------------------
        | Hitung saldo berjalan
        |----------------------------------------------------
        */

        $saldo = (float)$kas->saldo_awal;

        foreach($rows as &$r){

            $saldo += ($r->debit - $r->kredit);

            $r->saldo = $saldo;

        }

        return $rows;
    }

    /* =====================================================
     * TOTAL DEBIT
     * ===================================================== */

    public function total_debit($data)
    {
        $total = 0;

        foreach($data as $d){

            $total += $d->debit;

        }

        return $total;
    }

    /* =====================================================
     * TOTAL KREDIT
     * ===================================================== */

    public function total_kredit($data)
    {
        $total = 0;

        foreach($data as $d){

            $total += $d->kredit;

        }

        return $total;
    }

    /* =====================================================
     * SALDO AKHIR
     * ===================================================== */

    public function saldo_akhir($kas_id,$data)
    {
        return
            $this->get_saldo_awal($kas_id)
            + $this->total_debit($data)
            - $this->total_kredit($data);
    }

}