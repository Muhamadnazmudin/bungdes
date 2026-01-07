<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_sakit_model extends CI_Model {

    public function getAll()
{
    $this->db->select('
        a.*,
        u.nama AS nama_unit,
        k.nama AS nama_kandang
    ');
    $this->db->from('ayam_sakit a');
    $this->db->join('unit_usaha u', 'u.id = a.unit_usaha_id');
    $this->db->join('kandang k', 'k.id = a.kandang_id');
    $this->db->order_by('a.tanggal', 'DESC');
    return $this->db->get()->result();
}


    public function getById($id)
    {
        return $this->db->get_where('ayam_sakit', ['id' => $id])->row();
    }

    public function insert()
    {
        $data = [
            'tanggal'        => $this->input->post('tanggal'),
            'unit_usaha_id'  => $this->input->post('unit_usaha_id'),
            'kandang_id'     => $this->input->post('kandang_id'),
            'jumlah'         => $this->input->post('jumlah'),
            'gejala'         => $this->input->post('gejala'),
            'tindakan'       => $this->input->post('tindakan'),
            'keterangan'     => $this->input->post('keterangan'),
        ];
        $this->db->insert('ayam_sakit', $data);
    }

    public function update($id)
    {
        $data = [
            'tanggal'        => $this->input->post('tanggal'),
            'unit_usaha_id'  => $this->input->post('unit_usaha_id'),
            'kandang_id'     => $this->input->post('kandang_id'),
            'jumlah'         => $this->input->post('jumlah'),
            'gejala'         => $this->input->post('gejala'),
            'tindakan'       => $this->input->post('tindakan'),
            'keterangan'     => $this->input->post('keterangan'),
        ];
        $this->db->where('id', $id)->update('ayam_sakit', $data);
    }

    public function delete($id)
    {
        $this->db->delete('ayam_sakit', ['id' => $id]);
    }
}
