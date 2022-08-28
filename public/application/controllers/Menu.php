<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model('Menu_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
  
        $data['user'] = $this->db->get_where('user', ['emp_no' => $this->session-> userdata('emp_no')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
    //this->load fungsi di library template-> load view(folder/template.php,isi yang diinginkan)
        $this->template->load('template/template','menu/index',$data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }


    public function submenu()
    {
       
        $data['user'] = $this->db->get_where('user', ['emp_no' => $this->session-> userdata('emp_no')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
    //this->load fungsi di library template-> load view(folder/template.php,isi yang diinginkan)
        $this->template->load('template/template','menu/submenu', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }



     public function hapus($id){
     
        $row = $this->Menu_model->hapusdatamenu($id);

        if($row){
            $this->Menu_model-> hapusdatamenu($id)>0;
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert">Menu Gagal Dihapus!</div>');
           redirect('menu/index');
           
        } else{
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert">Menu Berhasil Dihapus!</div>');
           redirect('menu/index');
            
        }
    }



    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('menu/update_action'),
		'id' => set_value('id', $row->id),
		'menu' => set_value('menu', $row->menu),
	    );
        $this->template->load('template/template','menu/updateM',$data);
        } else {
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert">Record Not Found</div>');
            redirect(site_url('menu/index'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'menu' => $this->input->post('menu',TRUE)
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
