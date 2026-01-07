<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak_model extends CI_Model {

    public function get_all()
{
    return $this->db
        ->where('aktif', 1)
        ->order_by('kode','ASC')
        ->get('pajak')
        ->result();
}


    public function get_by_id($id)
    {
        return $this->db->get_where('pajak',['id'=>$id])->row();
    }

    public function insert($data)
    {
        $this->db->insert('pajak',[
            'kode'  => $data['kode'],
            'nama'  => $data['nama'],
            'tarif' => $data['tarif'],
            'aktif' => 1
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id',$id)->update('pajak',[
            'kode'  => $data['kode'],
            'nama'  => $data['nama'],
            'tarif' => $data['tarif'],
            'aktif' => $data['aktif']
        ]);
    }
    public function soft_delete($id)
{
    $this->db->where('id',$id)->update('pajak',[
        'aktif' => 0
    ]);
}
public function get_all_with_inactive()
{
    return $this->db
        ->order_by('kode','ASC')
        ->get('pajak')
        ->result();
}

}
