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
                $row[] =  '<button class="btn btn-primary btn_active" data-toggle="modal" id="' . $surat->id_surat . '"><i class="far fa-folder-open"></i></button>
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

    public function balasanSurat()
    {
        if ($this->session->userdata('level') == 1) {
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $data['title'] = 'Balasan Anda';

            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/balasan', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }

    public function inboxBalasan()
    {
        if ($this->session->userdata('level') == 1) {
            $akun_petugas = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $list = $this->petugas_mod->get_datatableBalas($akun_petugas);
            $data = array();
            foreach ($list as $surat) {
                $row = array();
                $row[] = '<b>' . $surat->no_lp . '</b><br> <span>' . $surat->pengguna . '<br><small>' . $surat->tanggal . '<small></span>';
                $row[] = $surat->nama_berkas;
                $row[] = $surat->proses;
                $row[] =  '<button class="btn btn-primary btn_active btn_balas" data-toggle="modal" id="' . $surat->id_surat . '"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn_hapus_balas" id="' . $surat->id_surat . '"><i class="fas fa-trash-alt"></i></button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->petugas_mod->count_allBalas($akun_petugas),
                "recordsFiltered" => $this->petugas_mod->count_filteredBalas($akun_petugas),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function pesanBalasan($id_surat)
    {
        if ($this->session->userdata('level') == 1) {
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $data['dl'] = $this->petugas_mod->getData_byid($id_surat);
            // echo var_dump($id_surat);
            $data['title'] = 'Detail Laporan';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Detail Laporan</h4>';
            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/balas_pesan', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }
}
