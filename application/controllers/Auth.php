<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
