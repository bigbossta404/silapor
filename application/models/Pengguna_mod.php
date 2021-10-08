<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_mod extends CI_Model
{
    public function pengguna()
    {
        $this->db->select('*');
        $this->db->from('pelapor');
        $this->db->where('id_pelapor', 3);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getData_surat($limit, $start)
    {
        $this->db->select('no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, ps.id_proses idps,proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses');
        $this->db->from('surat s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas');
        $this->db->join('aktivitas_surat a', 'a.id_surat = s.id_surat');
        $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->where('s.id_pelapor', 3);
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result_array();
    }

    function countAllsurat()
    {
        $this->db->select('no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, ps.id_proses idps,proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses');
        $this->db->from('surat s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas');
        $this->db->join('aktivitas_surat a', 'a.id_surat = s.id_surat');
        $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->where('s.id_pelapor', 3);
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }
    function jenisaduan()
    {
        $this->db->select('*');
        $this->db->from('berkas');
        $query = $this->db->get();
        return $query->result_array();
    }
}
