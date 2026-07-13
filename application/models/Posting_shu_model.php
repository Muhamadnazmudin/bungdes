<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posting_shu_model extends CI_Model
{

    /* =====================================================
     * CEK SUDAH POSTING
     * ===================================================== */

    public function sudahPosting($bulan, $tahun)
    {
        return $this->db
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'POSTING')
            ->get('posting_shu')
            ->row();
    }


    /* =====================================================
     * PENDAPATAN
     * ===================================================== */

    public function getPendapatan($bulan, $tahun)
    {
        $this->db
            ->select('SUM(d.kredit-d.debit) AS total')
            ->from('akun a')
            ->join('jurnal_detail d','d.akun_id=a.id')
            ->join('jurnal j','j.id=d.jurnal_id')
            ->where('a.jenis','PENDAPATAN')
            ->where('MONTH(j.tanggal)', $bulan)
            ->where('YEAR(j.tanggal)', $tahun);

        $row = $this->db->get()->row();

        return $row ? (float)$row->total : 0;
    }


    /* =====================================================
     * BEBAN
     * ===================================================== */

    public function getBiaya($bulan, $tahun)
    {
        $this->db
            ->select('SUM(d.debit-d.kredit) AS total')
            ->from('akun a')
            ->join('jurnal_detail d','d.akun_id=a.id')
            ->join('jurnal j','j.id=d.jurnal_id')
            ->where('a.jenis','BEBAN')
            ->where('MONTH(j.tanggal)', $bulan)
            ->where('YEAR(j.tanggal)', $tahun);

        $row = $this->db->get()->row();

        return $row ? (float)$row->total : 0;
    }


    /* =====================================================
     * HITUNG SHU
     * ===================================================== */

    public function hitungShu($bulan, $tahun)
    {

        $pendapatan = $this->getPendapatan($bulan,$tahun);

        $beban = $this->getBiaya($bulan,$tahun);

        $laba_usaha = $pendapatan - $beban;

        /*
        |-------------------------------------------------------
        | Persentase
        |-------------------------------------------------------
        */

        $persen_pengurus      = 25;

        $persen_kades         = 5;

        $persen_pades         = 25;

        $persen_dana_sosial   = 10;

        $persen_jasa_produksi = 10;

        $persen_cadangan      = 10;

        $persen_kesejahteraan = 10;


        /*
        |-------------------------------------------------------
        | Gaji Pengurus
        |-------------------------------------------------------
        */

        $gaji_pengurus = $laba_usaha * $persen_pengurus / 100;


        /*
        |-------------------------------------------------------
        | Sisa SHU
        |-------------------------------------------------------
        */

        $sisa_shu = $laba_usaha - $gaji_pengurus;


        /*
        |-------------------------------------------------------
        | Pembagian SHU
        |-------------------------------------------------------
        */

        $kades = $sisa_shu * $persen_kades / 100;

        $pades = $sisa_shu * $persen_pades / 100;

        $dana_sosial = $sisa_shu * $persen_dana_sosial / 100;

        $jasa_produksi = $sisa_shu * $persen_jasa_produksi / 100;

        $cadangan = $sisa_shu * $persen_cadangan / 100;

        $kesejahteraan = $sisa_shu * $persen_kesejahteraan / 100;

        $kas_id  = $this->getKasDefault();

$unit_id = $this->getUnitUsahaDefault();
        return [

    'kas_id'        => $kas_id,

    'unit_usaha_id' => $unit_id,

    'pendapatan'    => $pendapatan,

    'beban'         => $beban,

    'laba_usaha'    => $laba_usaha,

    'gaji_pengurus' => $gaji_pengurus,

    'sisa_shu'      => $sisa_shu,

    'pembagian'     => [

        [
            'nama'=>'Insentif Penasehat / Kepala Desa',
            'nominal'=>$kades
        ],

        [
            'nama'=>'PADes',
            'nominal'=>$pades
        ],

        [
            'nama'=>'Dana Sosial',
            'nominal'=>$dana_sosial
        ],

        [
            'nama'=>'Jasa Produksi',
            'nominal'=>$jasa_produksi
        ],

        [
            'nama'=>'Cadangan',
            'nominal'=>$cadangan
        ],

        [
            'nama'=>'Kesejahteraan',
            'nominal'=>$kesejahteraan
        ]

    ]

];

    }


    /* =====================================================
     * SIMPAN POSTING
     * ===================================================== */

    public function simpanPosting($bulan, $tahun, $hasil)
    {

        $this->db->insert('posting_shu',[

            'bulan'            => $bulan,

            'tahun'            => $tahun,

            'tanggal_posting'  => date('Y-m-d H:i:s'),

            'laba_usaha'       => $hasil['laba_usaha'],

            'gaji_pengurus'    => $hasil['gaji_pengurus'],

            'sisa_shu'         => $hasil['sisa_shu'],

            'status'           => 'POSTING',

            'user_id'          => $this->session->userdata('user_id')

        ]);

        return $this->db->insert_id();

    }
/* =====================================================
 * KAS DEFAULT
 * ===================================================== */

public function getKasDefault()
{
    $kas = $this->db
        ->where('aktif', 1)
        ->order_by('id', 'ASC')
        ->limit(1)
        ->get('kas')
        ->row();

    return $kas ? $kas->id : null;
}
/* =====================================================
 * UNIT USAHA DEFAULT
 * ===================================================== */

public function getUnitUsahaDefault()
{
    $unit = $this->db
        ->where('aktif', 1)
        ->order_by('id', 'ASC')
        ->limit(1)
        ->get('unit_usaha')
        ->row();

    return $unit ? $unit->id : null;
}
}