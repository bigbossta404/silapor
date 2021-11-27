<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_mod extends CI_Model
{
    public function getAkun($email)
    {
        $this->db->select('*');
        $this->db->from('pelapor');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function pengguna($email)
    {
        $this->db->select('*');
        $this->db->from('pelapor');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getData_surat($limit, $start, $data)
    {
        $this->db->select('s.id_surat idsurat, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses');
        $this->db->from('sttl s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        $this->db->join('aktivitas_sttl a', 'a.id_surat = s.id_surat');
        // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->where('p.email', $data['email']);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result_array();
    }

    function countAllsurat($data)
    {
        $this->db->select('no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses');
        $this->db->from('sttl s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        $this->db->join('aktivitas_sttl a', 'a.id_surat = s.id_surat');
        // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->where('p.email', $data['email']);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function getData_byid($id)
    {
        $this->db->select('s.id_surat idsurat, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, ket, b.nama_berkas nberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses, s.id_petugas, pt.nama namapetugas');
        $this->db->from('sttl s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        $this->db->join('aktivitas_sttl a', 'a.id_surat = s.id_surat');
        // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->join('petugas pt', 'pt.id_petugas = s.`id_petugas`', 'left');
        $this->db->where('s.id_surat', $id);

        $query = $this->db->get();
        return $query->row_array();
    }
    function jenisaduan()
    {
        $this->db->select('*');
        $this->db->from('berkas');
        $query = $this->db->get();
        return $query->result_array();
    }
    function makeRandom()
    {
        $this->db->select('count(*) as num');
        $this->db->from('sttl');
        $query = $this->db->get();
        return $query->row_array();
    }

    function kamusProses()
    {
        $data = array(
            'ditolak' => 0,
            'terkirim' => 1,
            'diterima' => 2,
            'dievaluasi' => 3,
            'proses' => 4,
            'selesai' => 5,
        );

        return $data;
    }
    // CRUD Laporan

    function insertLapor($data)
    {
        $this->db->set('tanggal', 'NOW()', FALSE);
        $this->db->insert('sttl ', $data);
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function insertRegis($data)
    {
        $this->db->insert('pelapor', $data);
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }

    function updateProfile($data, $id)
    {
        $this->db->where('id_pelapor', $id);
        $this->db->update('pelapor', $data);
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }

    // End CRUD Laporan
}
