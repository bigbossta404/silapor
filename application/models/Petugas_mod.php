<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas_mod extends CI_Model
{
    public function getAkun($email)
    {
        $this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function pengguna($email)
    {
        $this->db->select('*');
        $this->db->from('petugas');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function pelapor($id)
    {
        $this->db->select('*');
        $this->db->from('pelapor');
        $this->db->where('id_pelapor', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function allPelapor()
    {
        $this->db->select('*');
        $this->db->from('pelapor');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function allPetugas()
    {
        $this->db->select('p.id_petugas, nama, email, p.active, count(id_sttlp) pelayanan');
        $this->db->from('petugas p');
        $this->db->join('sttlp s', 'p.id_petugas = s.id_petugas', 'left');
        $this->db->group_by('p.id_petugas');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getSttlpByPetugas($id)
    {
        $this->db->select('s.id_sttlp id_sttlp, no_lp, p.nama pengguna, tanggal, keterangan, nama_berkas ,s.id_petugas, tgl_proses, proses, tgl_kejadian');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 's.id_pelapor = p.id_pelapor');
        $this->db->join('aktivitas_sttlp aks', 'aks.id_sttlp = s.id_sttlp');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas');
        // $this->db->join('proses pr', 'pr.id_proses = aks.id_proses');
        $this->db->where('s.id_petugas', $id['id_petugas']);
        $this->db->where('tgl_proses', '(SELECT MAX(tgl_proses) FROM aktivitas_sttlp a2 WHERE a2.`id_sttlp` = s.`id_sttlp`)', False);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSttlpByYearPetugas($id)
    {
        $this->db->select('YEAR(tanggal) tahun');
        $this->db->from('sttlp');
        $this->db->where('id_petugas', $id['id_petugas']);
        $this->db->group_by('YEAR(tanggal)');
        $query = $this->db->get();
        return $query->result_array();
    }
    //================== Datatables Surat
    var $column_order_surat = array('no_lp', 'keterangan', 'tempat_kejadian', 'tgl_kejadian', null); //set column field database for datatable orderable
    var $column_search_surat = array('nama', 'no_lp', 'tgl_kejadian', 'tanggal', 'tempat_kejadian'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order_surat = ['tanggal' => 'desc']; // default o
    private function _get_datatableSurat()
    {

        $this->db->select('s.id_sttlp, no_lp, p.nama pengguna, date_format(tanggal,"%d-%m-%Y ( %H:%I )") tanggal, keterangan, nama_berkas ,s.id_petugas, tgl_proses, proses, tempat_kejadian, date_format(tgl_kejadian,"%d-%m-%Y") tgl_kejadian');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 's.id_pelapor = p.id_pelapor');
        $this->db->join('aktivitas_sttlp aks', 'aks.id_sttlp = s.id_sttlp');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        // $this->db->join('proses pr', 'pr.id_proses = aks.id_proses');
        $this->db->where('s.id_petugas IS NULL', null, false);

        $i = 0;

        foreach ($this->column_search_surat as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_surat) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_surat[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_surat)) {
            $order_surat = $this->order_surat;
            $this->db->order_by(key($order_surat), $order_surat[key($order_surat)]);
        }
    }

    function get_datatableSurat()
    {
        $this->_get_datatableSurat();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredSurat()
    {
        $this->_get_datatableSurat();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allSurat()
    {
        $this->db->from($this->_get_datatableSurat());

        return $this->db->count_all_results();
    }
    // ============================================================

    // ================= Jumlah Berkas yang dimiliki

    public function jumBerkas($id)
    {
        $this->db->select('sum(if(s.id_berkas = "1", 1, 0)) as aniaya, sum(if(s.id_berkas = "2", 1, 0)) as izin, sum(if(s.id_berkas = "3", 1, 0)) as kehilangan, sum(if(s.id_berkas = "4", 1, 0)) as rugi');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 's.id_pelapor = p.id_pelapor');
        $this->db->join('aktivitas_sttlp aks', 'aks.id_sttlp = s.id_sttlp');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas');
        $this->db->where('s.id_petugas', $id);
        $this->db->where('tgl_proses', '(SELECT MAX(tgl_proses) FROM aktivitas_sttlp a2 WHERE a2.`id_sttlp` = s.`id_sttlp`)', False);

        $query = $this->db->get();
        return $query->row_array();
    }

    //================== Datatables Balasan
    var $column_order_balas = array('no_lp', 'tanggal', 'keterangan', 'nama_berkas', null); //set column field database for datatable orderable
    var $column_search_balas = array('nama', 'no_lp', 'nama_berkas', 'tanggal', 'proses'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order_balas = ['tanggal' => 'desc']; // default o
    private function _get_datatableBalas($id)
    {

        $this->db->select('s.id_sttlp, no_lp, p.nama pengguna, date_format(tanggal,"%d-%m-%Y ( %H:%I )") tanggal, keterangan, nama_berkas ,s.id_petugas, tgl_proses, proses');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 's.id_pelapor = p.id_pelapor');
        $this->db->join('aktivitas_sttlp aks', 'aks.id_sttlp = s.id_sttlp');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas');
        // $this->db->join('proses pr', 'pr.id_proses = aks.id_proses');
        $this->db->where('s.id_petugas', $id['id_petugas']);
        $this->db->where('tgl_proses', '(SELECT MAX(tgl_proses) FROM aktivitas_sttlp a2 WHERE a2.`id_sttlp` = s.`id_sttlp`)', False);

        $i = 0;

        foreach ($this->column_search_balas as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_balas) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_balas[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_balas)) {
            $order_balas = $this->order_balas;
            $this->db->order_by(key($order_balas), $order_balas[key($order_balas)]);
        }
    }

    function get_datatableBalas($id)
    {
        $this->_get_datatableBalas($id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredBalas($id)
    {
        $this->_get_datatableBalas($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allBalas($id)
    {
        $this->db->from($this->_get_datatableBalas($id));

        return $this->db->count_all_results();
    }
    // ============================================================
    //================== Datatables Pelapor
    var $column_order_pelapor = array(null, 'nama', 'email', 'active', null); //set column field database for datatable orderable
    var $column_search_pelapor = array('nama', 'email', 'active'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order_pelapor = ['id' => 'desc']; // default o
    private function _get_datatablePelapor()
    {

        $this->db->select('*');
        $this->db->from('pelapor');
        $this->db->where('is_exist', '1');

        $i = 0;

        foreach ($this->column_search_pelapor as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search_pelapor) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_pelapor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_pelapor)) {
            $order_pelapor = $this->order_pelapor;
            $this->db->order_by(key($order_pelapor), $order_pelapor[key($order_pelapor)]);
        }
    }

    function get_datatablePelapor()
    {
        $this->_get_datatablePelapor();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredPelapor()
    {
        $this->_get_datatablePelapor();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allPelapor()
    {
        $this->db->from($this->_get_datatablePelapor());

        return $this->db->count_all_results();
    }
    // ============================================================

    function getData_byid($id)
    {
        $this->db->select('s.id_sttlp idsttlp, no_lp, p.nama, p.email email_pelapor, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, ket, b.nama_berkas nberkas, b.id_berkas idberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses, s.id_petugas id_petugas, pt.nama namapetugas, DATE_FORMAT(tgl_kejadian,"%d/%m/%Y") tgl_kejadian, tempat_kejadian');
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
    function getData_allProses($id)
    {
        $this->db->select('s.id_sttlp idsttlp, no_lp, p.nama, DATE_FORMAT(tanggal,"%d/%m/%Y") tglkirim, keterangan, ket, b.nama_berkas nberkas, proses, DATE_FORMAT(tgl_proses,"%d/%m/%Y") tgl_proses, s.id_petugas, pt.nama namapetugas');
        $this->db->from('sttlp s');
        $this->db->join('pelapor p', 'p.id_pelapor = s.id_pelapor');
        $this->db->join('berkas b', 'b.id_berkas = s.id_berkas', 'LEFT');
        $this->db->join('aktivitas_sttlp a', 'a.id_sttlp = s.id_sttlp');
        // $this->db->join('proses ps', 'ps.id_proses = a.`id_proses`');
        $this->db->join('petugas pt', 'pt.id_petugas = s.`id_petugas`');
        $this->db->where('s.id_sttlp', $id);
        $this->db->order_by('DAY(tgl_proses) DESC,MONTH(tgl_proses) DESC,YEAR(tgl_proses) DESC');

        $query = $this->db->get();
        return $query->result_array();
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
    function getData_berkas()
    {
        $this->db->select('*');
        $this->db->from('berkas');
        $query = $this->db->get();
        return $query->result_array();
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

    function insertBalasan($data)
    {
        $this->db->set('tgl_proses', 'NOW()', FALSE);
        $this->db->insert('aktivitas_sttlp ', $data);
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function deleteBalasan($id)
    {
        $this->db->where('id_sttlp', $id);
        $this->db->delete('sttlp');
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function deleteProfile($id)
    {
        $this->db->set('email', '-');
        $this->db->set('active', '0');
        $this->db->set('is_exist', '0');
        $this->db->where('id_pelapor', $id);
        $this->db->update('pelapor');
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function deleteProfileKTP($id)
    {
        // $this->db->set('active', '0');
        $this->db->set('img_ktp', null);
        $this->db->where('id_pelapor', $id);
        $this->db->update('pelapor');
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function deleteProfileKK($id)
    {
        // $this->db->set('active', '0');
        $this->db->set('img_kk', null);
        $this->db->where('id_pelapor', $id);
        $this->db->update('pelapor');
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }
    function updateAktivasi($data)
    {
        $this->db->set('active', $data['status']);
        $this->db->where('email', $data['email']);
        $this->db->update('pelapor');
        if ($this->db->affected_rows() > 0) {
            return true; // to the controller
        }
    }

    function cetakSTTLP($id)
    {
        $query = $this->db->query('SELECT s.id_sttlp, no_lp,  CASE WHEN DATE_FORMAT(tanggal,"%w") = 1 THEN "Minggu" WHEN DATE_FORMAT(tanggal,"%w") = 2 THEN "Senin" WHEN DATE_FORMAT(tanggal,"%w") = 3 THEN "Selasa"  WHEN DATE_FORMAT(tanggal,"%w") = 4 THEN "Rabu" WHEN DATE_FORMAT(tanggal,"%w") = 5 THEN "Kamis" WHEN DATE_FORMAT(tanggal,"%w") = 6 THEN "Jumat" END as harilap ,DAY(tanggal) tgllap, MONTH(tanggal) bulanlap, YEAR(tanggal) tahunlap, DATE_FORMAT(tanggal,"%H:%i") jamlap, nama_berkas, p.nama namapelapor, jk, alamat, p.email, notelp, keterangan, DATE_FORMAT(tgl_kejadian,"%d-%m-%Y")tgl_kejadian, tempat_kejadian, pt.nama namapetugas, s.id_petugas
  FROM sttlp s JOIN berkas b ON b.id_berkas = s.id_berkas
  JOIN pelapor p ON p.id_pelapor = s.`id_pelapor`
  join petugas pt on pt.id_petugas = s.id_petugas
  WHERE id_sttlp = ' . $id . '
  ');
        return $query->row_array();
    }
}
