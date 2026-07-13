<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi_model extends CI_Model
{
public function __construct()
{
    parent::__construct();

    $this->load->model('Master_shu_model');
}
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
/* =====================================================
 * LAPORAN LABA RUGI
 * ===================================================== */

public function get_laporan($bulan=null,$tahun=null)
{

    $pendapatan = $this->get_pendapatan($bulan,$tahun);

    $beban = $this->get_beban($bulan,$tahun);

    /*
    |--------------------------------------------------------------------------
    | TOTAL
    |--------------------------------------------------------------------------
    */

    $total_pendapatan = 0;

    foreach($pendapatan as $r){

        $total_pendapatan += $r->total;

    }

    $total_beban = 0;

    foreach($beban as $r){

        $total_beban += $r->total;

    }

    /*
    |--------------------------------------------------------------------------
    | LABA USAHA
    |--------------------------------------------------------------------------
    */

    $laba_usaha = $total_pendapatan - $total_beban;

    /*
    |--------------------------------------------------------------------------
    | MASTER SHU
    |--------------------------------------------------------------------------
    */

    $master = $this->Master_shu_model
                    ->get_all();

    $detail = [];

    $sisa_shu = $laba_usaha;

    $total_pembagian = 0;

    foreach($master as $m){

        /*
        -----------------------------------
        Dasar Perhitungan
        -----------------------------------
        */

        if($m->dasar == 'LABA_USAHA'){

            $dasar = $laba_usaha;

        }else{

            $dasar = $sisa_shu;

        }

        /*
        -----------------------------------
        Nominal
        -----------------------------------
        */

        $nominal = $dasar * $m->persentase / 100;

        $detail[] = [

            'id'=>$m->id,

            'nama'=>$m->nama,

            'akun_id'=>$m->akun_id,

            'persentase'=>$m->persentase,

            'dasar'=>$m->dasar,

            'nominal'=>$nominal

        ];

        /*
        -----------------------------------
        Jika dihitung dari laba usaha
        maka mengurangi sisa SHU
        -----------------------------------
        */

        if($m->dasar == 'LABA_USAHA'){

            $sisa_shu -= $nominal;

        }else{

            $total_pembagian += $nominal;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | LABA
    |--------------------------------------------------------------------------
    */

    $laba = $sisa_shu - $total_pembagian;

    /*
    |--------------------------------------------------------------------------
    | PPN
    |--------------------------------------------------------------------------
    */

    $ppn = $laba * 12 / 100;

    /*
    |--------------------------------------------------------------------------
    | LABA BERSIH
    |--------------------------------------------------------------------------
    */

    $laba_bersih = $laba - $ppn;

    return [

        'pendapatan'=>$pendapatan,

        'beban'=>$beban,

        'total_pendapatan'=>$total_pendapatan,

        'total_beban'=>$total_beban,

        'laba_usaha'=>$laba_usaha,

        'master_shu'=>$detail,

        'sisa_shu'=>$sisa_shu,

        'total_pembagian'=>$total_pembagian,

        'laba'=>$laba,

        'ppn'=>$ppn,

        'laba_bersih'=>$laba_bersih

    ];

}
}