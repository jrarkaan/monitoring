<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formonline_model extends CI_Model
{

    public $table = 'tbl_pemesananonline';
    public $id = 'id_pemesanan';
    public $order = 'DESC';

    public function updateNewMeeting($data){

        $sql = "UPDATE tbl_pemesananonline SET  namaruang = ?, nama_aplikasi = ?, nama_kegiatan = ?, tanggal = ?, mulai = ?, selesai = ? WHERE id_pemesanan = ?";
        
        $query = $this->db->query($sql, [$data["namaruang"], $data["nama_aplikasi"], $data["nama_kegiatan"],  $data["tanggal"], $data["mulai"], $data["selesai"], $data["id_pemesanan"]]);

		return $query;
    }

    public function updateJoinMeeting($data){

        $sql = "UPDATE tbl_pemesananonline SET nama_kegiatan = ?,  namaruang = ?, linkatauid = ?, password = ?, tanggal = ?, mulai = ?, selesai = ? WHERE id_pemesanan = ?";
        
        $query = $this->db->query($sql, [$data["nama_kegiatan"], $data["namaruang"], $data["linkatauid"], $data["password"], $data["tanggal"], $data["mulai"], $data["selesai"], $data["id_pemesanan"]]);

		return $query;
    }

    public function checkData($tanggal, $id_ruang){
        $this->db->select('id_pemesanan, namaruang, nama_kegiatan, selesai, mulai');
        $this->db->from('tbl_pemesananonline');
        $this->db->where('namaruang', $id_ruang);
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('selesai', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    function getDetailNewMeeting($id = null, $kategorimeeting = null){
        $this->db->select('
            tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang, tbl_pemesananonline.nama_kegiatan, 
            tbl_pemesananonline.nama_aplikasi, tbl_pemesananonline.tanggal, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai, tbl_pemesananonline.kategorimeeting,
            tbl_pemesananonline.phone, tbl_pemesananonline.namaruang as nama_ruang, tbl_pemesananonline.status, tbl_pemesananonline.pesan_approve,
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

    function getDetailJoinMeeting($id = null, $kategorimeeting = null){
        $this->db->select('
            tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang, 
            tbl_pemesananonline.phone, tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.linkatauid, tbl_pemesananonline.password,
            tbl_pemesananonline.namaruang as nama_ruang, tbl_pemesananonline.tanggal, tbl_pemesananonline.mulai, tbl_pemesananonline.selesai,
            tbl_pemesananonline.status, tbl_pemesananonline.pesan_approve, tbl_pemesananonline.nama_kegiatan,
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

    public function get_ruang($id = null){
        $this->db->select('*');
        $this->db->from('tbl_ruang');
        if($id != null){
            $this->db->where('id_ruang', $id);
        }
        $query = $this->db->get();
        return $query->result_array();

    }

    public function newmeeting($post){
        $params = [
           "nama_aplikasi" => $post["nama_aplikasi"],
           "nama_kegiatan" => $post["nama_kegiatan"],
           "namaruang" => $post["namaruang"],
           "tanggal" => $post["tanggal"],
           "mulai" => $post["mulai"],
           "selesai" => $post["selesai"],
           "kategorimeeting" => $post["kategorimeeting"],
           "emp_no" => $post["emp_no"],
           "phone" => $post["phone"],
           "nama_user" => $post["nama_user"],
           "status"=> "1",
        ];
        $this->db->insert('tbl_pemesananonline', $params);
    }

    public function joinmeeting($post){
        $params = [
           "password" => $post["password"],
           "linkatauid" => $post["linkatauid"],
           "emp_no" => $post["emp_no"],
           "phone" => $post["phone"],
           "nama_user" => $post["nama_user"],
           "namaruang" => $post["namaruang1"],
           "kategorimeeting" => $post["kategorimeeting"],
           "tanggal" => $post["tanggal"],
           "mulai" => $post["mulai"],
           "selesai" => $post["selesai"],
           "nama_kegiatan" => $post["nama_kegiatan"],
           "nama_aplikasi" => $post["nama_aplikasi"],
           "status"=> "1",
        ];
        $this->db->insert('tbl_pemesananonline', $params);
    }

    public function getInformationUser($id){
        $this->db->select('emp_no, nama_user, phone');
        $this->db->from('user');
        $this->db->where('emp_no', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_data($id = null){
        $this->db->select('
            tbl_pemesananonline.id_pemesanan, tbl_pemesananonline.phone, tbl_pemesananonline.emp_no, tbl_pemesananonline.nama_user, tbl_ruang.namaruang,
            tbl_pemesananonline.kategorimeeting, tbl_pemesananonline.status, tbl_pemesananonline.tanggal
        ');
        $this->db->from('tbl_pemesananonline');
        $this->db->join('tbl_ruang', 'tbl_pemesananonline.namaruang = tbl_ruang.id_ruang');
        if($id != null){
            $this->db->where('emp_no', $id);
        }
        $query = $this->db->get()->result();
        return $query;
    } 

    public function getss()
    {
        $query = "SELECT `tbl_pemesananonline`.*, `tbl_ruang`.`namaruang`
                  FROM `tbl_pemesananonline` JOIN `tbl_ruang`
                  ON `tbl_pemesananonline`.`namaruang` = `tbl_ruang`.`id_ruang`
                ";
        return $this->db->query($query)->result_array();
    }
    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_pemesanan', $q);
        $this->db->or_like('emp_no', $q);
        $this->db->or_like('nama_user', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('namaruang', $q);
        $this->db->or_like('nama_kegiatan', $q);
        $this->db->or_like('nama_aplikasi', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('mulai', $q);
        $this->db->or_like('selesai', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pemesanan', $q);
        $this->db->or_like('emp_no', $q);
        $this->db->or_like('nama_user', $q);
        $this->db->or_like('phone', $q);
        $this->db->or_like('namaruang', $q);
        $this->db->or_like('nama_kegiatan', $q);
        $this->db->or_like('nama_aplikasi', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('mulai', $q);
        $this->db->or_like('selesai', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
