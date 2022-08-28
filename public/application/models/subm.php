<?php defined('BASEPATH') OR exit('No direct script access allowed');

class subm extends CI_Model
{
    public $table = 'user_sub_menu';
    public $id = 'id';
    public $order = 'DESC';
    private $_table = "user_sub_menu";

    public function getsub($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function update($id)
    {
        $data = [
            'menu_id' => $this->input->post('menu_id', true),
            'title' => $this->input->post('title', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => 1
        ];

        // echo var_dump($data);exit;
    
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

  

    public function get($id)
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                  WHERE id=$id
                ";
        return $this->db->query($query)->row_array();
    }

    public function hapusdatamenu($id){
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    
}