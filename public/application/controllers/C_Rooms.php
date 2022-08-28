<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class C_Rooms extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('M_Rooms');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'c_rooms/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'c_rooms/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'c_rooms/index.html';
            $config['first_url'] = base_url() . 'c_rooms/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Rooms->total_rows($q);
        $c_rooms = $this->M_Rooms->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'c_rooms_data' => $c_rooms,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template/template','c_rooms/tbl_ruang_list', $data);
       
    }

    public function read($id) 
    {
        $row = $this->M_Rooms->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ruang' => $row->id_ruang,
		'namaruang' => $row->namaruang,
		'maxpesertaruang' => $row->maxpesertaruang,
	    );
            $this->template->load('template/template','c_rooms/tbl_ruang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('c_rooms'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('c_rooms/create_action'),
	    'id_ruang' => set_value('id_ruang'),
	    'namaruang' => set_value('namaruang'),
	    'maxpesertaruang' => set_value('maxpesertaruang'),
	);
    $this->template->load('template/template','c_rooms/tbl_ruang_form', $data);

    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'namaruang' => $this->input->post('namaruang',TRUE),
		'maxpesertaruang' => $this->input->post('maxpesertaruang',TRUE),
	    );


            $this->M_Rooms->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('c_rooms'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_Rooms->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('c_rooms/update_action'),
		'id_ruang' => set_value('id_ruang', $row->id_ruang),
		'namaruang' => set_value('namaruang', $row->namaruang),
		'maxpesertaruang' => set_value('maxpesertaruang', $row->maxpesertaruang),
	    );
        
        $this->template->load('template/template','c_rooms/tbl_ruang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('c_rooms'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ruang', TRUE));
        } else {
            $data = array(
		'namaruang' => $this->input->post('namaruang',TRUE),
		'maxpesertaruang' => $this->input->post('maxpesertaruang',TRUE),
	    );

            $this->M_Rooms->update($this->input->post('id_ruang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('c_rooms'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_Rooms->get_by_id($id);

        if ($row) {
            $this->M_Rooms->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('c_rooms'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('c_rooms'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('namaruang', 'namaruang', 'trim|required');
	$this->form_validation->set_rules('maxpesertaruang', 'maxpesertaruang', 'trim|required');

	$this->form_validation->set_rules('id_ruang', 'id_ruang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file C_Rooms.php */
/* Location: ./application/controllers/C_Rooms.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-06-13 16:55:13 */
/* http://harviacode.com */