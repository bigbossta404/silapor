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

            if ($data['ses_akun']['img_ktp'] == null || $data['ses_akun']['img_kk'] == null) {
                $data['btn'] = ' <div class="d-sm-flex align-items-center">
            <h1 class="h4 mb-0 text-gray-800">Kotak Surat</h1>
            <div class="btn btn-primary ml-4" data-toggle="modal" data-target=".noticelap"><i class="fas fa-plus"></i> Buat Laporan</div>
            </div>';
            } else {
                $data['btn'] = ' <div class="d-sm-flex align-items-center">
                <h1 class="h4 mb-0 text-gray-800">Kotak Surat</h1>
                <div class="btn btn-primary ml-4" data-toggle="modal" data-target=".buatlaporan"><i class="fas fa-plus"></i> Buat Laporan</div>
                </div>';
            }

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
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Detail Laporan</h4>';
            $this->load->view('pub_pengguna/layout/header', $data);
            $this->load->view('pub_pengguna/detailLap', $data);
            $this->load->view('pub_pengguna/layout/footer', $data);
        } else {
            redirect('/');
        }
    }

    public function viewProfile()
    {
        if ($this->session->userdata('logged')) {
            $data['ses_akun'] = $this->pengguna_mod->pengguna($this->session->userdata('email'));
            $data['title'] = 'Profile';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Pengaturan Akun</h4>';
            $this->load->view('pub_pengguna/layout/header', $data);
            $this->load->view('pub_pengguna/profile', $data);
            $this->load->view('pub_pengguna/layout/footer', $data);
        } else {
            redirect('/');
        }
    }

    public function saveProfile()
    {
        if ($this->session->userdata('logged')) {

            $this->form_validation->set_rules('nama_p', 'Nama_p', 'required|trim|callback_alpha_dash_space', [
                'required' => 'Nama wajib diisi'
            ]);
            $this->form_validation->set_rules('email_p', 'Email_p', 'required|trim|valid_email', [
                'required' => 'Email wajib diisi',
                'valid_email' => 'Email tidak valid',
            ]);
            $this->form_validation->set_rules('jk_p', 'Jk_p', 'required|trim|in_list[Pria,Wanita]', [
                'required' => 'Jenis Kelamin wajib diisi',
                'in_list' => 'Jenis Kelamin tidak valid'
            ]);
            $this->form_validation->set_rules('nomor_p', 'Nomor_p', 'required|trim|numeric|min_length[12]|max_length[13]', [
                'required' => 'Jenis Kelamin wajib diisi',
                'numeric' => 'Harus format angka',
                'min_length' => 'Minimal 12 digit',
                'max_length' => 'Maksimal 13 digit'
            ]);
            $this->form_validation->set_rules('alamat_p', 'Alamat_p', 'required|trim', [
                'required' => 'Alamat wajib diisi',
            ]);
            if ($this->form_validation->run() == false) {
                $alert = array(
                    'error' => true,
                    'nama_p' => form_error('nama_p', '<small>', '</small>'),
                    'email_p' => form_error('email_p', '<small>', '</small>'),
                    'jk_p' => form_error('jk_p', '<small>', '</small>'),
                    'nomor_p' => form_error('nomor_p', '<small>', '</small>'),
                    'alamat_p' => form_error('alamat_p', '<small>', '</small>'),
                );
                echo json_encode($alert);
            } else {
                $ses_akun = $this->pengguna_mod->pengguna($this->session->userdata('email'));
                $id = $ses_akun['id_pelapor'];
                $old_pp = $ses_akun['profile'];
                $old_ktp = $ses_akun['img_ktp'];
                $old_kk = $ses_akun['img_kk'];
                $data = [
                    'nama' => $_POST['nama_p'],
                    'email' => $_POST['email_p'],
                    'jk' => $_POST['jk_p'],
                    'notelp' => $_POST['nomor_p'],
                    'alamat' => $_POST['alamat_p'],
                ];

                if (!empty($_FILES['upload-pp']['name'])) {
                    $config = array();
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path']          = './assets/img/profile';
                    $config['allowed_types']        = 'jpeg|jpg|png';
                    $config['max_size']             = 2048;

                    $this->load->library('upload', $config, 'profile');
                    $this->profile->initialize($config);
                    $profile = $this->profile->do_upload('upload-pp');
                    if (!$profile) {
                        $data['error_pp'] = $this->profile->display_errors('<small>', '</small>');
                    } else {
                        unlink('assets/img/profile/' . $old_pp);
                        $data['profile'] = $this->profile->data('file_name');
                    }
                }
                //Config KTP 
                if (!empty($_FILES['input-ktp']['name'])) {
                    $config = array();
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path']          = './assets/img/ektp';
                    $config['allowed_types']        = 'pdf|jpeg|jpg|png';
                    $config['max_size']             = 2048;

                    $this->load->library('upload', $config, 'ektp');
                    $this->ektp->initialize($config);
                    $ektp = $this->ektp->do_upload('input-ktp');

                    if (!$ektp) {
                        $data['error_ktp'] = $this->ektp->display_errors('<small>', '</small>');
                    } else {
                        unlink('assets/img/ektp/' . $old_ktp);
                        $data['img_ktp'] = $this->ektp->data('file_name');
                    }
                }
                //Config KK 
                if (!empty($_FILES['input-kk']['name'])) {
                    $config = array();
                    $config['encrypt_name'] = TRUE;
                    $config['upload_path']          = './assets/img/kk';
                    $config['allowed_types']        = 'pdf|jpeg|jpg|png';
                    $config['max_size']             = 2048;

                    $this->load->library('upload', $config, 'kk');
                    $this->kk->initialize($config);
                    $kk = $this->kk->do_upload('input-kk');

                    if (!$kk) {
                        $data['error_kk'] = $this->kk->display_errors('<small>', '</small>');
                    } else {
                        unlink('assets/img/kk/' . $old_kk);
                        $data['img_kk'] = $this->kk->data('file_name');
                    }
                }

                // echo json_encode(var_dump($data));
                if (isset($data['error_pp']) || isset($data['error_ktp']) || isset($data['error_kk'])) {
                    $alert = array(
                        'error_upload' => true,
                        'error_pp' => (isset($data['error_pp'])) ? $data['error_pp'] : '',
                        'error_ktp' => (isset($data['error_ktp'])) ? $data['error_ktp'] : '',
                        'error_kk' => (isset($data['error_kk'])) ? $data['error_kk'] : '',
                    );
                    echo json_encode($alert);
                } else {

                    $do_save = $this->pengguna_mod->updateProfile($data, $id);
                    if ($do_save) {
                        echo json_encode('sukses');
                    } else {
                        echo json_encode('gagal');
                    }
                }
            }
        } else {
            redirect('/');
        }
    }

    function alpha_dash_space($nama)
    {
        if (!preg_match('/^[a-zA-Z\s]+$/', $nama)) {
            $this->form_validation->set_message('alpha_dash_space', 'Nama harus alfabet');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
