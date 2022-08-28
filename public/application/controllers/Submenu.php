<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model('Submenu_Model');
        $this->load->library('form_validation');
    }

    


    public function hapusd($id){
     
        $row = $this->Submenu_Model->hapusdatamenu($id);

        if($row){
            $this->Submenu_Model-> hapusdatamenu($id)>0;
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert">Menu Gagal Dihapus!</div>');
           redirect('menu/submenu');
           
        } else{
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert">Menu Berhasil Dihapus!</div>');
           redirect('menu/submenu');
            
        }
    }



    public function updatesm($id) 
    {
        $row = $this->Submenu_Model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('menu/update_actions'),
		'id' => set_value('id', $row->id),
		'menu_id' => set_value('menu_id', $row->menu_id),
        'title'=> set_value('title', $row-> title),
        'url'=> set_value('url', $row-> url),
        'icon'=> set_value('icon', $row-> icon),
        'is_active'=> set_value('is_active', $row->is_active),
	    );
        $this->template->load('template/template','menu/updateSM',$data);
        } else {
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert">Record Not Found</div>');
            redirect(site_url('menu/index'));
        }
    }
    
    public function update_actions($id) 
    {
        $this->_rules();
        $data['menu'] = $this->Submenu_Model->get($id);


        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'menu'  => $this->input->post('menu',TRUE),
        'id'    => $this->input->post('id',TRUE),
		'menu_id'=> $this->input->post('menu_id',TRUE),
        'title' => $this->input->post('title',TRUE),
        'url'   => $this->input->post('url',TRUE),
        'icon' => $this->input->post('icon',TRUE),
        'is_active'=> $this->input->post('is_active',TRUE),
	    );

            $this->Menu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert"> Update Record Success </div>');
            redirect(site_url('menu/index'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('menu', 'Menu', 'trim|required');
	
	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
