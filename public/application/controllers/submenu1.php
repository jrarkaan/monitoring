<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class submenu1 extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model("subm");
        $this->load->library('form_validation');
    }

    public function editsm($id)
    {
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        
        if ($this->form_validation->run() == false) 
        {
            $data['getsubmenu'] = $this->subm->getsub($id);
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $this->template->load('template/template','menu/updateSM',$data);
        }
        else 
        {

            $this->subm->update($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Submenu Changed Successfully !</div>');
            redirect('menu/submenu');
        }
    }

    public function hapusd($id){
     
        $row = $this->subm->hapusdatamenu($id);

        if($row){
            $this->subm-> hapusdatamenu($id)>0;
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert">Submenu Failed to Delete !</div>');
           redirect('menu/submenu');
           
        } else{
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert"> Submenu Successfully Deleted !</div>');
           redirect('menu/submenu');
            
        }
    }
}