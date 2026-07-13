<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Laba_rugi_model');
    }

    /* =====================================================
     * LIST TRANSAKSI
     * ===================================================== */

    public function get_all()
    {
        return $this->db
            ->select("
                t.*,
                k.nama AS nama_kas,
                a.kode AS kode_akun,
                a.nama AS nama_akun,
                u.nama AS nama_unit
            ")
            ->from('transaksi_keuangan t')
            ->join('kas k','k.id=t.kas_id','left')
            ->join('akun a','a.id=t.akun_id','left')
            ->join('unit_usaha u','u.id=t.unit_usaha_id','left')
            ->order_by('t.tanggal','DESC')
            ->order_by('t.id','DESC')
            ->get()
            ->result();
    }

    /* =====================================================
     * DETAIL
     * ===================================================== */

    public function get_by_id($id)
    {
        return $this->db
            ->where('id',$id)
            ->get('transaksi_keuangan')
            ->row();
    }

    /* =====================================================
     * SIMPAN
     * ===================================================== */

    public function insert($post)
    {
        $this->db->trans_begin();

        $data = [

            'tanggal'       => $post['tanggal'],

            'jenis'         => strtoupper($post['jenis']),

            'kas_id'        => $post['kas_id'],

            'akun_id'       => $post['akun_id'],

            'unit_usaha_id' => $post['unit_usaha_id'],

            'nominal'       => str_replace(',','',$post['nominal']),

            'keterangan'    => $post['keterangan'],

            'sumber'        => isset($post['sumber'])
                                ? $post['sumber']
                                : 'MANUAL'

        ];

        $this->db->insert(
            'transaksi_keuangan',
            $data
        );

        $id = $this->db->insert_id();

        if(!$id){

            $this->db->trans_rollback();

            return false;

        }

        /*
        |---------------------------------------------
        | Buat jurnal otomatis
        |---------------------------------------------
        */

        $this->create_jurnal($id);

        if($this->db->trans_status()===FALSE){

            $this->db->trans_rollback();

            return false;

        }

        $this->db->trans_commit();

        return true;
    }

    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id,$post)
    {
        $this->db->trans_begin();

        $data = [

            'tanggal'       => $post['tanggal'],

            'jenis'         => strtoupper($post['jenis']),

            'kas_id'        => $post['kas_id'],

            'akun_id'       => $post['akun_id'],

            'unit_usaha_id' => $post['unit_usaha_id'],

            'nominal'       => str_replace(',','',$post['nominal']),

            'keterangan'    => $post['keterangan'],

            'sumber'        => isset($post['sumber'])
                                ? $post['sumber']
                                : 'MANUAL'

        ];

        $this->db
            ->where('id',$id)
            ->update(
                'transaksi_keuangan',
                $data
            );

        /*
        |---------------------------------------------
        | Refresh jurnal
        |---------------------------------------------
        */

        $this->delete_jurnal($id);

        $this->create_jurnal($id);

        if($this->db->trans_status()===FALSE){

            $this->db->trans_rollback();

            return false;

        }

        $this->db->trans_commit();

        return true;
    }

    /* =====================================================
     * HAPUS
     * ===================================================== */

    public function delete($id)
    {
        $this->db->trans_begin();

        $this->delete_jurnal($id);

        $this->db
            ->where('id',$id)
            ->delete('transaksi_keuangan');

        if($this->db->trans_status()===FALSE){

            $this->db->trans_rollback();

            return false;

        }

        $this->db->trans_commit();

        return true;
    }
    /* =====================================================
     * MEMBUAT JURNAL
     * ===================================================== */

    public function create_jurnal($transaksi_id)
    {
        $transaksi = $this->get_by_id($transaksi_id);

        if (!$transaksi) {
            return false;
        }

        $kas = $this->db
            ->where('id', $transaksi->kas_id)
            ->get('kas')
            ->row();

        if (!$kas) {
            return false;
        }

        if (empty($kas->akun_id)) {
            return false;
        }

        $jurnal = [

            'transaksi_id'  => $transaksi_id,

            'tanggal'       => $transaksi->tanggal,

            'no_bukti'      => 'TRX-' . date('YmdHis') . '-' . $transaksi_id,

            'keterangan'    => $transaksi->keterangan,

            'unit_usaha_id' => $transaksi->unit_usaha_id,

            'user_id'       => $this->session->userdata('user_id'),

            'created_at'    => date('Y-m-d H:i:s')

        ];

        $this->db->insert('jurnal', $jurnal);

        $jurnal_id = $this->db->insert_id();

        if (!$jurnal_id) {
            return false;
        }

        /*
        |------------------------------------------------------
        | KAS MASUK
        |------------------------------------------------------
        */

        if ($transaksi->jenis == 'MASUK') {

            // Debit Kas

            $this->db->insert('jurnal_detail', [

                'jurnal_id' => $jurnal_id,

                'akun_id'   => $kas->akun_id,

                'debit'     => $transaksi->nominal,

                'kredit'    => 0

            ]);

            // Kredit Akun

            $this->db->insert('jurnal_detail', [

                'jurnal_id' => $jurnal_id,

                'akun_id'   => $transaksi->akun_id,

                'debit'     => 0,

                'kredit'    => $transaksi->nominal

            ]);

        }

        /*
        |------------------------------------------------------
        | KAS KELUAR
        |------------------------------------------------------
        */

        else {

            // Debit Beban / Aktiva

            $this->db->insert('jurnal_detail', [

                'jurnal_id' => $jurnal_id,

                'akun_id'   => $transaksi->akun_id,

                'debit'     => $transaksi->nominal,

                'kredit'    => 0

            ]);

            // Kredit Kas

            $this->db->insert('jurnal_detail', [

                'jurnal_id' => $jurnal_id,

                'akun_id'   => $kas->akun_id,

                'debit'     => 0,

                'kredit'    => $transaksi->nominal

            ]);

        }

        return true;
    }


    /* =====================================================
     * HAPUS JURNAL
     * ===================================================== */

    public function delete_jurnal($transaksi_id)
    {
        $jurnal = $this->db
            ->where('transaksi_id', $transaksi_id)
            ->get('jurnal')
            ->row();

        if (!$jurnal) {
            return true;
        }

        $this->db
            ->where('jurnal_id', $jurnal->id)
            ->delete('jurnal_detail');

        $this->db
            ->where('id', $jurnal->id)
            ->delete('jurnal');

        return true;
    }


    /* =====================================================
     * REFRESH JURNAL
     * ===================================================== */

    public function recreate_jurnal($transaksi_id)
    {
        $this->delete_jurnal($transaksi_id);

        return $this->create_jurnal($transaksi_id);
    }
        /* =====================================================
     * MASTER KAS
     * ===================================================== */

    public function get_kas()
    {
        return $this->db
            ->select('
                k.*,
                a.kode,
                a.nama AS nama_akun
            ')
            ->from('kas k')
            ->join('akun a','a.id=k.akun_id','left')
            ->where('k.aktif',1)
            ->order_by('k.nama','ASC')
            ->get()
            ->result();
    }


    /* =====================================================
     * MASTER AKUN
     * ===================================================== */

    public function get_akun()
    {
        return $this->db
            ->where('aktif',1)
            ->order_by('kode','ASC')
            ->get('akun')
            ->result();
    }


    /* =====================================================
     * MASTER UNIT USAHA
     * ===================================================== */

    public function get_unit_usaha()
    {
        return $this->db
            ->where('aktif',1)
            ->order_by('nama','ASC')
            ->get('unit_usaha')
            ->result();
    }


    /* =====================================================
     * DEFAULT KAS
     * ===================================================== */

    private function default_kas()
    {
        $kas = $this->db
            ->where('aktif',1)
            ->where('is_default',1)
            ->get('kas')
            ->row();

        if($kas){
            return $kas;
        }

        return $this->db
            ->where('aktif',1)
            ->order_by('id','ASC')
            ->limit(1)
            ->get('kas')
            ->row();
    }


    /* =====================================================
     * DEFAULT UNIT USAHA
     * ===================================================== */

    private function default_unit()
    {
        $unit = $this->db
            ->where('aktif',1)
            ->where('is_default',1)
            ->get('unit_usaha')
            ->row();

        if($unit){
            return $unit;
        }

        return $this->db
            ->where('aktif',1)
            ->order_by('id','ASC')
            ->limit(1)
            ->get('unit_usaha')
            ->row();
    }


    /* =====================================================
     * TRANSAKSI SHU PERIODE
     * ===================================================== */

    private function get_transaksi_shu($akun_id,$bulan,$tahun)
    {
        return $this->db
            ->where('akun_id',$akun_id)
            ->where('sumber','SHU')
            ->where('MONTH(tanggal)',$bulan)
            ->where('YEAR(tanggal)',$tahun)
            ->get('transaksi_keuangan')
            ->row();
    }


    /* =====================================================
     * STATUS POSTING SHU
     * ===================================================== */

    public function sudah_posting_shu($bulan,$tahun)
    {
        return $this->db
            ->where('sumber','SHU')
            ->where('MONTH(tanggal)',$bulan)
            ->where('YEAR(tanggal)',$tahun)
            ->count_all_results('transaksi_keuangan') > 0;
    }
        /* =====================================================
     * POSTING SHU
     * ===================================================== */

    public function generate_shu($bulan,$tahun)
    {
        $this->db->trans_begin();

        /*
        |------------------------------------------------------
        | Ambil laporan laba rugi
        |------------------------------------------------------
        */

        $laporan = $this->Laba_rugi_model
                        ->get_laporan($bulan,$tahun);

        if(empty($laporan['master_shu'])){

            $this->db->trans_rollback();

            return false;

        }

        /*
        |------------------------------------------------------
        | Kas & Unit Default
        |------------------------------------------------------
        */

        $kas = $this->default_kas();

        if(!$kas){

            $this->db->trans_rollback();

            return false;

        }

        $unit = $this->default_unit();

        if(!$unit){

            $this->db->trans_rollback();

            return false;

        }

        /*
        |------------------------------------------------------
        | Tanggal Posting
        |------------------------------------------------------
        */

        $tanggal = date(
            'Y-m-t',
            strtotime($tahun.'-'.$bulan.'-01')
        );

        /*
        |------------------------------------------------------
        | Loop Master SHU
        |------------------------------------------------------
        */

        foreach($laporan['master_shu'] as $item){

            /*
            -----------------------------------------
            Validasi
            -----------------------------------------
            */

            if(empty($item['akun_id'])){
                continue;
            }

            if($item['nominal'] <= 0){
                continue;
            }

            /*
            -----------------------------------------
            Sudah ada transaksi?
            -----------------------------------------
            */

            $trx = $this->get_transaksi_shu(
                $item['akun_id'],
                $bulan,
                $tahun
            );

            $data = [

                'tanggal'       => $tanggal,

                'jenis'         => 'KELUAR',

                'kas_id'        => $kas->id,

                'akun_id'       => $item['akun_id'],

                'unit_usaha_id' => $unit->id,

                'nominal'       => $item['nominal'],

                'keterangan'    => 'Posting SHU - '.$item['nama'],

                'sumber'        => 'SHU'

            ];

            /*
            -----------------------------------------
            UPDATE
            -----------------------------------------
            */

            if($trx){

                $this->db
                    ->where('id',$trx->id)
                    ->update(
                        'transaksi_keuangan',
                        $data
                    );

                $this->recreate_jurnal($trx->id);

            }

            /*
            -----------------------------------------
            INSERT
            -----------------------------------------
            */

            else{

                $this->db
                    ->insert(
                        'transaksi_keuangan',
                        $data
                    );

                $id = $this->db->insert_id();

                $this->create_jurnal($id);

            }

        }

        /*
        |------------------------------------------------------
        | Commit
        |------------------------------------------------------
        */

        if($this->db->trans_status()===FALSE){

            $this->db->trans_rollback();

            return false;

        }

        $this->db->trans_commit();

        return true;
    }

}