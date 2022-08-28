<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formonffline extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Formonline_model', 'Formonffline_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        // to get spesific user login to system
        $id = $this->fungsi->user_login()->emp_no;
    
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'formonffline/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'formonffline/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'formonffline/index.html';
            $config['first_url'] = base_url() . 'formonffline/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Formonffline_model->total_rows($q);
        $formonffline = $this->Formonffline_model->get_limit_data($config['per_page'], $start, $q);
        $formofflinedata = $this->Formonffline_model->get_all_data($id);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'formonffline_data_new' => $formofflinedata,
            'formonffline_data' => $formonffline,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
       
        $this->template->load('template/template','formonffline/tbl_pemesanan_list', $data);
    }

    public function getRuang(){

        $data["ruang"] = $this->Formonffline_model->get_ruang();

        echo json_encode($data);
    }

    public function delete_ajax(){
        $id = $this->input->post("id");

        $this->Formonffline_model->delete($id);

        if($this->db->affected_rows() > 0){
            $data = [
                "msg" => "Data Booking berhasil dihapus!",
                "status" => true,
                "pesan" => "Sukses"
            ];

            echo json_encode($data);
        }else{
            
            $data = [
                "msg" => "Data Booking tidak berhasil dihapus!",
                "status" => false,
                "pesan" => "Gagal"
            ];
    
            echo json_encode($data);
        }

    }

    public function read($id) 
    {
        $row = $this->Formonffline_model->get_by_id($id);
        if ($row) {
            $data = array(
                'room' => $this->Formonffline_model->get_ruang(),
                'id_pemesanan' => $row->id_pemesanan,
                'emp_no' => $row->emp_no,
                'nama_user' => $row->nama_user,
                'phone' => $row->phone,
                'namaruang' => $row->namaruang,
                'jumlah_peserta' => $row->jumlah_peserta,
                'nama_kegiatan' => $row->nama_kegiatan,
                'tanggal' => $row->tanggal,
                'mulai' => $row->mulai,
                'selesai' => $row->selesai,
                'pesan' => $row->pesan,
                'pesan_approve' => $row->pesan_approve
	        );
            $this->template->load('template/template','formonffline/tbl_pemesanan_read', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Record Not Found </div>');
            redirect(site_url('formonffline'));
        }
    }

    public function create() 
    {
        $informationUser = $this->Formonffline_model->getInformationUser($this->fungsi->user_login()->emp_no);

        $data = array(
            'informationUser' => $informationUser,
            'room' => $this->Formonffline_model->get_ruang(),
            'button' => 'Create',
            'action' => site_url('formonffline/create_action'),
            'id_pemesanan' => set_value('id_pemesanan'),
            'emp_no' => set_value('emp_no'),
            'nama_user' => set_value('nama_user'),
            'phone' => set_value('phone'),
            'namaruang' => set_value('namaruang'),
            'jumlah_peserta' => set_value('jumlah_peserta'),
            'nama_kegiatan' => set_value('nama_kegiatan'),
            'tanggal' => set_value('tanggal'),
            'mulai' => set_value('mulai'),
            'selesai' => set_value('selesai'),
            'pesan' => set_value('pesan'),
	    );

        $this->template->load('template/template','formonffline/tbl_pemesanan_form', $data);
    }
    
    public function create_action() {

        try{
            $data = $this->input->post();

            $check = $this->Formonffline_model->checkData($this->input->post('tanggal'), $this->input->post('id_ruang'));
            $check1 = $this->Formonline_model->checkData($this->input->post('tanggal'), $this->input->post('id_ruang'));
            // var_dump($check);
            if(count($check) === 0 && count($check1) === 0){

                $this->Formonffline_model->addNewData($data);
    
                if($this->db->affected_rows() > 0){
                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Berhasil menambahkan Data Booking!",
                        "status" => true
                    ];
                    echo json_encode($response);
                }else{
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Tidak berhasil menambahkan Data Booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }

            }else if(count($check) === 0 && count($check1) === 1){

                $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                $last_timeOnDB = date('H:i:s', strtotime($check1[0]->selesai));
                // var_dump($last_timeOnDB < $time);
    
                if($last_timeOnDB < $time === false){
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Jadwal sudah ada yang booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }else{
    
                    $this->Formonffline_model->addNewData($data);
        
                    if($this->db->affected_rows() > 0){
                        $response = [
                            "pesan" => "Sukses",
                            "msg" => "Berhasil menambahkan Data Booking!",
                            "status" => true
                        ];
                        echo json_encode($response);
                    }else{
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Tidak berhasil menambahkan Data Booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }
                
                }

            }else if(count($check) === 1 && count($check1) === 0){

                $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                $last_timeOnDB = date('H:i:s', strtotime($check[0]->selesai));
                // var_dump($last_timeOnDB < $time);
    
                if($last_timeOnDB < $time === false){
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Jadwal sudah ada yang booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }else{
    
                    $this->Formonffline_model->addNewData($data);
        
                    if($this->db->affected_rows() > 0){
                        $response = [
                            "pesan" => "Sukses",
                            "msg" => "Berhasil menambahkan Data Booking!",
                            "status" => true
                        ];
                        echo json_encode($response);
                    }else{
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Tidak berhasil menambahkan Data Booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }
                
                }

            }else if(count($check) === 1 && count($check1) === 1){
                $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                $last_timeOnDB = date('H:i:s', strtotime($check[0]->selesai));
                // var_dump($last_timeOnDB < $time);
    
                if($last_timeOnDB < $time === false){
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Jadwal sudah ada yang booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }else{
    
                    $this->Formonffline_model->addNewData($data);
        
                    if($this->db->affected_rows() > 0){
                        $response = [
                            "pesan" => "Sukses",
                            "msg" => "Berhasil menambahkan Data Booking!",
                            "status" => true
                        ];
                        echo json_encode($response);
                    }else{
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Tidak berhasil menambahkan Data Booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }
                
                }
            }else{

                $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                $last_timeOnDB = date('H:i:s', strtotime($check[0]->selesai));
                // var_dump($last_timeOnDB < $time);
    
                if($last_timeOnDB < $time === false){
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Jadwal sudah ada yang booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }else{
    
                    $this->Formonffline_model->addNewData($data);
        
                    if($this->db->affected_rows() > 0){
                        $response = [
                            "pesan" => "Sukses",
                            "msg" => "Berhasil menambahkan Data Booking!",
                            "status" => true
                        ];
                        echo json_encode($response);
                    }else{
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Tidak berhasil menambahkan Data Booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }
                
                }

            }

        }catch(Exception $ex){
            $response = [
                "pesan" => "Gagal",
                "msg" => $ex,
                "status" => false
            ];
            echo json_encode($response);
        }
        
    }

    public function update_ajax(){
        
        try{
            $data = $this->input->post();
            
            $this->Formonffline_model->updateDataBooking($data);

            if($this->db->affected_rows() > 0){
                $response = [
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Memperbarui Data Booking!",
                    "status" => true
                ];
                echo json_encode($response);
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil Memperbarui Data Booking!",
                    "status" => false
                ];
                echo json_encode($response);
            }
        }catch(Exception $ex){
            $response = [
                "pesan" => "Gagal",
                "msg" => $ex,
                "status" => false
            ];
            echo json_encode($response);
        }
    }
    
    public function update($id) 
    {
        $row = $this->Formonffline_model->get_by_id($id);

        if ($row) {
            $data = array(
                'room' => $this->Formonffline_model->get_ruang(),
                'button' => 'Update',
                'action' => site_url('formonffline/update_action'),
                'id_pemesanan' => set_value('id_pemesanan', $row->id_pemesanan),
                'emp_no' => set_value('emp_no', $row->emp_no),
                'nama_user' => set_value('nama_user', $row->nama_user),
                'phone' => set_value('phone', $row->phone),
                'namaruang' => set_value('namaruang', $row->namaruang),
                'jumlah_peserta' => set_value('jumlah_peserta', $row->jumlah_peserta),
                'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'mulai' => set_value('mulai', $row->mulai),
                'selesai' => set_value('selesai', $row->selesai),
                'pesan' => set_value('pesan', $row->pesan),
	        );
            $this->template->load('template/template','formonffline/tbl_pemesanan_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Record Not Found</div>'); 
            redirect(site_url('formonffline'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pemesanan', TRUE));
        } else {
            $data = array(
		'emp_no' => $this->input->post('emp_no',TRUE),
		'nama_user' => $this->input->post('nama_user',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'namaruang' => $this->input->post('namaruang',TRUE),
		'jumlah_peserta' => $this->input->post('jumlah_peserta',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
		'selesai' => $this->input->post('selesai',TRUE),
		'pesan' => $this->input->post('pesan',TRUE),
	    );

            $this->Formonffline_model->update($this->input->post('id_pemesanan', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Update Record Success </div>');
            redirect(site_url('formonffline'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Formonffline_model->get_by_id($id);

        if ($row) {
            $this->Formonffline_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
            Delete Record Success </div>');
            redirect(site_url('formonffline'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
            Record Not Found </div>');
            redirect(site_url('formonffline'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('emp_no', 'emp no', 'trim|required');
	$this->form_validation->set_rules('nama_user', 'nama user', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('namaruang', 'nama ruang', 'trim|required');
	$this->form_validation->set_rules('jumlah_peserta', 'jumlah peserta', 'trim|required');
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
	$this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
	$this->form_validation->set_rules('pesan', 'pesan', 'trim|required');

	$this->form_validation->set_rules('id_pemesanan', 'id_pemesanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Formonffline.php */
/* Location: ./application/controllers/Formonffline.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-10 11:36:02 */
/* http://harviacode.com */