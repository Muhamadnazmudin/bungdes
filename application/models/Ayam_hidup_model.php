<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayam_hidup_model extends CI_Model {

    public function getBukuPopulasi()
    {
        $data = [];

        // 1. Populasi awal
        $populasi = $this->db
            ->select('p.tanggal, k.nama AS kandang, p.jumlah')
            ->from('populasi_ayam p')
            ->join('kandang k', 'k.id = p.kandang_id')
            ->order_by('p.tanggal', 'ASC')
            ->get()
            ->result();

        foreach ($populasi as $p) {
            $data[] = [
                'tanggal'    => $p->tanggal,
                'kandang'    => $p->kandang,
                'keterangan' => 'Populasi Awal',
                'jumlah'     => $p->jumlah,
                'masuk'      => $p->jumlah,
                'keluar'     => 0
            ];
        }

        // 2. Ayam mati
        $mati = $this->db
            ->select('a.tanggal, k.nama AS kandang, a.jumlah')
            ->from('ayam_mati a')
            ->join('kandang k', 'k.id = a.kandang_id')
            ->order_by('a.tanggal', 'ASC')
            ->get()
            ->result();

        foreach ($mati as $m) {
            $data[] = [
                'tanggal'    => $m->tanggal,
                'kandang'    => $m->kandang,
                'keterangan' => 'Ayam Mati',
                'jumlah'     => $m->jumlah,
                'masuk'      => 0,
                'keluar'     => $m->jumlah
            ];
        }

        // 3. Urutkan berdasarkan tanggal
        usort($data, function ($a, $b) {
            return strtotime($a['tanggal']) <=> strtotime($b['tanggal']);
        });

        // 4. Hitung total berjalan
        $saldo = 0;
        foreach ($data as &$row) {
            $saldo = $saldo + $row['masuk'] - $row['keluar'];
            $row['total'] = $saldo;
        }

        return $data;
    }
}
