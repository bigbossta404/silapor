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

    // function getData_surat($limit, $start, $data)
    // {
    //     $this->db->select('s.id_sttlp idsttlp, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, proses, DATE_FORMAT(a.tgl_proses,"%d/%m/%Y") tgl_proses');
    //     $this->db->from('(SELECT MAX(tgl_proses) AS tgl_proses, id_sttlp
    //     FROM aktivitas_sttlp
    //     GROUP BY id_sttlp) r');
    //     $this->db->join('aktivitas_sttlp a', 'a.id_sttlp = r.id_sttlp');
    //     $this->db->join('sttlp s', 'a.id_sttlp = s.id_sttlp');
    //     $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
    //     $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
    //     // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
    //     $this->db->where('p.email', $data['email']);
    //     $this->db->where('a.tgl_proses', 'r.tgl_proses');
    //     $this->db->order_by('tanggal', 'DESC');
    //     $this->db->limit($limit, $start);

    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    function getData_surat($limit, $start, $data)
    {
        $query = $this->db->query('SELECT s.id_sttlp idsttlp, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, proses, DATE_FORMAT(t.tgl_proses,"%d/%m/%Y") tgl_proses
        FROM (SELECT MAX(tgl_proses) AS tgl_proses, id_sttlp
             FROM aktivitas_sttlp
             GROUP BY id_sttlp)r
        JOIN aktivitas_sttlp t ON t.id_sttlp = r.id_sttlp 
        JOIN sttlp s ON s.`id_sttlp` = t.`id_sttlp`
        JOIN pelapor p ON p.`id_pelapor` = s.`id_pelapor`
        LEFT JOIN berkas b ON b.`id_berkas` = s.`id_berkas`
        WHERE email = "' . $data['email'] . '"
        AND t.`tgl_proses` = r.tgl_proses
        ORDER BY tanggal DESC limit ' . $limit . ' offset ' . $start);
        return $query->result_array();
    }

    function countAllsurat($data)
    {
        $query = $this->db->query('SELECT s.id_sttlp idsttlp, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, b.nama_berkas nberkas, proses, DATE_FORMAT(t.tgl_proses,"%d/%m/%Y") tgl_proses
        FROM (SELECT MAX(tgl_proses) AS tgl_proses, id_sttlp
             FROM aktivitas_sttlp
             GROUP BY id_sttlp)r
        JOIN aktivitas_sttlp t ON t.id_sttlp = r.id_sttlp 
        JOIN sttlp s ON s.`id_sttlp` = t.`id_sttlp`
        JOIN pelapor p ON p.`id_pelapor` = s.`id_pelapor`
        LEFT JOIN berkas b ON b.`id_berkas` = s.`id_berkas`
        WHERE email = "' . $data['email'] . '"
        AND t.`tgl_proses` = r.tgl_proses
        ORDER BY tanggal DESC');
        return $query->num_rows();
    }
    function getData_byid($id)
    {
        $this->db->select('s.id_sttlp idsttlp, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, ket, b.nama_berkas nberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses, s.id_petugas, pt.nama namapetugas, DATE_FORMAT(tgl_kejadian,"%d/%m/%Y") tgl_kejadian, tempat_kejadian');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        $this->db->join('aktivitas_sttlp a', 'a.id_sttlp = s.id_sttlp');
        // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->join('petugas pt', 'pt.id_petugas = s.`id_petugas`', 'left');
        $this->db->where('s.id_sttlp', $id);
        $this->db->where('tgl_proses', '(SELECT MAX(tgl_proses) FROM aktivitas_sttlp a2 WHERE a2.`id_sttlp` = s.`id_sttlp`)', False);

        $query = $this->db->get();
        return $query->row_array();
    }
    function getData_allReply($id)
    {
        $this->db->select('s.id_sttlp idsttlp, no_lp, p.nama, ket, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses, s.id_petugas, pt.nama namapetugas');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('aktivitas_sttlp a', 'a.id_sttlp = s.id_sttlp');
        $this->db->join('petugas pt', 'pt.id_petugas = s.`id_petugas`');
        $this->db->where('s.id_sttlp', $id);
        $this->db->where('ket is NOT NULL', NULL, FALSE);
        $this->db->order_by('MONTH(tgl_proses)  DESC, DAY(tgl_proses) DESC, YEAR(tgl_proses) DESC');

        $query = $this->db->get();
        return $query->result_array();
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
        $this->db->from('sttlp');
        $query = $this->db->get();
        return $query->row_array();
    }

    function kamusProses()
    {
        $data = array(
            'ditolak' => 0,
            'terkirim' => 1,
            'diterima' => 2,
            'proses' => 3,
            'selesai' => 4,
        );

        return $data;
    }
    // CRUD Laporan

    function insertLapor($data)
    {
        $this->db->set('tanggal', 'NOW()', FALSE);
        $this->db->insert('sttlp ', $data);
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
    //     function cetakSTTLP($id)
    //     {
    //         $query = $this->db->query('SELECT * From sttlp
    //   WHERE id_sttlp = ' . $id . '
    //   ');
    // return $query->row_array();
    // }
    function cetakSTTLP($id)
    {
        $query = $this->db->query('SELECT s.id_sttlp, no_lp,  CASE WHEN DATE_FORMAT(tanggal,"%w") = 1 THEN "Minggu" WHEN DATE_FORMAT(tanggal,"%w") = 2 THEN "Senin" WHEN DATE_FORMAT(tanggal,"%w") = 3 THEN "Selasa"  WHEN DATE_FORMAT(tanggal,"%w") = 4 THEN "Rabu" WHEN DATE_FORMAT(tanggal,"%w") = 5 THEN "Kamis" WHEN DATE_FORMAT(tanggal,"%w") = 6 THEN "Jumat" END as harilap ,DAY(tanggal) tgllap, MONTH(tanggal) bulanlap, YEAR(tanggal) tahunlap, DATE_FORMAT(tanggal,"%H:%i") jamlap, nama_berkas, nama, jk, alamat, email, notelp, keterangan, DATE_FORMAT(tgl_kejadian,"%d-%m-%Y")tgl_kejadian, tempat_kejadian
      FROM sttlp s 
      left JOIN berkas b ON b.id_berkas = s.id_berkas
      JOIN pelapor p ON p.id_pelapor = s.`id_pelapor`
      WHERE s.id_sttlp = ' . $id . '
      ');
        return $query->row_array();
    }
}
