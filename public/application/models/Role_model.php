<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends CI_Model
{

    public $table = 'userole';
    public $id = 'id_userlevel';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function getAllData(){
        $this->db->select('role');
        $this->db->from('userole');
        return $query = $this->db->get();
    }

    public function getDataUserAccess($id){
        $this->db->select("id_userlevel");
        $this->db->from("user_access_menu");
        $this->db->where("id_userlevel", $id);
        return $this->db->get()->result();
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
        $this->db->like('id_userlevel', $q);
	    $this->db->or_like('role', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_userlevel', $q);
	    $this->db->or_like('role', $q);
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

/* End of file Formonffline_model.php */
/* Location: ./application/models/Formonffline_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-10 11:36:02 */
/* http://harviacode.com */