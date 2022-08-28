<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ruang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Ruang_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'ruang/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'ruang/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'ruang/index.html';
            $config['first_url'] = base_url() . 'ruang/index.html';
        }

        $config['per_page'] = 30;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Ruang_model->total_rows($q);
        $ruang = $this->Ruang_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'ruang_data' => $ruang,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template/template','ruang/tbl_ruang_list', $data);
        
    }

    public function read($id) 
    {
        $row = $this->Ruang_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_ruang' => $row->id_ruang,
		'kode_ruang' => $row->kode_ruang,
		'namaruang' => $row->namaruang,
		'maxpesertaruang' => $row->maxpesertaruang,
	    );
        $this->template->load('template/template','ruang/tbl_ruang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('ruang/create_action'),
	    'id_ruang' => set_value('id_ruang'),
	    'kode_ruang' => set_value('kode_ruang'),
	    'namaruang' => set_value('namaruang'),
	    'maxpesertaruang' => set_value('maxpesertaruang'),
	);
    $this->template->load('template/template','ruang/tbl_ruang_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_ruang' => $this->input->post('kode_ruang',TRUE),
		'namaruang' => $this->input->post('namaruang',TRUE),
		'maxpesertaruang' => $this->input->post('maxpesertaruang',TRUE),
	    );

            $this->Ruang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('ruang'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Ruang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('ruang/update_action'),
		'id_ruang' => set_value('id_ruang', $row->id_ruang),
		'kode_ruang' => set_value('kode_ruang', $row->kode_ruang),
		'namaruang' => set_value('namaruang', $row->namaruang),
		'maxpesertaruang' => set_value('maxpesertaruang', $row->maxpesertaruang),
	    );
        $this->template->load('template/template','ruang/tbl_ruang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_ruang', TRUE));
        } else {
            $data = array(
		'kode_ruang' => $this->input->post('kode_ruang',TRUE),
		'namaruang' => $this->input->post('namaruang',TRUE),
		'maxpesertaruang' => $this->input->post('maxpesertaruang',TRUE),
	    );

            $this->Ruang_model->update($this->input->post('id_ruang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('ruang'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Ruang_model->get_by_id($id);

        if ($row) {
            $this->Ruang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ruang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ruang'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_ruang', 'kode ruang', 'trim|required');
	$this->form_validation->set_rules('namaruang', 'namaruang', 'trim|required');
	$this->form_validation->set_rules('maxpesertaruang', 'maxpesertaruang', 'trim|required');

	$this->form_validation->set_rules('id_ruang', 'id_ruang', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Ruang.php */
/* Location: ./application/controllers/Ruang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-30 10:04:51 */
/* http://harviacode.com */