<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_usaha_model extends CI_Model {

    public function get_all()
{
    return $this->db
        ->where('aktif', 1)
        ->order_by('nama','ASC')
        ->get('unit_usaha')
        ->result();
}


    public function get_by_id($id)
    {
        return $this->db->get_where('unit_usaha',['id'=>$id])->row();
    }

    public function insert($data)
    {
        $this->db->insert('unit_usaha',[
            'kode'       => $data['kode'],
            'nama'       => $data['nama'],
            'keterangan' => $data['keterangan'],
            'aktif'      => 1
        ]);
    }

    public function update($id, $data)
    {
        $this->db->where('id',$id)->update('unit_usaha',[
            'kode'       => $data['kode'],
            'nama'       => $data['nama'],
            'keterangan' => $data['keterangan'],
            'aktif'      => $data['aktif']
        ]);
    }
    public function soft_delete($id)
{
    $this->db->where('id',$id)->update('unit_usaha',[
        'aktif' => 0
    ]);
}

}
