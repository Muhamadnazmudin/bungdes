<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandang_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->where('aktif', 1)
            ->order_by('kode','ASC')
            ->get('kandang')
            ->result();
    }

    public function get_all_with_inactive()
    {
        return $this->db
            ->order_by('kode','ASC')
            ->get('kandang')
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('kandang')
            ->row();
    }

    public function insert($data)
    {
        $this->db->insert('kandang',[
            'kode'       => $data['kode'],
            'nama'       => $data['nama'],
            'kapasitas'  => $data['kapasitas'],
            'keterangan' => $data['keterangan'],
            'aktif'      => 1
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update('kandang',[
            'kode'       => $data['kode'],
            'nama'       => $data['nama'],
            'kapasitas'  => $data['kapasitas'],
            'keterangan' => $data['keterangan'],
            'aktif'      => isset($data['aktif']) ? (int)$data['aktif'] : 1
        ]);
    }

    public function soft_delete($id)
    {
        $this->db->where('id', $id)->update('kandang',[
            'aktif' => 0
        ]);
    }
}
