<?php

defined('BASEPATH') OR exit('No direct script access allowed');

   class ReportOffline_M extends CI_Model {

       // start datatables
      var $column_order = array(null, 'tbl_pemesanan.nama_user', 'tbl_ruang.namaruang', 'tbl_pemesanan.nama_kegiatan', 'tbl_pemesanan.tanggal', null, null); //set column field database for datatable orderable
      var $column_search = array('tbl_pemesanan.nama_user', 'tbl_ruang.namaruang', 'tbl_pemesanan.tanggal'); //set column field database for datatable searchable
      var $order = array('tbl_ruang.namaruang' => 'asc'); // default order

      private function _get_datatables_query($bulan, $tahun){

         $this->db->select('
             tbl_pemesanan.id_pemesanan, tbl_pemesanan.status, tbl_pemesanan.nama_user, tbl_ruang.namaruang, 
             tbl_pemesanan.tanggal, tbl_pemesanan.nama_kegiatan, tbl_pemesanan.mulai, tbl_pemesanan.selesai, TIMEDIFF(selesai, mulai) AS waktu
         ');
         $this->db->from('tbl_pemesanan');
         $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
         $this->db->where('MONTH(tbl_pemesanan.tanggal)', $bulan);
         $this->db->where('YEAR(tbl_pemesanan.tanggal)', $tahun);
    
         $i = 0;
 
         foreach ($this->column_search as $item) { // loop column
             if(@$_POST['search']['value']) { // if datatable send POST for search
                 
                 if($i===0) { // first loop
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
             } else {
                $this->db->or_like($item, $_POST['search']['value']);
             }
             if(count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
             }
             $i++;
         } // end loop
         if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }else if(isset($this->order)) {
            $order = $this->order;
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
         $this->db->from('tbl_pemesanan');
         $this->db->where('MONTH(tbl_pemesanan.tanggal)', $bulan);
         $this->db->where('YEAR(tbl_pemesanan.tanggal)', $tahun);
         return $this->db->count_all_results();
      }

      public function getDataOffline(){

         $a = "status = 2 OR status = 3";
         $this->db->select('
            tbl_pemesanan.id_pemesanan, tbl_pemesanan.emp_no, tbl_pemesanan.nama_user, tbl_ruang.namaruang,  
            tbl_pemesanan.tanggal, tbl_pemesanan.status, 
         ');
         $this->db->from('tbl_pemesanan');
         $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
         $this->db->where($a);
         $query = $this->db->get();
         return $query;

      }

      public function getDataFromStatus($status = null){
         $a = "status = 2 OR status = 3";
         $this->db->select('
            tbl_pemesanan.id_pemesanan, tbl_pemesanan.emp_no, tbl_pemesanan.nama_user, tbl_ruang.namaruang,  
            tbl_pemesanan.tanggal, tbl_pemesanan.status, 
         ');
         $this->db->from('tbl_pemesanan');
         $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
         if($status != null){
            $this->db->where('status', $status);  
         }else{
            $this->db->where($a);
         }
         $query = $this->db->get();
         return $query;
      }

      function getDetailDataOffline($id = null){
         $this->db->select('
            tbl_pemesanan.id_pemesanan, tbl_pemesanan.emp_no, tbl_pemesanan.nama_user, tbl_pemesanan.phone, tbl_ruang.namaruang, tbl_pemesanan.nama_kegiatan, 
            tbl_pemesanan.namaruang as nama_ruang, tbl_pemesanan.jumlah_peserta, tbl_pemesanan.nama_kegiatan, tbl_pemesanan.tanggal, tbl_pemesanan.mulai, 
            tbl_pemesanan.selesai,  tbl_pemesanan.status, tbl_pemesanan.pesan_approve,
         ');
         $this->db->from('tbl_pemesanan');
         $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
         $this->db->order_by('DATE(tbl_pemesanan.tanggal) = DATE(NOW())', 'ASC');
         $this->db->order_by('DATE(tbl_pemesanan.tanggal) < DATE(NOW())', 'ASC');
         if($id != null){
            $this->db->where('id_pemesanan', $id);
         }
         $query = $this->db->get();
         return $query;
     }
      

   }