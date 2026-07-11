<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_telur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Penjualan_telur_model');
    }

    public function index()
    {
        $data['title'] = 'Penjualan Telur';

        $data['data'] = $this->Penjualan_telur_model->getAll();

        $data['total_produksi'] = $this->Penjualan_telur_model->totalProduksi();

        $data['total_penjualan'] = $this->Penjualan_telur_model->totalPenjualan();

        $data['stok'] = $data['total_produksi'] - $data['total_penjualan'];

        $this->load->view('templates/header', $data);
        $this->load->view('penjualan_telur/index', $data);
        $this->load->view('templates/footer');
    }
public function tambah()
{
    $data['title'] = 'Tambah Penjualan Telur';

    $data['stok'] = $this->Penjualan_telur_model->totalProduksi()
                  - $this->Penjualan_telur_model->totalPenjualan();

    $this->load->view('templates/header', $data);
    $this->load->view('penjualan_telur/tambah', $data);
    $this->load->view('templates/footer');
}
    public function simpan()
    {
        $stok = $this->Penjualan_telur_model->totalProduksi() -
                $this->Penjualan_telur_model->totalPenjualan();

        if ($this->input->post('berat_kg') > $stok) {

            $this->session->set_flashdata('error', 'Stok telur tidak mencukupi.');

            redirect('penjualan_telur');
        }

        $data = [

            'tanggal'        => $this->input->post('tanggal', true),

            'pembeli'        => $this->input->post('pembeli', true),

            'berat_kg'       => $this->input->post('berat_kg', true),

            'harga_kg'       => $this->input->post('harga_kg', true),

            'total'          => $this->input->post('total', true),

            'unit_usaha_id'  => $this->input->post('unit_usaha_id', true),

            'keterangan'     => $this->input->post('keterangan', true)

        ];

        $this->Penjualan_telur_model->insert($data);

        $this->session->set_flashdata('success', 'Penjualan berhasil disimpan.');

        redirect('penjualan_telur');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Penjualan Telur';

        $data['row'] = $this->Penjualan_telur_model->getById($id);

        $data['total_produksi'] = $this->Penjualan_telur_model->totalProduksi();

        $data['total_penjualan'] = $this->Penjualan_telur_model->totalPenjualan();

        $data['stok'] = $data['total_produksi'] - $data['total_penjualan'];

        $this->load->view('templates/header', $data);
        $this->load->view('penjualan_telur/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id)
    {
        $data = [

            'tanggal'       => $this->input->post('tanggal', true),

            'pembeli'       => $this->input->post('pembeli', true),

            'berat_kg'      => $this->input->post('berat_kg', true),

            'harga_kg'      => $this->input->post('harga_kg', true),

            'total'         => $this->input->post('total', true),

            'unit_usaha_id' => $this->input->post('unit_usaha_id', true),

            'keterangan'    => $this->input->post('keterangan', true)

        ];

        $this->Penjualan_telur_model->update($id, $data);

        $this->session->set_flashdata('success', 'Data berhasil diperbarui.');

        redirect('penjualan_telur');
    }

    public function hapus($id)
    {
        $this->Penjualan_telur_model->delete($id);

        $this->session->set_flashdata('success', 'Data berhasil dihapus.');

        redirect('penjualan_telur');
    }

}