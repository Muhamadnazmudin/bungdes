<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_mati_model extends CI_Model {

    public function getAll()
    {
        $this->db->select('
            a.*,
            k.nama AS nama_kandang
        ');
        $this->db->from('ayam_mati a');
        $this->db->join('kandang k', 'k.id = a.kandang_id');
        $this->db->order_by('a.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where('ayam_mati', ['id' => $id])->row();
    }

    public function insert()
    {
        $this->db->insert('ayam_mati', [
            'tanggal'    => $this->input->post('tanggal'),
            'kandang_id' => $this->input->post('kandang_id'),
            'jumlah'     => $this->input->post('jumlah'),
            'sebab'      => $this->input->post('sebab')
        ]);
    }

    public function update($id)
    {
        $this->db->where('id', $id)->update('ayam_mati', [
            'tanggal'    => $this->input->post('tanggal'),
            'kandang_id' => $this->input->post('kandang_id'),
            'jumlah'     => $this->input->post('jumlah'),
            'sebab'      => $this->input->post('sebab')
        ]);
    }

    public function delete($id)
    {
        $this->db->delete('ayam_mati', ['id' => $id]);
    }
}
