<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_telur_model extends CI_Model
{

    public function getAll()
    {

        return $this->db
            ->order_by('tanggal','DESC')
            ->get('penjualan')
            ->result();

    }

    public function insert($data)
    {

        return $this->db->insert('penjualan',$data);

    }

    public function totalProduksi()
    {

        return (float)$this->db
            ->select_sum('berat_kg')
            ->get('produksi_telur')
            ->row()
            ->berat_kg;

    }

    public function totalPenjualan()
    {

        return (float)$this->db
            ->select_sum('berat_kg')
            ->get('penjualan')
            ->row()
            ->berat_kg;

    }
public function getById($id)
{
    return $this->db
        ->where('id', $id)
        ->get('penjualan')
        ->row();
}
public function update($id, $data)
{
    return $this->db
        ->where('id', $id)
        ->update('penjualan', $data);
}
public function delete($id)
{
    return $this->db
        ->where('id', $id)
        ->delete('penjualan');
}
}