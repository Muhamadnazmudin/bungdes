<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_shu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login')){
            redirect('auth/login');
        }

        if(!in_array($this->session->userdata('role_id'),[1,2])){
            show_error('Akses ditolak');
        }

        $this->load->model([
            'Master_shu_model',
            'Akun_model'
        ]);
    }

    /* =====================================================
     * LIST DATA
     * ===================================================== */

    public function index()
    {
        $data['title'] = 'Master SHU';

        $data['data'] = $this->Master_shu_model
                            ->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('master_shu/index',$data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * FORM TAMBAH
     * ===================================================== */

    public function tambah()
    {
        $data['title'] = 'Tambah Master SHU';

        $data['akun'] = $this->Akun_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('master_shu/tambah',$data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * SIMPAN
     * ===================================================== */

    public function simpan()
    {
        $this->Master_shu_model->insert([

            'nama'        => $this->input->post('nama'),

            'akun_id'     => $this->input->post('akun_id'),

            'dasar'       => $this->input->post('dasar'),

            'persentase'  => $this->input->post('persentase'),

            'urutan'      => $this->input->post('urutan'),

            'aktif'       => 1

        ]);

        $this->session->set_flashdata(
            'success',
            'Data berhasil disimpan.'
        );

        redirect('master_shu');
    }

    /* =====================================================
     * FORM EDIT
     * ===================================================== */

    public function edit($id)
    {
        $data['title'] = 'Edit Master SHU';

        $data['row'] = $this->Master_shu_model
                            ->get_by_id($id);

        if(!$data['row']){
            show_404();
        }

        $data['akun'] = $this->Akun_model->get_all();

        $this->load->view('templates/header',$data);
        $this->load->view('master_shu/edit',$data);
        $this->load->view('templates/footer');
    }

    /* =====================================================
     * UPDATE
     * ===================================================== */

    public function update($id)
    {
        $this->Master_shu_model->update($id,[

            'nama'        => $this->input->post('nama'),

            'akun_id'     => $this->input->post('akun_id'),

            'dasar'       => $this->input->post('dasar'),

            'persentase'  => $this->input->post('persentase'),

            'urutan'      => $this->input->post('urutan')

        ]);

        $this->session->set_flashdata(
            'success',
            'Data berhasil diperbarui.'
        );

        redirect('master_shu');
    }

    /* =====================================================
     * HAPUS
     * ===================================================== */

    public function hapus($id)
    {
        $this->Master_shu_model->delete($id);

        $this->session->set_flashdata(
            'success',
            'Data berhasil dihapus.'
        );

        redirect('master_shu');
    }

}