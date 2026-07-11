<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    /* ===========================================
     * TOTAL PENDAPATAN
     * ===========================================
     */

    public function totalPendapatan()
    {
        return (float)$this->db
            ->select_sum('nominal')
            ->where('jenis','MASUK')
            ->get('transaksi_keuangan')
            ->row()
            ->nominal;
    }

    /* ===========================================
     * TOTAL PENGELUARAN
     * ===========================================
     */

    public function totalPengeluaran()
    {
        return (float)$this->db
            ->select_sum('nominal')
            ->where('jenis','KELUAR')
            ->get('transaksi_keuangan')
            ->row()
            ->nominal;
    }

    /* ===========================================
     * SALDO KAS
     * ===========================================
     */

    public function saldoKas()
    {
        return $this->totalPendapatan() - $this->totalPengeluaran();
    }

    /* ===========================================
     * TOTAL PRODUKSI TELUR
     * ===========================================
     */

    public function totalProduksi()
    {
        return (float)$this->db
            ->select_sum('berat_kg')
            ->get('produksi_telur')
            ->row()
            ->berat_kg;
    }

    /* ===========================================
     * TOTAL PENJUALAN
     * ===========================================
     */

    public function totalPenjualan()
    {
        return (float)$this->db
            ->select_sum('berat_kg')
            ->get('penjualan')
            ->row()
            ->berat_kg;
    }

    /* ===========================================
     * STOK TELUR
     * ===========================================
     */

    public function stokTelur()
    {
        return $this->totalProduksi() - $this->totalPenjualan();
    }

    /* ===========================================
     * POPULASI AYAM HIDUP
     * ===========================================
     */

    public function populasiAwal()
{
    return (int)$this->db
        ->select_sum('jumlah')
        ->get('populasi_ayam')
        ->row()
        ->jumlah;
}

public function ayamMati()
{
    return (int)$this->db
        ->select_sum('jumlah')
        ->get('ayam_mati')
        ->row()
        ->jumlah;
}

public function ayamSakit()
{
    return (int)$this->db
        ->select_sum('jumlah')
        ->get('ayam_sakit')
        ->row()
        ->jumlah;
}

public function populasiAktif()
{
    return $this->populasiAwal()
         - $this->ayamMati();
}

    /* ===========================================
     * TRANSAKSI TERBARU
     * ===========================================
     */

    public function transaksiTerbaru()
    {
        return $this->db
            ->order_by('tanggal','DESC')
            ->limit(10)
            ->get('transaksi_keuangan')
            ->result();
    }

}