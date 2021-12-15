<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
                $row[] =  '<button class="btn btn-primary btn_active btn_balas" id="' . $surat->id_sttlp . '"><i class="far fa-folder-open"></i> Buka</button>';
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
                $row[] = '<b>' . $surat->no_lp . '</b><br> <span>' . $surat->pengguna . '<br></span>';
                $row[] = $surat->tanggal;
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

    function deleteInbox($id_sttlp)
    {
        $do_delete = $this->petugas_mod->deleteBalasan($id_sttlp);
        if ($do_delete) {
            echo json_encode('sukses');
        } else {
            echo json_encode('gagal');
        }
    }

    function rekapBalasan()
    {
        if ($this->session->userdata('level') == 1) {
            $akun_petugas = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $list = $this->petugas_mod->getSttlpByPetugas($akun_petugas);
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                        'color' => array('argb' => 'FFFF0000'),
                    ),
                ),
            );
            $sheet->getStyle('A1:')->applyFromArray($styleArray);
            $sheet->mergeCells('A1:H1');
            $sheet->setCellValue('A1', 'Rekap Surat Tanda Terima Laporan Polisi');
            $sheet->getStyle('A1:H1')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('A2:H2');
            $sheet->setCellValue('A2', 'Per ' . date('d/m/Y'));
            $sheet->getStyle('A2:H2')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'Nomor');
            $sheet->setCellValue('C3', 'Petugas');
            $sheet->setCellValue('D3', 'Pelapor');
            $sheet->setCellValue('E3', 'Berkas');
            $sheet->setCellValue('F3', 'Tanggal Kejadian');
            $sheet->setCellValue('G3', 'Tanggal Kirim');
            $sheet->setCellValue('H3', 'Status');
            foreach (range('A', 'H') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
                // $sheet->getStyle('B2:G8')->applyFromArray($styleArray);
            }
            $rows = 4;
            $id = 1;
            foreach ($list as $val) {
                $sheet->setCellValue('A' . $rows, $id);
                $sheet->setCellValue('B' . $rows, $val['no_lp']);
                $sheet->setCellValue('C' . $rows, $akun_petugas['nama']);
                $sheet->setCellValue('D' . $rows, $val['pengguna']);
                $sheet->setCellValue('E' . $rows, $val['nama_berkas']);
                $sheet->setCellValue('F' . $rows, $val['tgl_kejadian']);
                $sheet->setCellValue('G' . $rows, $val['tanggal']);
                $sheet->setCellValue('H' . $rows, $val['proses']);
                $rows++;
                $id++;
            }
            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Rekap_All_Balasan-' . $akun_petugas['id_petugas'] . '.xlsx"');
            $writer->save('php://output');
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
                            <a href="#" class="btn btn-danger btn_hapus_akun" id="' . $p->id_pelapor . '"><i class="fas fa-trash-alt"></i></a>';
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

    function deleteProfileAkun($id)
    {
        $do_delete = $this->petugas_mod->deleteProfile($id);
        if ($do_delete) {
            echo json_encode('sukses');
        } else {
            echo json_encode('gagal');
        }
    }
    function deleteProfileKTP($id)
    {
        $data = $this->petugas_mod->pelapor($id);
        $img_ktp = $data['img_ktp'];
        $do_delete = $this->petugas_mod->deleteProfileKTP($id);
        if ($do_delete) {
            unlink('assets/img/ektp/' . $img_ktp);
            echo json_encode('sukses');
        } else {
            echo json_encode('gagal');
        }
    }
    function deleteProfileKK($id)
    {
        $data = $this->petugas_mod->pelapor($id);
        $img_kk = $data['img_kk'];
        $do_delete = $this->petugas_mod->deleteProfileKK($id);
        if ($do_delete) {
            unlink('assets/img/kk/' . $img_kk);
            echo json_encode('sukses');
        } else {
            echo json_encode('gagal');
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

    function updateAktivasi()
    {
        if ($this->session->userdata('level') == 1) {
            $data = array(
                'email' => $this->input->post('email'),
                'status' => $this->input->post('status')
            );
            $do_submit = $this->petugas_mod->updateAktivasi($data);
            if ($do_submit) {
                echo json_encode('sukses');
            } else {
                echo json_encode('gagal');
            }
        } else {
            redirect('/');
        }
    }
    public function petugasView()
    {
        if ($this->session->userdata('level') == 1) {
            $data['ses_akun'] = $this->petugas_mod->pengguna($this->session->userdata('email'));
            $data['petugas'] = $this->petugas_mod->allPetugas();
            $data['title'] = 'Profile Pelapor';
            $data['heading'] = ' <h4 class="mb-0 text-gray-800">Pengaturan Akun</h4>';
            $this->load->view('pub_petugas/layout/header', $data);
            $this->load->view('pub_petugas/petugas', $data);
            $this->load->view('pub_petugas/layout/footer', $data);
        } else {
            redirect('/');
        }
    }
    // CETAK EXCEL
    function rekapAkunPelapor()
    {
        if ($this->session->userdata('level') == 1) {
            $list = $this->petugas_mod->allPelapor();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->mergeCells('A1:I1');
            $sheet->setCellValue('A1', 'Rekap Data Akun Pelapor');
            $sheet->getStyle('A1:I1')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('A2:I2');
            $sheet->setCellValue('A2', 'Per ' . date('d/m/Y'));
            $sheet->getStyle('A2:I2')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'Nama');
            $sheet->setCellValue('C3', 'JK');
            $sheet->setCellValue('D3', 'Email');
            $sheet->setCellValue('E3', 'Telp');
            $sheet->setCellValue('F3', 'Alamat');
            $sheet->setCellValue('G3', 'E-KTP');
            $sheet->setCellValue('H3', 'KK');
            $sheet->setCellValue('I3', 'Status');
            foreach (range('A', 'E') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }
            foreach (range('G', 'I') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }
            $rows = 4;
            $id = 1;
            foreach ($list as $val) {
                $sheet->setCellValue('A' . $rows, $id);
                $sheet->setCellValue('B' . $rows, $val['nama']);
                $sheet->setCellValue('C' . $rows, $val['jk']);
                $sheet->setCellValue('D' . $rows, $val['email']);
                $sheet->setCellValue('E' . $rows, $val['notelp']);
                $sheet->setCellValue('F' . $rows, $val['alamat']);
                $sheet->setCellValue('G' . $rows, ($val['img_ktp'] == null) ? 'Kosong' : 'Ada');
                $sheet->setCellValue('H' . $rows, ($val['img_kk'] == null) ? 'Kosong' : 'Ada');
                $sheet->setCellValue('I' . $rows, ($val['active'] == 0) ? 'Pending' : 'Aktif');
                $rows++;
                $id++;
            }
            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Rekap_All_Pelapor-' . date('dmY') . '.xlsx"');
            $writer->save('php://output');
        } else {
            redirect('/');
        }
    }
    function rekapAkunPetugas()
    {
        if ($this->session->userdata('level') == 1) {
            $list = $this->petugas_mod->allPetugas();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->mergeCells('A1:F1');
            $sheet->setCellValue('A1', 'Rekap Data Akun Petugas');
            $sheet->getStyle('A1:F1')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->mergeCells('A2:F2');
            $sheet->setCellValue('A2', 'Per ' . date('d/m/Y'));
            $sheet->getStyle('A2:F2')
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'ID Petugas');
            $sheet->setCellValue('C3', 'Nama');
            $sheet->setCellValue('D3', 'Email');
            $sheet->setCellValue('E3', 'Pelayanan');
            $sheet->setCellValue('F3', 'Status');
            foreach (range('A', 'F') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }
            $rows = 4;
            $id = 1;
            foreach ($list as $val) {
                $sheet->setCellValue('A' . $rows, $id);
                $sheet->setCellValue('B' . $rows, $val['id_petugas']);
                $sheet->setCellValue('C' . $rows, $val['nama']);
                $sheet->setCellValue('D' . $rows, $val['email']);
                $sheet->setCellValue('E' . $rows, $val['pelayanan']);
                $sheet->setCellValue('F' . $rows, ($val['active'] == 0) ? 'Pending' : 'Aktif');
                $rows++;
                $id++;
            }
            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Rekap_All_Petugas-' . date('dmY') . '.xlsx"');
            $writer->save('php://output');
        } else {
            redirect('/');
        }
    }

    // Cetak PDF

    function cetakSurat($id)
    {
        if ($this->session->userdata('level') == 1) {
            setlocale(LC_ALL, 'IND');
            $date_now = date('Y-m-d');
            $data['datenow'] = array(
                'hari' => strftime('%d', strtotime($date_now)),
                'bulan' => strftime('%B', strtotime($date_now)),
                'tahun' => strftime('%Y', strtotime($date_now)),
            );
            // $data['bulan'] = $month_name;
            $data['ds'] = $this->petugas_mod->cetakSTTLP($id);
            $this->load->view('pub_petugas/suratlapor', $data);
        } else {
            redirect('/');
        }
    }
}
