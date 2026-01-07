<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model {

    public function get_all()
{
    return $this->db
        ->where('aktif', 1)
        ->order_by('kode','ASC')
        ->get('akun')
        ->result();
}
public function get_all_with_inactive()
    {
        return $this->db
            ->order_by('kode','ASC')
            ->get('akun')
            ->result();
    }


    public function get_by_id($id)
    {
        return $this->db->get_where('akun',['id'=>$id])->row();
    }

    public function insert($data)
    {
        $this->db->insert('akun',[
            'kode'      => $data['kode'],
            'nama'      => $data['nama'],
            'jenis'     => $data['jenis'],
            'parent_id' => $data['parent_id'] ?: null
        ]);
    }

    public function update($id, $data)
{
    $this->db->where('id', $id)->update('akun', [
        'kode'      => $data['kode'],
        'nama'      => $data['nama'],
        'jenis'     => $data['jenis'],
        'parent_id' => !empty($data['parent_id']) ? $data['parent_id'] : null,
        'aktif'     => isset($data['aktif']) ? (int)$data['aktif'] : 0
    ]);
}

    public function soft_delete($id)
{
    $this->db->where('id',$id)->update('akun',[
        'aktif' => 0
    ]);
}
public function get_kas_bank()
{
    return $this->db
        ->where('jenis', 'ASET')
        ->group_start()
            ->like('nama', 'Kas')
            ->or_like('nama', 'Bank')
        ->group_end()
        ->get('akun')
        ->result();
}


}
