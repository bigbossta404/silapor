<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_con extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('pengguna_mod');
        $this->load->library('pagination');
    }
    public function index()
    {
        //Pagination Surat
        $config['base_url'] = 'http://localhost/silapor/index';
        $config['total_rows'] = $this->pengguna_mod->countAllsurat();
        $config['per_page'] = 4;

        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = ' <li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Terakhir';
        $config['last_tag_open'] = ' <li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fas fa-long-arrow-alt-right"></i>';
        $config['next_tag_open'] = ' <li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fas fa-long-arrow-alt-left"></i>';
        $config['prev_tag_open'] = ' <li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = ' <li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = ' <li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);
        //End Pagination 


        $data['session'] = $this->pengguna_mod->pengguna();
        $data['start'] = $this->uri->segment(2);
        $data['d_surat'] = $this->pengguna_mod->getData_surat($config['per_page'], $data['start']);
        $data['jenisaduan'] = $this->pengguna_mod->jenisaduan();
        $data['title'] = 'Dashboard';

        $data['btn'] = ' <div class="d-sm-flex align-items-center">
        <h1 class="h4 mb-0 text-gray-800">Kotak Surat</h1>
        <div class="btn btn-primary ml-4" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> Buat Laporan</div>
        </div>';
        $this->load->view('pub_pengguna/layout/header', $data);
        $this->load->view('pub_pengguna/dashboard', $data);
        $this->load->view('pub_pengguna/layout/footer', $data);
    }
}
