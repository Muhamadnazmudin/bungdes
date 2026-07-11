<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan_model extends CI_Model
{

    /* =====================================================
     * LIST TRANSAKSI
     * ===================================================== */

    public function get_all()
    {
        return $this->db
            ->select('
                t.*,
                k.nama AS nama_kas,
                a.kode AS kode_akun,
                a.nama AS nama_akun,
                u.nama AS nama_unit
            ')
            ->from('transaksi_keuangan t')
            ->join('kas k', 'k.id = t.kas_id', 'left')
            ->join('akun a', 'a.id = t.akun_id', 'left')
            ->join('unit_usaha u', 'u.id = t.unit_usaha_id', 'left')
            ->order_by('t.tanggal', 'DESC')
            ->order_by('t.id', 'DESC')
            ->get()
            ->result();
    }


    /* =====================================================
     * DETAIL
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
            'jenis'         => strtoupper($post['jenis']),
            'kas_id'        => $post['kas_id'],
            'akun_id'       => $post['akun_id'],
            'unit_usaha_id' => $post['unit_usaha_id'],
            'nominal'       => str_replace(',', '', $post['nominal']),
            'keterangan'    => $post['keterangan']

        ];

        $this->db->insert('transaksi_keuangan', $data);

        $transaksi_id = $this->db->insert_id();

        if (!$transaksi_id) {

            $this->db->trans_rollback();

            return false;

        }

        $this->create_jurnal($transaksi_id);

        $this->db->trans_commit();

        return true;
    }


    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id, $post)
    {
        $this->db->trans_begin();

        $data = [

            'tanggal'       => $post['tanggal'],
            'jenis'         => strtoupper($post['jenis']),
            'kas_id'        => $post['kas_id'],
            'akun_id'       => $post['akun_id'],
            'unit_usaha_id' => $post['unit_usaha_id'],
            'nominal'       => str_replace(',', '', $post['nominal']),
            'keterangan'    => $post['keterangan']

        ];

        $this->db
            ->where('id', $id)
            ->update('transaksi_keuangan', $data);

        $this->delete_jurnal($id);

        $this->create_jurnal($id);

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
            ->where('id', $id)
            ->delete('transaksi_keuangan');

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
            'no_bukti'      => 'TRX-' . date('YmdHis'),
            'keterangan'    => $transaksi->keterangan,
            'unit_usaha_id' => $transaksi->unit_usaha_id,
            'user_id'       => $this->session->userdata('user_id'),
            'created_at'    => date('Y-m-d H:i:s')

        ];

        $this->db->insert('jurnal', $jurnal);

        $jurnal_id = $this->db->insert_id();

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

        } else {

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
            return;
        }

        $this->db
            ->where('jurnal_id', $jurnal->id)
            ->delete('jurnal_detail');

        $this->db
            ->where('id', $jurnal->id)
            ->delete('jurnal');
    }


    /* =====================================================
     * BUAT ULANG JURNAL
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
            ->select('k.*,a.kode,a.nama as nama_akun')
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

}