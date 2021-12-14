<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('pengguna_mod');
        $this->load->model('petugas_mod');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 1) {
            redirect('petugas');
        } else if ($this->session->userdata('level') == 2) {
            redirect('pengguna/index');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|trim', [
                'required' => 'Email wajib diisi'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim', [
                'required' => 'Password dibutuhkan'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/login');
            } else {
                $this->_login();
            }
        }
    }

    // LOGIN PETUGAS
    public function loginpetugaspkt()
    {
        if ($this->session->userdata('level') == 1) {
            redirect('petugas');
        } else if ($this->session->userdata('level') == 2) {
            redirect('pengguna/index');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|trim', [
                'required' => 'Email wajib diisi'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim', [
                'required' => 'Password dibutuhkan'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/loginpetugas');
            } else {
                $this->_loginpetugas();
            }
        }
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->pengguna_mod->getAkun($email);
        if ($user) {
            if ($user['active'] == 1) {
                if ($password == $user['password']) {
                    $data = [
                        'id_pelapor' => $user['id_pelapor'],
                        'email' => $user['email'],
                        'nama' => $user['nama'],
                        'profile' => $user['profile'],
                        'level' => 2,
                    ];
                    $this->session->set_userdata('logged', TRUE);
                    $this->session->set_userdata($data);
                    redirect('pengguna/index');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
                   Password salah.
                    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                  </div>');

                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                Akun belum aktif.
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
              </div>');

                redirect('/');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');

            redirect('/');
        }
    }
    private function _loginpetugas()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->petugas_mod->getAkun($email);
        if ($user) {
            if ($user['active'] == 1) {
                if ($password == $user['password']) {
                    $data = [
                        'id_petugas' => $user['id_petugas'],
                        'email' => $user['email'],
                        'nama' => $user['nama'],
                        'profile' => $user['profile'],
                        'level' => 1,
                    ];
                    $this->session->set_userdata('logged', TRUE);
                    $this->session->set_userdata($data);
                    redirect('petugas');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible" role="alert">
                   Password salah.
                    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                  </div>');

                    redirect('loginpetugas');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                Akun belum aktif.
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
              </div>');

                redirect('loginpetugas');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Email tidak terdaftar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');

            redirect('loginpetugas');
        }
    }

    // public function daftar()
    // {
    //     if ($this->session->userdata('level') == 1) {
    //         redirect('petugas');
    //     } else if ($this->session->userdata('level') == 2) {
    //         redirect('pengguna/index');
    //     } else {
    // $this->form_validation->set_rules('nama-reg', 'Nama-reg', 'required|trim|callback_alpha_dash_space', [
    //     'required' => 'Nama wajib diisi',
    // ]);
    // $this->form_validation->set_rules('email-reg', 'Email-reg', 'required|trim|valid_email|is_unique[pelapor.email]', [
    //     'required' => 'Email wajib diisi',
    //     'valid_email' => 'Email tidak valid',
    //     'is_unique' => 'Email sudah terdaftar'
    // ]);
    // $this->form_validation->set_rules('jk-reg', 'Jk-reg', 'required|trim|in_list[Pria,Wanita]', [
    //     'required' => 'Jenis Kelamin wajib diisi',
    //     'in_list' => 'Jenis Kelamin tidak valid'
    // ]);
    // $this->form_validation->set_rules('password-reg', 'Password-reg', 'required|trim|min_length[5]|max_length[11]', [
    //     'required' => 'Password dibutuhkan',
    //     'min_length' => 'Password minimal 6 karakter',
    //     'max_length' => 'Password maksimal 10 karakter',
    // ]);
    // $this->form_validation->set_rules('repassword', 'Repassword', 'required|trim|matches[password-reg]', [
    //     'required' => 'Password dibutuhkan',
    //     'matches' => 'Password tidak sama'
    // ]);
    //         $this->form_validation->set_rules('input-ktp-regis', 'Input-ktp-regis', 'required', [
    //             'required' => 'E-KTP dibutuhkan'
    //         ]);
    //         $this->form_validation->set_rules('input-kk-regis', 'Input-kk-regis', 'required', [
    //             'required' => 'Kartu keluarga dibutuhkan'
    //         ]);
    //         if ($this->form_validation->run() == false) {
    //             $this->load->view('auth/register');
    //         } else {
    //             $this->_daftar();
    //         }
    //     }
    // }
    public function daftar()
    {
        if ($this->session->userdata('level') == 1) {
            redirect('petugas');
        } else if ($this->session->userdata('level') == 2) {
            redirect('pengguna/index');
        } else {
            $this->load->view('auth/register');
        }
    }

    function dodaftar()
    {
        $this->form_validation->set_rules('nama-reg', 'Nama-reg', 'required|trim|callback_alpha_dash_space', [
            'required' => 'Nama wajib diisi',
        ]);
        $this->form_validation->set_rules('email-reg', 'Email-reg', 'required|trim|valid_email|is_unique[pelapor.email]', [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('jk-reg', 'Jk-reg', 'required|trim|in_list[Pria,Wanita]', [
            'required' => 'Jenis Kelamin wajib diisi',
            'in_list' => 'Jenis Kelamin tidak valid'
        ]);
        $this->form_validation->set_rules('password-reg', 'Password-reg', 'required|trim|min_length[5]|max_length[11]', [
            'required' => 'Password dibutuhkan',
            'min_length' => 'Password minimal 6 karakter',
            'max_length' => 'Password maksimal 10 karakter',
        ]);
        $this->form_validation->set_rules('repassword', 'Repassword', 'required|trim|matches[password-reg]', [
            'required' => 'Password dibutuhkan',
            'matches' => 'Password tidak sama'
        ]);
        // $this->form_validation->set_rules('input-ktp', 'Input-ktp', 'required', [
        //     'required' => 'E-ktp dibutuhkan'
        // ]);
        // $this->form_validation->set_rules('input-kk', 'Input-kk', 'required|', [
        //     'required' => 'Kartu Keluarga dibutuhkan'
        // ]);
        if ($this->form_validation->run() == false) {
            $alert = array(
                'error' => true,
                'nama' => form_error('nama-reg', '<small>', '</small>'),
                'email' => form_error('email-reg', '<small>', '</small>'),
                'jk' => form_error('jk-reg', '<small>', '</small>'),
                'pass' => form_error('password-reg', '<small>', '</small>'),
                'repass' => form_error('repassword', '<small>', '</small>'),
                // 'input_ktp' => form_error('input-ktp', '<small>', '</small>'),
                // 'input_kk' => form_error('input-kk', '<small>', '</small>'),
            );
            echo json_encode($alert);
        } else {
            $data =  [
                'nama' => $this->input->post('nama-reg'),
                'email' => $this->input->post('email-reg'),
                'jk' => $this->input->post('jk-reg'),
                'password' => $this->input->post('password-reg'),
                'active' => '0',
                'is_exist' => '1'
            ];
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
                    $data['img_kk'] = $this->kk->data('file_name');
                }
            }

            if (isset($data['error_ktp']) || isset($data['error_kk'])) {
                $alert = array(
                    'error_upload' => true,
                    'error_ktp' => (isset($data['error_ktp'])) ? $data['error_ktp'] : '',
                    'error_kk' => (isset($data['error_kk'])) ? $data['error_kk'] : '',
                );
                echo json_encode($alert);
            } else if (empty($_FILES['input-ktp']['name'] || $_FILES['input-kk']['name'])) {
                $alert = array(
                    'error' => true,
                    'input_ktp' => '<small>E-KTP dibutuhkan</small>',
                    'input_kk' => '<small>Kartu Keluarga dibutuhkan</small>'
                );
                echo json_encode($alert);
            } else {
                $doRegis = $this->pengguna_mod->insertRegis($data);
                if ($doRegis) {
                    $alert = array(
                        'sukses' => true,
                        'data' => $data,
                    );
                    echo json_encode($alert);
                } else {
                    echo json_encode('gagal');
                }
            }
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
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
