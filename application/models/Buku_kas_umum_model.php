<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_kas_umum_model extends CI_Model {

    // daftar kas/bank
    public function get_kas_list()
    {
        return $this->db
            ->select('k.id, k.nama, a.kode, a.nama as nama_akun')
            ->from('kas k')
            ->join('akun a', 'a.id = k.akun_id')
            ->where('k.aktif', 1)
            ->get()
            ->result();
    }

    // data buku kas
    public function get_buku_kas($kas_id)
    {
        $kas = $this->db->get_where('kas', ['id'=>$kas_id])->row();

        return $this->db
            ->select('
                j.tanggal,
                j.no_bukti,
                j.keterangan,
                d.debit,
                d.kredit
            ')
            ->from('jurnal_detail d')
            ->join('jurnal j', 'j.id = d.jurnal_id')
            ->where('d.akun_id', $kas->akun_id)
            ->order_by('j.tanggal', 'ASC')
            ->get()
            ->result();
    }
}
