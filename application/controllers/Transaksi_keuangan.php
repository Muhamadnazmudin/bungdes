<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_keuangan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            show_error('Akses ditolak.');
        }

        $this->load->model([
            'Transaksi_keuangan_model',
            'Kas_model',
            'Akun_model',
            'Unit_usaha_model',
            'Laba_rugi_model'
        ]);
    }

    /* =====================================================
     * LIST TRANSAKSI
     * ===================================================== */

    public function index()
    {
        $data = [
            'title' => 'Transaksi Keuangan',
            'data'  => $this->Transaksi_keuangan_model->get_all()
        ];

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/index', $data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * FORM TAMBAH
     * ===================================================== */

    public function tambah()
    {
        $data = [

            'title' => 'Tambah Transaksi Keuangan',

            'kas' => $this->Kas_model->get_all(),

            'akun' => $this->Akun_model->get_all(),

            'unit_usaha' => $this->Unit_usaha_model->get_all()

        ];

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/tambah', $data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * SIMPAN TRANSAKSI
     * ===================================================== */

    public function simpan()
    {
        $post = $this->input->post(NULL, TRUE);

        if (!$this->Transaksi_keuangan_model->insert($post)) {

            $this->session->set_flashdata(
                'error',
                'Transaksi gagal disimpan.'
            );

            redirect('transaksi_keuangan/tambah');
        }

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil disimpan.'
        );

        redirect('transaksi_keuangan');
    }

    /* =====================================================
     * FORM EDIT
     * ===================================================== */
        /* =====================================================
     * FORM EDIT
     * ===================================================== */

    public function edit($id = null)
    {
        if (empty($id)) {
            show_404();
        }

        $transaksi = $this->Transaksi_keuangan_model->get_by_id($id);

        if (!$transaksi) {
            show_404();
        }

        /*
        |------------------------------------------------------
        | Transaksi SHU tidak boleh diedit
        |------------------------------------------------------
        */

        if ($transaksi->sumber === 'SHU') {

            $this->session->set_flashdata(
                'error',
                'Transaksi SHU tidak dapat diedit. Gunakan menu Posting SHU.'
            );

            redirect('transaksi_keuangan');
        }

        $data = [

            'title'         => 'Edit Transaksi Keuangan',

            'transaksi'     => $transaksi,

            'kas'           => $this->Kas_model->get_all(),

            'akun'          => $this->Akun_model->get_all(),

            'unit_usaha'    => $this->Unit_usaha_model->get_all()

        ];

        $this->load->view('templates/header', $data);
        $this->load->view('transaksi_keuangan/edit', $data);
        $this->load->view('templates/footer');
    }


    /* =====================================================
     * UPDATE TRANSAKSI
     * ===================================================== */

    public function update($id = null)
    {
        if (empty($id)) {
            show_404();
        }

        $transaksi = $this->Transaksi_keuangan_model->get_by_id($id);

        if (!$transaksi) {
            show_404();
        }

        /*
        |------------------------------------------------------
        | SHU tidak boleh diubah manual
        |------------------------------------------------------
        */

        if ($transaksi->sumber === 'SHU') {

            $this->session->set_flashdata(
                'error',
                'Transaksi SHU tidak dapat diubah.'
            );

            redirect('transaksi_keuangan');
        }

        $post = $this->input->post(NULL, TRUE);

        if (!$this->Transaksi_keuangan_model->update($id, $post)) {

            $this->session->set_flashdata(
                'error',
                'Transaksi gagal diperbarui.'
            );

            redirect('transaksi_keuangan/edit/' . $id);
        }

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil diperbarui.'
        );

        redirect('transaksi_keuangan');
    }


    /* =====================================================
     * HAPUS TRANSAKSI
     * ===================================================== */

    public function hapus($id = null)
    {
        if (empty($id)) {
            show_404();
        }

        $transaksi = $this->Transaksi_keuangan_model->get_by_id($id);

        if (!$transaksi) {
            show_404();
        }

        /*
        |------------------------------------------------------
        | SHU tidak boleh dihapus manual
        |------------------------------------------------------
        */

        if ($transaksi->sumber === 'SHU') {

            $this->session->set_flashdata(
                'error',
                'Transaksi SHU tidak dapat dihapus.'
            );

            redirect('transaksi_keuangan');
        }

        if (!$this->Transaksi_keuangan_model->delete($id)) {

            $this->session->set_flashdata(
                'error',
                'Transaksi gagal dihapus.'
            );

            redirect('transaksi_keuangan');
        }

        $this->session->set_flashdata(
            'success',
            'Transaksi berhasil dihapus.'
        );

        redirect('transaksi_keuangan');
    }


    /* =====================================================
     * POSTING SHU
     * ===================================================== */

    public function posting_shu()
    {
        /*
        |------------------------------------------------------
        | Ambil Periode
        |------------------------------------------------------
        */

        $bulan = (int) $this->input->post('bulan', TRUE);
        $tahun = (int) $this->input->post('tahun', TRUE);

        /*
        |------------------------------------------------------
        | Validasi
        |------------------------------------------------------
        */

        if ($bulan < 1 || $bulan > 12 || $tahun < 2000) {

            $this->session->set_flashdata(
                'error',
                'Periode posting SHU tidak valid.'
            );

            redirect('laba_rugi');
        }

        /*
        |------------------------------------------------------
        | Periode
        |------------------------------------------------------
        */

        $dari = $tahun . '-' . sprintf('%02d', $bulan) . '-01';

        $sampai = date(
            'Y-m-t',
            strtotime($dari)
        );

        /*
        |------------------------------------------------------
        | Proses Posting
        |------------------------------------------------------
        */

        $hasil = $this->Transaksi_keuangan_model
                      ->generate_shu(
                          $bulan,
                          $tahun
                      );

        /*
        |------------------------------------------------------
        | Hasil
        |------------------------------------------------------
        */

        if ($hasil === TRUE) {

            $this->session->set_flashdata(
                'success',
                'Posting SHU berhasil dilakukan.'
            );

        } else {

            $pesan = is_string($hasil)
                        ? $hasil
                        : 'Posting SHU gagal.';

            $this->session->set_flashdata(
                'error',
                $pesan
            );
        }

        /*
        |------------------------------------------------------
        | Kembali ke periode yang sama
        |------------------------------------------------------
        */

        redirect(
            'laba_rugi?dari=' .
            $dari .
            '&sampai=' .
            $sampai
        );
    }

    /* =====================================================
     * RESET POSTING SHU
     * ===================================================== */

    /* =====================================================
     * RESET POSTING SHU
     * ===================================================== */

    public function reset_shu()
    {
        /*
        |------------------------------------------------------
        | Ambil Periode
        |------------------------------------------------------
        */

        $bulan = (int) $this->input->post('bulan', TRUE);
        $tahun = (int) $this->input->post('tahun', TRUE);

        /*
        |------------------------------------------------------
        | Validasi
        |------------------------------------------------------
        */

        if ($bulan < 1 || $bulan > 12 || $tahun < 2000) {

            $this->session->set_flashdata(
                'error',
                'Periode reset SHU tidak valid.'
            );

            redirect('laba_rugi');
        }

        /*
        |------------------------------------------------------
        | Periode
        |------------------------------------------------------
        */

        $dari = $tahun . '-' . sprintf('%02d', $bulan) . '-01';

        $sampai = date(
            'Y-m-t',
            strtotime($dari)
        );

        /*
        |------------------------------------------------------
        | Reset SHU
        |------------------------------------------------------
        */

        $hasil = $this->Transaksi_keuangan_model
                      ->reset_shu(
                          $bulan,
                          $tahun
                      );

        /*
        |------------------------------------------------------
        | Hasil
        |------------------------------------------------------
        */

        if ($hasil === TRUE) {

            $this->session->set_flashdata(
                'success',
                'Posting SHU berhasil direset.'
            );

        } else {

            $pesan = is_string($hasil)
                        ? $hasil
                        : 'Reset Posting SHU gagal.';

            $this->session->set_flashdata(
                'error',
                $pesan
            );
        }

        /*
        |------------------------------------------------------
        | Kembali ke periode yang sama
        |------------------------------------------------------
        */

        redirect(
            'laba_rugi?dari=' .
            $dari .
            '&sampai=' .
            $sampai
        );
    }

}