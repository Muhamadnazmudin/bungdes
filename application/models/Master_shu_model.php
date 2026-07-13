<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_shu_model extends CI_Model
{

    /* =====================================================
     * LIST DATA
     * ===================================================== */

    public function get_all()
    {
        return $this->db
            ->select('
                s.*,
                a.kode,
                a.nama AS nama_akun
            ')
            ->from('master_shu s')
            ->join('akun a','a.id=s.akun_id')
            ->where('s.aktif',1)
            ->order_by('s.urutan','ASC')
            ->get()
            ->result();
    }

    /* =====================================================
     * DETAIL
     * ===================================================== */

    public function get_by_id($id)
    {
        return $this->db
            ->where('id',$id)
            ->get('master_shu')
            ->row();
    }

    /* =====================================================
     * SIMPAN
     * ===================================================== */

    public function insert($data)
    {
        return $this->db
            ->insert('master_shu',$data);
    }

    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id,$data)
    {
        return $this->db
            ->where('id',$id)
            ->update('master_shu',$data);
    }

    /* =====================================================
     * HAPUS
     * ===================================================== */

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete('master_shu');
    }

}