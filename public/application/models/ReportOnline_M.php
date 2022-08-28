<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportOnline_M extends CI_Model {

   var $column_order_online = [
         null, 'tbl_pemesananonline.nama_user', 'tbl_ruang.namaruang', 'tbl_pemesananonline.nama_kegiatan', 
         'tbl_pemesananonline.tanggal', 'tbl_pemesananonline.mulai', 'tbl_pemesananonline.selesai', null
   ];
   var $column_search_online = ['tbl_ruang.namaruang', 'tbl_pemesananonline.nama_kegiatan', 'tbl_pemesananonline.tanggal'];
   var $order_online = ['tbl_ruang.namaruang' => "asc"];

   private function _get_datatables_query($bulan, $tahun){

      $this->db->select('
          tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.status, tbl_ruang.namaruang,  tbl_pemesananonline.nama_user,
          tbl_pemesananonline.tanggal, tbl_pemesananonline.nama_kegiatan, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai,
          TIMEDIFF(tbl_pemesananonline.selesai, tbl_pemesananonline.mulai) AS waktu
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      $this->db->where('MONTH(tbl_pemesananonline.tanggal)', $bulan);
      $this->db->where('YEAR(tbl_pemesananonline.tanggal)', $tahun);

      $i = 0;

      foreach ($this->column_search_online as $item) { // loop column
         if(@$_POST['search']['value']) { // if datatable send POST for search
              
            if($i===0) { // first loop
               $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
               $this->db->like($item, $_POST['search']['value']);
            } else {
               $this->db->or_like($item, $_POST['search']['value']);
            }
         if(count($this->column_search_online) - 1 == $i) //last loop
             $this->db->group_end(); //close bracket
         }
         $i++;
      } // end loop

      if(isset($_POST['order'])) { // here order processing
         $this->db->order_by($this->column_order_online[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } else if(isset($this->order)) {
         $order = $this->order_online;
         $this->db->order_by(key($order), $order[key($order)]);
      }

   }

   function get_datatables($bulan, $tahun) {
		$this->_get_datatables_query($bulan, $tahun);
		if(@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    function count_filtered($bulan, $tahun) {
		$this->_get_datatables_query($bulan, $tahun);
		$query = $this->db->get();
		return $query->num_rows();
	}
    function count_all($bulan, $tahun) {
		$this->db->from('tbl_pemesananonline');
      $this->db->where('MONTH(tbl_pemesananonline.tanggal)', $bulan);
      $this->db->where('YEAR(tbl_pemesananonline.tanggal)', $tahun);
		return $this->db->count_all_results();
	}

   public function getDataBookingOnline($kategorimeeting = null){
      $a = "(tbl_pemesananonline.status = 2 OR tbl_pemesananonline.status = 3)";
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($kategorimeeting != null){
         $this->db->where('tbl_pemesananonline.kategorimeeting = "newmeeting"');
         $this->db->where($a);
      } 
      $query = $this->db->get()->result();
      return $query;
   }

   public function getDataBookingOnline1($kategorimeeting = null){
      $a = "(tbl_pemesananonline.status = 2 OR tbl_pemesananonline.status = 3)";
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($kategorimeeting != null){
         $this->db->where('tbl_pemesananonline.kategorimeeting = "joinmeeting"');
         $this->db->where($a);
      } 
      $query = $this->db->get()->result();
      return $query;
   }

   public function getDataFromStatus($status = null){
      $kategorimeeting = "newmeeting";
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      $this->db->where('tbl_pemesananonline.kategorimeeting', $kategorimeeting);
      if($status != null) $this->db->where('status', $status);
      $query = $this->db->get()->result();
      return $query;
   }

   public function getDataFromStatus2($status = null){
      $kategorimeeting = "joinmeeting";
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      $this->db->where('tbl_pemesananonline.kategorimeeting', $kategorimeeting);
      if($status != null) $this->db->where('status', $status);
      $query = $this->db->get()->result();
      return $query;
   }

   function getDetailNewMeeting($id = null, $kategorimeeting = null){
      $this->db->select('
          tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang, tbl_pemesananonline.nama_kegiatan, 
          tbl_pemesananonline.nama_aplikasi, tbl_pemesananonline.tanggal, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai, tbl_pemesananonline.kategorimeeting,
          tbl_pemesananonline.phone, tbl_pemesananonline.namaruang as nama_ruang, tbl_pemesananonline.status, tbl_pemesananonline.pesan_approve,tbl_pemesananonline.password, 
          tbl_pemesananonline.linkatauid, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($id != null && $kategorimeeting != null){
         $this->db->where('id_pemesanan', $id);
         $this->db->where('kategorimeeting', $kategorimeeting);
     }
      $query = $this->db->get();
      return $query;
  }

}