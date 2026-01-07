<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('t.*, k.nama AS nama_kas, a.nama AS nama_akun, u.nama AS nama_unit')
            ->from('transaksi_keuangan t')
            ->join('kas k','k.id = t.kas_id')
            ->join('akun a','a.id = t.akun_id')
            ->join('unit_usaha u','u.id = t.unit_usaha_id')
            ->order_by('t.tanggal','ASC')
            ->get()
            ->result();
    }

   public function insert($data)
{
    $this->db->trans_begin();

    $this->db->insert('transaksi_keuangan', [
        'tanggal'        => $data['tanggal'],
        'jenis'          => $data['jenis'],
        'kas_id'         => $data['kas_id'],
        'akun_id'        => $data['akun_id'],
        'unit_usaha_id'  => $data['unit_usaha_id'],
        'nominal'        => $data['nominal'],
        'keterangan'     => $data['keterangan']
    ]);

    $kas = $this->db->get_where('kas', ['id'=>$data['kas_id']])->row();
    if (!$kas || !$kas->akun_id) {
        $this->db->trans_rollback();
        return false;
    }

    $transaksi_id = $this->db->insert_id();

$this->db->insert('jurnal', [
    'transaksi_id'  => $transaksi_id,
    'tanggal'       => $data['tanggal'],
    'no_bukti'      => 'TRX-'.date('YmdHis'),
    'keterangan'    => $data['keterangan'],
    'unit_usaha_id' => $data['unit_usaha_id'],
    'user_id'       => $this->session->userdata('user_id'),
    'created_at'    => date('Y-m-d H:i:s')
]);


    $jurnal_id = $this->db->insert_id();

    if ($data['jenis'] == 'MASUK') {
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$kas->akun_id,'debit'=>$data['nominal'],'kredit'=>0
        ]);
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$data['akun_id'],'debit'=>0,'kredit'=>$data['nominal']
        ]);
    } else {
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$data['akun_id'],'debit'=>$data['nominal'],'kredit'=>0
        ]);
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$kas->akun_id,'debit'=>0,'kredit'=>$data['nominal']
        ]);
    }

    $this->db->trans_complete();
    return $this->db->trans_status();
}
public function get_by_id($id)
{
    return $this->db
        ->where('id', $id)
        ->get('transaksi_keuangan')
        ->row();
}

public function update($id, $data)
{
    $this->db->where('id', $id)
             ->update('transaksi_keuangan', $data);
}

// hapus jurnal & detail lama
public function delete_jurnal($transaksi_id)
{
    $jurnal = $this->db
        ->get_where('jurnal', ['transaksi_id'=>$transaksi_id])
        ->row();

    if ($jurnal) {
        $this->db->delete('jurnal_detail', ['jurnal_id'=>$jurnal->id]);
        $this->db->delete('jurnal', ['id'=>$jurnal->id]);
    }
}
// ambil daftar kas & bank (aktif)
public function get_kas()
{
    return $this->db
        ->select('k.id, k.nama, a.kode')
        ->from('kas k')
        ->join('akun a', 'a.id = k.akun_id')
        ->where('k.aktif', 1)
        ->get()
        ->result();
}
// ambil semua akun aktif
public function get_akun()
{
    return $this->db
        ->where('aktif', 1)
        ->order_by('kode', 'ASC')
        ->get('akun')
        ->result();
}
// ambil unit usaha aktif
public function get_unit_usaha()
{
    return $this->db
        ->where('aktif', 1)
        ->get('unit_usaha')
        ->result();
}
public function recreate_jurnal($transaksi_id)
{
    $t = $this->get_by_id($transaksi_id);
    if (!$t) return;

    $kas = $this->db->get_where('kas', ['id'=>$t->kas_id])->row();

    $this->db->insert('jurnal', [
        'transaksi_id'  => $transaksi_id,
        'tanggal'       => $t->tanggal,
        'no_bukti'      => 'TRX-'.date('YmdHis'),
        'keterangan'    => $t->keterangan,
        'unit_usaha_id' => $t->unit_usaha_id,
        'user_id'       => $this->session->userdata('user_id'),
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    $jurnal_id = $this->db->insert_id();

    if ($t->jenis == 'MASUK') {
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$kas->akun_id,'debit'=>$t->nominal,'kredit'=>0
        ]);
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$t->akun_id,'debit'=>0,'kredit'=>$t->nominal
        ]);
    } else {
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$t->akun_id,'debit'=>$t->nominal,'kredit'=>0
        ]);
        $this->db->insert('jurnal_detail', [
            'jurnal_id'=>$jurnal_id,'akun_id'=>$kas->akun_id,'debit'=>0,'kredit'=>$t->nominal
        ]);
    }
}

}
