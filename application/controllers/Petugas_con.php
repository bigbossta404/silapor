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
                $row[] = $surat->tempat_kejadian;
                $row[] = $surat->tgl_kejadian;
                // $row[] = ($surat->nama_berkas == null) ? '<span class="bg-warning text-dark text-weight-bold pt-1 pb-1 pl-2 pr-2 rounded">Belum disortir<span>' : $surat->nama_berkas;
                $row[] =  '<button class="btn btn-primary btn_active btn_balas" id="' . $surat->id_sttlp . '"><i class="far fa-folder-open"></i></button>
                            <button class="btn btn-danger btn_hapusakun" id="' . $surat->id_sttlp . '"><i class="fas fa-trash-alt"></i></button>';
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
                $row[] =  '<button class="btn btn-primary btn_active btn_updatebalas" id="' . $surat->id_sttlp . '"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn_hapus_balas" id="' . $surat->id_sttlp . '"><i class="fas fa-trash-alt"></i></button>';
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

    public function pesanBalasan($id_sttlp)
    {
        if ($this->session->userdata('level') == 1) {
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $data['dl'] = $this->petugas_mod->getData_byid($id_sttlp);
            $data['reply'] = $this->petugas_mod->getData_allReply($id_sttlp);
            $data['berkas'] = $this->petugas_mod->getData_berkas();
            $data['proses'] = $this->petugas_mod->kamusProses();

            $data['title'] = 'Detail Laporan';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Detail Laporan</h4>';
            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/balas_pesan', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }
    function submitBalasan()
    {
        if ($this->session->userdata('level') == 1) {
            $session = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $this->form_validation->set_rules(
                'id',
                'Id',
                'trim|required|numeric',
                array(
                    'required' => 'tidak valid.',
                    'numeric' => 'tidak valid'
                )
            );
            $this->form_validation->set_rules(
                'berkas',
                'Berkas',
                'trim|required|in_list[1,2,3,4]',
                array(
                    'required' => 'Berkas wajib isi.',
                    'in_list' => 'Tidak valid'
                )
            );
            $this->form_validation->set_rules(
                'statusProses',
                'StatusProses',
                'trim|required',
                array(
                    'required' => 'Proses wajib isi.'
                )
            );

            if ($this->form_validation->run() == false) {
                $alert = array(
                    'error' => true,
                    'berkas' => form_error('berkas', '<small>', '</small>'),
                    'statusProses' => form_error('statusProses', '<small>', '</small>')
                );
                echo json_encode($alert);
            } else {
                $datalapor = array(
                    'ket' => $this->input->post('isibalasan'),
                    'proses' => $this->input->post('statusProses'),
                    'id_sttlp' => $this->input->post('id')
                );
                $cekdata = $this->petugas_mod->getData_byid($this->input->post('id'));

                if ($cekdata['proses'] != $this->input->post('statusProses') || $cekdata['ket'] != $this->input->post('isibalasan')) {
                    if ($cekdata['ket'] == $this->input->post('isibalasan')) {
                        unset($datalapor['ket']);
                        $do_submit = $this->petugas_mod->insertBalasan($datalapor);
                        if ($do_submit == true) {
                            $this->db->set('id_petugas', $session['id_petugas']);
                            $this->db->set('id_berkas', $this->input->post('berkas'));
                            $this->db->where('id_sttlp', $this->input->post('id'));
                            $this->db->update('sttlp');

                            echo json_encode('sukses');
                        } else {
                            echo json_encode('gagal');
                        }
                    } else {
                        $do_submit = $this->petugas_mod->insertBalasan($datalapor);
                        if ($do_submit == true) {
                            $this->db->set('id_petugas', $session['id_petugas']);
                            $this->db->set('id_berkas', $this->input->post('berkas'));
                            $this->db->where('id_sttlp', $this->input->post('id'));
                            $this->db->update('sttlp');

                            echo json_encode('sukses');
                        } else {
                            echo json_encode('gagal');
                        }
                    }
                } else if ($cekdata['idberkas'] != $this->input->post('berkas')) {
                    $this->db->set('id_petugas', $session['id_petugas']);
                    $this->db->set('id_berkas', $this->input->post('berkas'));
                    $this->db->where('id_sttlp', $this->input->post('id'));
                    $this->db->update('sttlp');
                    echo json_encode('sukses');
                }
            }
        } else {
            redirect('/');
        }
    }

    public function pelaporView()
    {
        if ($this->session->userdata('level') == 1) {
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));

            $data['title'] = 'Pelapor';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Laman Pelapor</h4>';
            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/pelapor', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }

    public function listPelapor()
    {
        if ($this->session->userdata('level') == 1) {
            $list = $this->petugas_mod->get_datatablePelapor();
            $data = array();
            $index = 1;
            foreach ($list as $p) {
                $row = array();
                $row[] = $index++;
                $row[] = $p->nama;
                $row[] = $p->email;
                $row[] = ($p->active == 1) ? '<div class="d-flex justify-content-center"><span class="bg-success status-akun">Aktif</span></div>' : '<div class="d-flex justify-content-center"><span class="bg-warning status-akun">Pending</span></div>';
                $row[] =  '<a href="../petugas_con/viewProfile/' . $p->id_pelapor . '" class="btn btn-primary btn_active btn_updatebalas"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" class="btn btn-danger btn_hapus_balas" id="' . $p->id_pelapor . '"><i class="fas fa-trash-alt"></i></a>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->petugas_mod->count_allPelapor(),
                "recordsFiltered" => $this->petugas_mod->count_filteredPelapor(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function viewProfile($id)
    {
        if ($this->session->userdata('level') == 1) {
            $data['user'] = $this->petugas_mod->pelapor($id);
            $data['title'] = 'Profile Pelapor';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Pengaturan Akun</h4>';
            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/profile', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }
}
