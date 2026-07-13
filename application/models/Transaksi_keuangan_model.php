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
                k.nama  AS nama_kas,
                a.kode  AS kode_akun,
                a.nama  AS nama_akun,
                u.nama  AS nama_unit
            ")
            ->from('transaksi_keuangan t')
            ->join('kas k', 'k.id=t.kas_id', 'left')
            ->join('akun a', 'a.id=t.akun_id', 'left')
            ->join('unit_usaha u', 'u.id=t.unit_usaha_id', 'left')
            ->order_by('t.tanggal', 'DESC')
            ->order_by('t.id', 'DESC')
            ->get()
            ->result();
    }

    /* =====================================================
     * DETAIL TRANSAKSI
     * ===================================================== */

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('transaksi_keuangan')
            ->row();
    }

    /* =====================================================
     * SIMPAN TRANSAKSI
     * ===================================================== */

    public function insert($post)
    {
        $this->db->trans_begin();

        $data = [

            'tanggal'       => $post['tanggal'],

            'jenis'         => strtoupper(trim($post['jenis'])),

            'kas_id'        => $post['kas_id'],

            'akun_id'       => $post['akun_id'],

            'unit_usaha_id' => $post['unit_usaha_id'],

            'nominal'       => (float) str_replace(',', '', $post['nominal']),

            'keterangan'    => trim($post['keterangan']),

            'sumber'        => empty($post['sumber'])
                                ? 'MANUAL'
                                : strtoupper($post['sumber'])

        ];

        $this->db->insert(
            'transaksi_keuangan',
            $data
        );

        $transaksi_id = $this->db->insert_id();

        if (!$transaksi_id) {

            $this->db->trans_rollback();

            return 'Transaksi gagal disimpan.';
        }

        /*
        |------------------------------------------------------
        | Buat jurnal otomatis
        |------------------------------------------------------
        */

        $jurnal = $this->create_jurnal($transaksi_id);

        if ($jurnal !== TRUE) {

            $this->db->trans_rollback();

            return $jurnal;
        }

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return 'Terjadi kesalahan database.';
        }

        $this->db->trans_commit();

        return TRUE;
    }

    /* =====================================================
     * UPDATE TRANSAKSI
     * ===================================================== */
        /* =====================================================
     * UPDATE TRANSAKSI
     * ===================================================== */

    public function update($id, $post)
    {
        $transaksi = $this->get_by_id($id);

        if (!$transaksi) {
            return 'Data transaksi tidak ditemukan.';
        }

        $this->db->trans_begin();

        $data = [

            'tanggal'       => $post['tanggal'],

            'jenis'         => strtoupper(trim($post['jenis'])),

            'kas_id'        => $post['kas_id'],

            'akun_id'       => $post['akun_id'],

            'unit_usaha_id' => $post['unit_usaha_id'],

            'nominal'       => (float) str_replace(',', '', $post['nominal']),

            'keterangan'    => trim($post['keterangan']),

            'sumber'        => empty($post['sumber'])
                                ? $transaksi->sumber
                                : strtoupper($post['sumber'])

        ];

        $this->db
            ->where('id', $id)
            ->update('transaksi_keuangan', $data);

        if ($this->db->affected_rows() < 0) {

            $this->db->trans_rollback();

            return 'Gagal memperbarui transaksi.';
        }

        /*
        |------------------------------------------------------
        | Refresh Jurnal
        |------------------------------------------------------
        */

        $hapus = $this->delete_jurnal($id);

        if ($hapus !== TRUE) {

            $this->db->trans_rollback();

            return $hapus;
        }

        $jurnal = $this->create_jurnal($id);

        if ($jurnal !== TRUE) {

            $this->db->trans_rollback();

            return $jurnal;
        }

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return 'Terjadi kesalahan database.';
        }

        $this->db->trans_commit();

        return TRUE;
    }


    /* =====================================================
     * HAPUS TRANSAKSI
     * ===================================================== */

    public function delete($id)
    {
        $transaksi = $this->get_by_id($id);

        if (!$transaksi) {
            return 'Data transaksi tidak ditemukan.';
        }

        $this->db->trans_begin();

        /*
        |------------------------------------------------------
        | Hapus Jurnal
        |------------------------------------------------------
        */

        $hapus = $this->delete_jurnal($id);

        if ($hapus !== TRUE) {

            $this->db->trans_rollback();

            return $hapus;
        }

        /*
        |------------------------------------------------------
        | Hapus Transaksi
        |------------------------------------------------------
        */

        $this->db
            ->where('id', $id)
            ->delete('transaksi_keuangan');

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return 'Gagal menghapus transaksi.';
        }

        $this->db->trans_commit();

        return TRUE;
    }


    /* =====================================================
     * MEMBUAT JURNAL
     * ===================================================== */
        /* =====================================================
     * MEMBUAT JURNAL
     * ===================================================== */

    public function create_jurnal($transaksi_id)
    {
        $transaksi = $this->get_by_id($transaksi_id);

        if (!$transaksi) {
            return 'Transaksi tidak ditemukan.';
        }

        /*
        |------------------------------------------------------
        | Kas
        |------------------------------------------------------
        */

        $kas = $this->db
                    ->where('id', $transaksi->kas_id)
                    ->get('kas')
                    ->row();

        if (!$kas) {
            return 'Kas tidak ditemukan.';
        }

        if (empty($kas->akun_id)) {
            return 'Akun Kas belum ditentukan.';
        }

        /*
        |------------------------------------------------------
        | Header Jurnal
        |------------------------------------------------------
        */

        $jurnal = [

            'transaksi_id'  => $transaksi_id,

            'tanggal'       => $transaksi->tanggal,

            'no_bukti'      => 'TRX-' . $transaksi_id,

            'keterangan'    => $transaksi->keterangan,

            'unit_usaha_id' => $transaksi->unit_usaha_id,

            'user_id'       => $this->session->userdata('user_id'),

            'created_at'    => date('Y-m-d H:i:s')

        ];

        $this->db->insert('jurnal', $jurnal);

        $jurnal_id = $this->db->insert_id();

        if (!$jurnal_id) {
            return 'Gagal membuat jurnal.';
        }

        /*
        |------------------------------------------------------
        | Detail Jurnal
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

            // Kredit Pendapatan

            $this->db->insert('jurnal_detail', [

                'jurnal_id' => $jurnal_id,

                'akun_id'   => $transaksi->akun_id,

                'debit'     => 0,

                'kredit'    => $transaksi->nominal

            ]);

        } else {

            // Debit Beban

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

        if ($this->db->trans_status() === FALSE) {
            return 'Gagal menyimpan jurnal.';
        }

        return TRUE;
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
            return TRUE;
        }

        $this->db
             ->where('jurnal_id', $jurnal->id)
             ->delete('jurnal_detail');

        $this->db
             ->where('id', $jurnal->id)
             ->delete('jurnal');

        if ($this->db->trans_status() === FALSE) {
            return 'Gagal menghapus jurnal.';
        }

        return TRUE;
    }


    /* =====================================================
     * REFRESH JURNAL
     * ===================================================== */

    public function recreate_jurnal($transaksi_id)
    {
        $hapus = $this->delete_jurnal($transaksi_id);

        if ($hapus !== TRUE) {
            return $hapus;
        }

        return $this->create_jurnal($transaksi_id);
    }


    /* =====================================================
     * DEFAULT KAS
     * ===================================================== */
        /* =====================================================
     * MASTER KAS
     * ===================================================== */

    public function get_kas()
    {
        return $this->db
            ->select("
                k.*,
                a.kode,
                a.nama AS nama_akun
            ")
            ->from('kas k')
            ->join('akun a', 'a.id = k.akun_id', 'left')
            ->where('k.aktif', 1)
            ->order_by('k.nama', 'ASC')
            ->get()
            ->result();
    }


    /* =====================================================
     * MASTER AKUN
     * ===================================================== */

    public function get_akun()
    {
        return $this->db
            ->where('aktif', 1)
            ->order_by('kode', 'ASC')
            ->get('akun')
            ->result();
    }


    /* =====================================================
     * MASTER UNIT USAHA
     * ===================================================== */

    public function get_unit_usaha()
    {
        return $this->db
            ->where('aktif', 1)
            ->order_by('nama', 'ASC')
            ->get('unit_usaha')
            ->result();
    }


    /* =====================================================
     * DEFAULT KAS
     * ===================================================== */

    private function default_kas()
    {
        $kas = $this->db
            ->where('aktif', 1)
            ->where('is_default', 1)
            ->limit(1)
            ->get('kas')
            ->row();

        if ($kas) {
            return $kas;
        }

        return $this->db
            ->where('aktif', 1)
            ->order_by('id', 'ASC')
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
            ->where('aktif', 1)
            ->where('is_default', 1)
            ->limit(1)
            ->get('unit_usaha')
            ->row();

        if ($unit) {
            return $unit;
        }

        return $this->db
            ->where('aktif', 1)
            ->order_by('id', 'ASC')
            ->limit(1)
            ->get('unit_usaha')
            ->row();
    }


    /* =====================================================
     * TRANSAKSI SHU PER PERIODE
     * ===================================================== */

    private function get_transaksi_shu($akun_id, $bulan, $tahun)
    {
        return $this->db
            ->where('akun_id', $akun_id)
            ->where('sumber', 'SHU')
            ->where('MONTH(tanggal)', $bulan)
            ->where('YEAR(tanggal)', $tahun)
            ->limit(1)
            ->get('transaksi_keuangan')
            ->row();
    }


    /* =====================================================
     * STATUS POSTING SHU
     * ===================================================== */

    public function sudah_posting_shu($dari, $sampai)
    {
        return $this->db
                ->where('sumber', 'SHU')
                ->where('tanggal >=', $dari)
                ->where('tanggal <=', $sampai)
                ->count_all_results('transaksi_keuangan') > 0;
    }


   
        /* =====================================================
     * POSTING SHU
     * ===================================================== */

    public function generate_shu($bulan, $tahun)
    {
        $this->db->trans_begin();

        /*
        |------------------------------------------------------
        | Periode
        |------------------------------------------------------
        */

        $dari = $tahun . '-' . sprintf('%02d', $bulan) . '-01';

        $sampai = date(
            'Y-m-t',
            strtotime($dari)
        );

        /*
        |------------------------------------------------------
        | Cek sudah pernah posting?
        |------------------------------------------------------
        */

        if ($this->sudah_posting_shu($dari, $sampai)) {

            $this->db->trans_rollback();

            return 'SHU periode tersebut sudah diposting.';
        }

        /*
        |------------------------------------------------------
        | Ambil laporan laba rugi
        |------------------------------------------------------
        */

        $laporan = $this->Laba_rugi_model
                        ->get_laporan($dari, $sampai);

                        

        if (empty($laporan['master_shu'])) {

            $this->db->trans_rollback();

            return 'Master SHU belum dibuat.';
        }

        /*
        |------------------------------------------------------
        | Kas Default
        |------------------------------------------------------
        */

       $kas = $this->db
    ->where('akun_id', 9)
    ->get('kas')
    ->row();

        /*
        |------------------------------------------------------
        | Unit Usaha Default
        |------------------------------------------------------
        */

        $unit = $this->default_unit();

        if (!$unit) {

            $this->db->trans_rollback();

            return 'Unit usaha default belum ditentukan.';
        }

        /*
        |------------------------------------------------------
        | Tanggal Posting
        |------------------------------------------------------
        */

        $tanggal = $sampai;

        /*
        |------------------------------------------------------
        | Simpan seluruh pembagian SHU
        |------------------------------------------------------
        */

        foreach ($laporan['master_shu'] as $item) {

            if (empty($item['akun_id'])) {
                continue;
            }

            if ($item['nominal'] <= 0) {
                continue;
            }

            $data = [

                'tanggal'       => $tanggal,

                'jenis'         => 'KELUAR',

                'kas_id'        => $kas->id,

                'akun_id'       => $item['akun_id'],

                'unit_usaha_id' => $unit->id,

                'nominal'       => $item['nominal'],

                'keterangan'    => 'Posting SHU - ' . $item['nama'] .
                                   ' Periode ' .
                                   date('F Y', strtotime($tanggal)),

                'sumber'        => 'SHU'

            ];

            $this->db->insert(
                'transaksi_keuangan',
                $data
            );

            $transaksi_id = $this->db->insert_id();

            if (!$transaksi_id) {

                $this->db->trans_rollback();

                return 'Gagal menyimpan transaksi SHU.';
            }

            $jurnal = $this->create_jurnal($transaksi_id);

            if ($jurnal !== TRUE) {

                $this->db->trans_rollback();

                return $jurnal;
            }
        }

        /*
        |------------------------------------------------------
        | Simpan Riwayat Posting
        |------------------------------------------------------
        */

        $this->db->insert('posting_shu', [

            'bulan'           => $bulan,

            'tahun'           => $tahun,

            'tanggal_posting' => date('Y-m-d H:i:s'),

            'laba_usaha'      => $laporan['laba_usaha'],

            'sisa_shu'        => $laporan['sisa_shu'],

            'status'          => 'POSTING',

            'user_id'         => $this->session->userdata('user_id'),

            'created_at'      => date('Y-m-d H:i:s')

        ]);

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return 'Posting SHU gagal.';
        }

        $this->db->trans_commit();

        return TRUE;
    }

    /* =====================================================
     * RESET POSTING SHU
     * ===================================================== */
        /* =====================================================
     * RESET POSTING SHU
     * ===================================================== */

    public function reset_shu($bulan, $tahun)
    {
        $this->db->trans_begin();

        /*
        |------------------------------------------------------
        | Ambil seluruh transaksi SHU periode tersebut
        |------------------------------------------------------
        */

        $transaksi = $this->db
            ->where('sumber', 'SHU')
            ->where('MONTH(tanggal)', $bulan)
            ->where('YEAR(tanggal)', $tahun)
            ->order_by('id', 'ASC')
            ->get('transaksi_keuangan')
            ->result();

        /*
        |------------------------------------------------------
        | Hapus jurnal & transaksi
        |------------------------------------------------------
        */

        foreach ($transaksi as $trx) {

            $hapus = $this->delete_jurnal($trx->id);

            if ($hapus !== TRUE) {

                $this->db->trans_rollback();

                return $hapus;
            }

            $this->db
                ->where('id', $trx->id)
                ->delete('transaksi_keuangan');

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();

                return 'Gagal menghapus transaksi SHU.';
            }
        }

        /*
        |------------------------------------------------------
        | Hapus riwayat posting SHU
        |------------------------------------------------------
        */

        $this->db
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->delete('posting_shu');

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();

            return 'Gagal menghapus riwayat posting SHU.';
        }

        /*
        |------------------------------------------------------
        | Commit
        |------------------------------------------------------
        */

        $this->db->trans_commit();

        return TRUE;
    }

}