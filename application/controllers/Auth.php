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
    }

    public function index()
    {

        if ($this->session->userdata('logged')) {
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

    public function daftar()
    {
        if ($this->session->userdata('logged')) {
            redirect('pengguna/index');
        } else {
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
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/register');
            } else {
                $this->_daftar();
            }
        }
    }

    private function _daftar()
    {
        $data =  array(
            'nama' => $this->input->post('nama-reg'),
            'email' => $this->input->post('email-reg'),
            'password' => $this->input->post('password-reg'),
            'active' => '0',
            'is_exist' => '1'
        );
        $doRegis = $this->pengguna_mod->insertRegis($data);
        if ($doRegis) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Daftar berhasil, silahkan tunggu verifikasi admin.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');
            redirect('daftar');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Daftar gagal.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');
            redirect('daftar');
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
