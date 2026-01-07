<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_model extends CI_Model {

    public function get_all()
    {
        return $this->db
            ->select('k.*, a.kode AS kode_akun, a.nama AS nama_akun')
            ->from('kas k')
            ->join('akun a','a.id = k.akun_id')
            ->order_by('k.kode','ASC')
            ->get()
            ->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id',$id)->get('kas')->row();
    }

    public function insert($data)
    {
        $this->db->insert('kas',[
            'kode'        => $data['kode'],
            'nama'        => $data['nama'],
            'tipe'        => $data['tipe'],
            'akun_id'     => $data['akun_id'],
            'saldo_awal'  => $data['saldo_awal'],
            'keterangan'  => $data['keterangan'],
            'aktif'       => 1
        ]);
    }

    public function update($id,$data)
    {
        $this->db->where('id',$id)->update('kas',[
            'kode'        => $data['kode'],
            'nama'        => $data['nama'],
            'tipe'        => $data['tipe'],
            'akun_id'     => $data['akun_id'],
            'saldo_awal'  => $data['saldo_awal'],
            'keterangan'  => $data['keterangan'],
            'aktif'       => $data['aktif']
        ]);
    }
}
