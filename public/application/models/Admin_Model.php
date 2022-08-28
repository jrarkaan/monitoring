<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

   public function updateNewMeeting($data){

      $sql = "UPDATE tbl_pemesananonline SET  status = ?, linkatauid = ?, password = ?, pesan_approve = ? WHERE id_pemesanan = ?";
      
      $query = $this->db->query($sql, [ $data["status"], $data["linkatauid"], $data["password"], $data["pesan_approve"], $data["id_pemesanan"] ]);

      return $query;
   }

  public function updateJoinMeeting($data){

      $sql = "UPDATE tbl_pemesananonline SET  namaruang = ?, linkatauid = ?, password = ?, tanggal = ?, mulai = ?, selesai = ? WHERE id_pemesanan = ?";
      
      $query = $this->db->query($sql, [$data["namaruang"], $data["linkatauid"], $data["password"], $data["tanggal"], $data["mulai"], $data["selesai"], $data["id_pemesanan"]]);

    return $query;
  }

   public function get_ruang($id = null){
      $this->db->select('*');
      $this->db->from('tbl_ruang');
      if($id != null){
          $this->db->where('id_ruang', $id);
      }
      $query = $this->db->get();
      return $query->result_array();

   }
   // untuk proses kalkulasi di dashboard
   public function getDataBooking1($status = null){
      $this->db->select('
         a.id_pemesanan, a.emp_no, a.status, a.nama_user, b.namaruang, a.tanggal, a.jumlah_peserta, 
         a.nama_kegiatan, a.mulai, a.selesai, a.pesan, a.pesan_approve
      ');
      $this->db->from('tbl_pemesanan a');
      $this->db->join('tbl_ruang b', 'a.namaruang = b.id_ruang');
      if($status != null){
         $this->db->where('a.status', $status);
      }

      $query = $this->db->get()->num_rows();
      return $query;
   }
   // untuk proses kalkulasi di dashboard
   public function getDataBookingOnline1($status = null){
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, 
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($status != null){
          $this->db->where('status', $status);
      }
      $query = $this->db->get()->num_rows();
      return $query;
   }

   public function getDataBooking($status = null){
      $this->db->select('
         a.id_pemesanan, a.emp_no, a.status, a.nama_user, b.namaruang, a.tanggal, a.jumlah_peserta, 
         a.nama_kegiatan, a.mulai, a.selesai, a.pesan, a.pesan_approve, STR_TO_DATE(a.tanggal, "%d-%m-%Y") as day
      ');
      $this->db->from('tbl_pemesanan a');
      $this->db->join('tbl_ruang b', 'a.namaruang = b.id_ruang');
      if($status != null){
         $this->db->where('a.status', $status);
      }
      $this->db->order_by('day', 'asc');
      $query = $this->db->get();
      return $query;
   }

   public function getDataBookingOnline($status = null, $kategorimeeting = null){
      $this->db->select('
         tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,  
         tbl_pemesananonline.tanggal, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, tbl_pemesananonline.nama_aplikasi,
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($status != null){
          $this->db->where('status', $status);
      }
      if($kategorimeeting != null){
         $this->db->where('kategorimeeting', $kategorimeeting);
      }
      $this->db->order_by('DATE(tbl_pemesananonline.tanggal) = DATE(NOW())', 'ASC');
      $this->db->order_by('DATE(tbl_pemesananonline.tanggal) < DATE(NOW())', 'ASC');
      $this->db->order_by('DATE(tbl_pemesananonline.tanggal) > DATE(NOW())', 'DESC');
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
      $this->db->order_by('DATE(tbl_pemesananonline.tanggal) = DATE(NOW())', 'ASC');
      $this->db->order_by('DATE(tbl_pemesananonline.tanggal) < DATE(NOW())', 'ASC');
      $query = $this->db->get()->result();
      return $query;
  }

  function getDetailJoinMeeting($id = null, $kategorimeeting = null){
      $this->db->select('
          tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang, 
          tbl_pemesananonline.phone, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.linkatauid, tbl_pemesananonline.password,
          tbl_pemesananonline.namaruang as nama_ruang, tbl_pemesananonline.tanggal, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai,
          tbl_pemesananonline.status, tbl_pemesananonline.pesan_approve, tbl_pemesananonline.nama_kegiatan,  tbl_pemesananonline.nama_aplikasi,
      ');
      $this->db->from('tbl_pemesananonline');
      $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
      if($id != null && $kategorimeeting != null){
         $this->db->where('id_pemesanan', $id);
         $this->db->where('kategorimeeting', $kategorimeeting);
      }
      $query = $this->db->get()->result();
      return $query;
  }

   public function updatebookingstatus($status, $id_pemesanan, $pesan_approve){
      $sql = 'UPDATE tbl_pemesanan SET status = ?, pesan_approve = ? WHERE id_pemesanan = ?';

      $query = $this->db->query($sql, [$status, $pesan_approve, $id_pemesanan]);

      return $query;
   }

}