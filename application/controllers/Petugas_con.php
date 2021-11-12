<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas_con extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('petugas_mod');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    public function index()
    {

        if ($this->session->userdata('level') == 1) {
            // echo 'login ' . $this->session->userdata('nama') . ' ID ' . $this->session->userdata('id_petugas');
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $data['title'] = 'Dashboard';

            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/dashboard', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
        //Pagination Surat

    }

    // Datatable Surat
    public function inboxSurat()
    {
        if ($this->session->userdata('level') == 1) {
            $list = $this->petugas_mod->get_datatableSurat();
            $data = array();
            foreach ($list as $surat) {
                $row = array();
                $row[] = '<b>' . $surat->no_lp . '</b><br> <span>' . $surat->pengguna . '<br><small>' . $surat->tanggal . '<small></span>';
                $row[] = $surat->keterangan;
                $row[] = $surat->nama_berkas;
                $row[] =  '<button class="btn btn-primary btn_active" data-toggle="modal" id="' . $surat->id_surat . '"><i class="far fa-paper-plane"></i> Balas</button>
                            <button class="btn btn-danger btn_hapusakun" id="' . $surat->id_surat . '"><i class="fas fa-trash-alt"></i></button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->petugas_mod->count_allSurat(),
                "recordsFiltered" => $this->petugas_mod->count_filteredSurat(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }
    // =============================================
}
