<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model('Role_model');
        $this->load->library('form_validation');
    }

    public function delete_ajax(){
        $id = $this->input->post('id_role');

        $check = $this->Role_model->getDataUserAccess($id);

        if(count($check) > 0){
            $response = [
                "indctr" => 0,
                "msg" => "Data tidak dapat dihapus!"
            ];

            echo json_encode($response);
        }else{

            $this->Role_model->delete($id);

            if($this->db->affected_rows() > 0){
                $response = [
                    "indctr" => 1,
                    "msg" => "Data Berhasil dihapus!"
                ];
    
                echo json_encode($response);
            }else{
                $response = [
                    "indctr" => 0,
                    "msg" => "Terjadi masalah ketika menghapus"
                ];
    
                echo json_encode($response);
            }

        }

    }

    public function add_ajax(){
        $nama = $this->input->post('role');

        $nama_role= $this->Role_model->getAllData()->row();

        $check = 0;
        foreach($nama_role as $value){
            if(strtolower($nama) == strtolower($value)){
                $check = 1;
            }
        }
        // var_dump($check);
        
        if($check === 1){
            $response = [
                "indctr" => 0,
                "msg" => "Data sudah ada di dalam Database"
            ];

            echo json_encode($response);
        }else{

            $this->Role_model->insert(["role" => $nama]);
            $response = [
                "indctr" => 1,
                "msg" => "Data Berhasil ditambahkan!"
            ];

            echo json_encode($response);

        }

    }

    public function update_ajax(){
        $nama = $this->input->post('nama');
        $id = $this->input->post('id');

        $this->Role_model->update($id, ["role" => $nama]);

        if($this->db->affected_rows() > 0){
            $response = [
                "indctr" => 1,
                "msg" => "Data Berhasil diupdate!"
            ];

            echo json_encode($response);
        }else{
            $response = [
                "indctr" => 0,
                "msg" => "Terjadi masalah ketika diupdate"
            ];

            echo json_encode($response);
        }
    }
        
    public function index()
    {
  
        $data['user'] = $this->db->get_where('user', ['emp_no' => $this->session-> userdata('emp_no')])->row_array();
        $data['role'] = $this->db->get('userole')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
    //this->load fungsi di library template-> load view(folder/template.php,isi yang diinginkan)
        $this->template->load('template/template','admin/role',$data);
        // $this->template->load('template/template','menu/role',$data);
        } else {
            $this->db->insert('userole', ['menu' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('role');
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
