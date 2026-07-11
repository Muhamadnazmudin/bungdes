<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_telur_model extends CI_Model {

    public function get_all()
{
    return $this->db
        ->select('
            p.*,
            u.kode AS kode_unit,
            u.nama AS nama_unit,
            k.kode AS kode_kandang,
            k.nama AS nama_kandang
        ')
        ->from('produksi_telur p')
        ->join('unit_usaha u','u.id=p.unit_usaha_id','left')
        ->join('kandang k','k.id=p.kandang_id','left')
        ->order_by('p.tanggal','DESC')
        ->order_by('p.id','DESC')
        ->get()
        ->result();
}
    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('produksi_telur')
            ->row();
    }

    public function insert($data)
{
    $this->db->insert('produksi_telur', [
        'tanggal'        => $data['tanggal'],
        'unit_usaha_id'  => $data['unit_usaha_id'],
        'kandang_id'     => $data['kandang_id'],
        'jumlah_telur'   => $data['jumlah_telur'],
        'berat_kg'       => $data['berat_kg'],
        'keterangan'     => $data['keterangan']
    ]);
}


    public function update($id, $data)
{
    $this->db->where('id', $id)->update('produksi_telur', [
        'tanggal'        => $data['tanggal'],
        'unit_usaha_id'  => $data['unit_usaha_id'],
        'kandang_id'     => $data['kandang_id'],
        'jumlah_telur'   => $data['jumlah_telur'],
        'berat_kg'       => $data['berat_kg'],
        'keterangan'     => $data['keterangan']
    ]);
}

}
