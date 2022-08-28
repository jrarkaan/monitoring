<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formonffline_model extends CI_Model
{

    public $table = 'tbl_pemesanan';
    public $id = 'id_pemesanan';
    public $order = 'DESC';

    function __construct() {
        parent::__construct();
    }

    public function checkData($tanggal, $id_ruang){
        $this->db->select('id_pemesanan, namaruang, nama_kegiatan, selesai, mulai');
        $this->db->from('tbl_pemesanan');
        $this->db->where('namaruang', $id_ruang);
        $this->db->where('tanggal', $tanggal);
        $this->db->order_by('selesai', 'DESC');
        $query = $this->db->get()->result();
        return $query;
    }

    public function getInformationUser($id){
        $this->db->select('emp_no, nama_user, phone');
        $this->db->from('user');
        $this->db->where('emp_no', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addNewData($post){
        $params = [
            "pesan" => $post["pesan"],
            "emp_no" => $post["emp_no"],
            "nama_user" => $post["nama_user"],
            "phone" => $post["phone"],
            "namaruang" => $post["id_ruang"],
            "jumlah_peserta" => $post["jumlah_peserta"],
            "nama_kegiatan" => $post["nama_kegiatan"],
            "tanggal" => $post["tanggal"],
            "mulai" => $post["mulai"],
            "selesai" => $post["selesai"],
            "status" => 1
        ];
        $this->db->insert('tbl_pemesanan', $params);
    }

    public function updateDataBooking($data){

        $sql = "UPDATE tbl_pemesanan SET  namaruang = ?, jumlah_peserta = ?, nama_kegiatan = ?, mulai = ?, selesai = ?, pesan = ? WHERE id_pemesanan = ?";
        
        $query = $this->db->query($sql, [$data["nama_ruang"], $data["jumlah_peserta"], $data["nama_kegiatan"], $data["mulai"], $data["selesai"], $data["pesan"], $data["id_pemesanan"]]);

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

    public function getss(){
        $query = "SELECT `tbl_pemesanan`.*, `tbl_ruang`.`namaruang`
                  FROM `tbl_pemesanan` JOIN `tbl_ruang`
                  ON `tbl_pemesanan`.`namaruang` = `tbl_ruang`.`id_ruang`
                ";
        return $this->db->query($query)->result_array();
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
	    $this->db->or_like('jumlah_peserta', $q);
	    $this->db->or_like('nama_kegiatan', $q);
	    $this->db->or_like('tanggal', $q);
	    $this->db->or_like('mulai', $q);
	    $this->db->or_like('selesai', $q);
	    $this->db->or_like('pesan', $q);
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
        $this->db->or_like('jumlah_peserta', $q);
        $this->db->or_like('nama_kegiatan', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('mulai', $q);
        $this->db->or_like('selesai', $q);
        $this->db->or_like('pesan', $q);
        $this->db->limit($limit, $start);

        return $this->db->get($this->table)->result();
    }

    function get_all_data($id = null){
        $this->db->select('tbl_pemesanan.id_pemesanan, tbl_pemesanan.emp_no, tbl_pemesanan.nama_user, tbl_ruang.namaruang, tbl_pemesanan.nama_kegiatan, 
            tbl_pemesanan.namaruang as id_ruang, tbl_pemesanan.tanggal, tbl_pemesanan.mulai, tbl_pemesanan.selesai, tbl_pemesanan.status, 
            tbl_pemesanan.jumlah_peserta, tbl_pemesanan.pesan, tbl_pemesanan.pesan_approve
        ');
        $this->db->from('tbl_pemesanan');
        $this->db->join('tbl_ruang', 'tbl_pemesanan.namaruang = tbl_ruang.id_ruang');
        if($id != null){
            $this->db->where('tbl_pemesanan.emp_no', $id);
        }
        // $this->db->order_by("day", 'ASC');
        $query = $this->db->get()->result();
        return $query;
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

/* End of file Formonffline_model.php */
/* Location: ./application/models/Formonffline_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-10 11:36:02 */
/* http://harviacode.com */