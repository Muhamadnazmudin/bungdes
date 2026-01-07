<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Populasi_ayam_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('p.*, k.nama AS nama_kandang')
            ->from('populasi_ayam p')
            ->join('kandang k','k.id = p.kandang_id')
            ->order_by('p.tanggal','DESC')
            ->get()
            ->result();
    }

    public function insert($data)
    {
        $this->db->insert('populasi_ayam',[
            'tanggal'     => $data['tanggal'],
            'kandang_id'  => $data['kandang_id'],
            'jumlah'      => $data['jumlah'],
            'keterangan'  => $data['keterangan']
        ]);
    }
    public function get_by_id($id)
{
    return $this->db
        ->where('id', $id)
        ->get('populasi_ayam')
        ->row();
}

public function update($id, $data)
{
    $this->db->where('id', $id)->update('populasi_ayam', [
        'tanggal'     => $data['tanggal'],
        'kandang_id'  => $data['kandang_id'],
        'jumlah'      => $data['jumlah'],
        'keterangan'  => $data['keterangan']
    ]);
}

}
