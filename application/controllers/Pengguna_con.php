<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_con extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('pengguna_mod');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('logged')) {
            $data['ses_akun'] = $this->pengguna_mod->pengguna($this->session->userdata('email'));

            $config['base_url'] = 'http://localhost/silapor/pengguna/index';
            $config['total_rows'] = $this->pengguna_mod->countAllsurat($data['ses_akun']);
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

            $data['start'] = $this->uri->segment(3);
            $data['d_surat'] = $this->pengguna_mod->getData_surat($config['per_page'], $data['start'], $data['ses_akun']);
            $data['jenisaduan'] = $this->pengguna_mod->jenisaduan();
            $data['title'] = 'Dashboard';

            $data['btn'] = ' <div class="d-sm-flex align-items-center">
            <h1 class="h4 mb-0 text-gray-800">Kotak Surat</h1>
            <div class="btn btn-primary ml-4" data-toggle="modal" data-target=".buatlaporan"><i class="fas fa-plus"></i> Buat Laporan</div>
            </div>';
            $this->load->view('pub_pengguna/layout/header', $data);
            $this->load->view('pub_pengguna/dashboard', $data);
            $this->load->view('pub_pengguna/layout/footer', $data);
        } else {
            redirect('/');
        }
        //Pagination Surat

    }

    function submitLaporan()
    {
        $session = $this->pengguna_mod->pengguna($this->session->userdata('email'));
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'trim|required',
            array(
                'required' => 'Nama wajib isi.'
            )
        );
        $this->form_validation->set_rules(
            'aduan',
            'Aduan',
            'trim|required|in_list[1,2,3,4]',
            array(
                'required' => 'Aduan wajib isi.',
                'in_list' => 'Input tidak valid.',
            )
        );
        $this->form_validation->set_rules(
            'isilapor',
            'Isilapor',
            'trim|required',
            array(
                'required' => 'Laporan wajib isi.'
            )
        );

        $num = $this->pengguna_mod->makeRandom();

        if ($this->form_validation->run() == false) {
            $alert = array(
                'error' => true,
                'nama' => form_error('nama', '<small>', '</small>'),
                'aduan' => form_error('aduan', '<small>', '</small>'),
                'isilapor' => form_error('isilapor', '<small>', '</small>')
            );
            echo json_encode($alert);
        } else {
            $datalapor = array(
                'no_lp' =>  'LP' . ($num['num'] + 1),
                'keterangan' => $this->input->post('isilapor'),
                'id_pelapor' => $session['id_pelapor'],
                'id_berkas' => $this->input->post('aduan')
            );
            $do_submit = $this->pengguna_mod->insertLapor($datalapor);
            if ($do_submit == true) {
                echo json_encode('sukses');
            } else {
                echo json_encode('gagal');
            }
        }
    }

    public function viewLaporan($id_surat)
    {
        if ($this->session->userdata('logged')) {
            $data['ses_akun'] = $this->pengguna_mod->pengguna($this->session->userdata('email'));
            $data['dl'] = $this->pengguna_mod->getData_byid($id_surat);
            $data['title'] = 'Detail Laporan';

            $this->load->view('pub_pengguna/layout/header', $data);
            $this->load->view('pub_pengguna/detailLap', $data);
            $this->load->view('pub_pengguna/layout/footer', $data);
        } else {
            redirect('/');
        }
    }
}
