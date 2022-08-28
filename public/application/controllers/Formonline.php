<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    // header("Content-type: application/json");
class Formonline extends CI_Controller
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
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'formonline/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'formonline/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'formonline/index.html';
            $config['first_url'] = base_url() . 'formonline/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Formonline_model->total_rows($q);
        $id = $this->fungsi->user_login()->emp_no;
        // var_dump($id);
        $formonline = $this->Formonline_model->get_all_data($id);
        
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'formonline_data' => $formonline,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template/template','formonline/tbl_pemesananonline_list', $data);
    }

    public function post_ajax(){
        
        try{
            // to grab all of those
            $data = $this->input->post();

            if($this->input->post('kategorimeeting') === "newmeeting"){

                $check = $this->Formonline_model->checkData($this->input->post('tanggal'), $this->input->post('namaruang'));
                $check1 = $this->Formonffline_model->checkData($this->input->post('tanggal'), $this->input->post('namaruang'));
                // var_dump($last_timeOnDB < $time);
                // var_dump(count($check));
                if(count($check) === 0 && count($check1) === 0){
                    
                    $this->Formonline_model->newmeeting($data);
        
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
                    
                } else if(count($check) === 1 && count($check1) === 0 ){
                    $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                    $last_timeOnDB = date('H:i:s', strtotime($check[0]->selesai));

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->newmeeting($data);
        
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
                   
                }elseif (count($check) === 0 && count($check1) === 1){

                    $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                    $last_timeOnDB = date('H:i:s', strtotime($check1[0]->selesai));

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->newmeeting($data);
        
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

                }elseif (count($check) === 1 && count($check1) === 1){
                    $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                    $last_timeOnDB = date('H:i:s', strtotime($check1[0]->selesai));

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->newmeeting($data);
        
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
                    // var_dump($last_timeOnDB);
                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->newmeeting($data);
        
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

            }else{

                // join meeting
                $check = $this->Formonline_model->checkData($this->input->post('tanggal'), $this->input->post('namaruang1'));
                $check1 = $this->Formonffline_model->checkData($this->input->post('tanggal'), $this->input->post('namaruang1'));
                // var_dump(count($check));
                // var_dump($this->input->post('tanggal'));
                if(count($check) === 0 && count($check1) === 0){
                    
                    $this->Formonline_model->joinmeeting($data);

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
                    
                }elseif(count($check) === 0 && count($check1) === 1){

                    $time = date('H:i:s', strtotime($this->input->post('mulai'))); // mulainya acara
                    $last_timeOnDB = date('H:i:s', strtotime($check1[0]->selesai));

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->joinmeeting($data);
        
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

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->joinmeeting($data);
        
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

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->joinmeeting($data);
        
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

                    if($last_timeOnDB < $time === false){
                        $response = [
                            "pesan" => "Gagal",
                            "msg" => "Jadwal sudah ada yang booking!",
                            "status" => false
                        ];
                        echo json_encode($response);
                    }else{
                        
                        $this->Formonline_model->joinmeeting($data);
        
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

    public function read($id) 
    {
        $row = $this->Formonline_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_pemesanan' => $row->id_pemesanan,
                'emp_no' => $row->emp_no,
                'nama_user' => $row->nama_user,
                'phone' => $row->phone,
                'namaruang' => $row->namaruang,
                'jumlah_peserta' => $row->jumlah_peserta,
                'nama_kegiatan' => $row->nama_kegiatan,
                'aplikasi' => $row->aplikasi,
                'email' => $row->email,
                'password' => $row->password,
                'tanggal' => $row->tanggal,
                'mulai' => $row->mulai,
                'selesai' => $row->selesai,
                'daftar_peserta' => $row->daftar_peserta,
	        );
            $this->template->load('template/template', 'formonline/tbl_pemesananonline_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formonline'));
        }
    }

    public function updateDataBooking(){
        $kategorimeeting = $this->uri->segment(4);
        $id_pemesanan = $this->uri->segment(3);

        if($kategorimeeting === "newmeeting"){

            $data = $this->Formonline_model->getDetailNewMeeting($id_pemesanan, $kategorimeeting);
            $ruang = $this->Formonline_model->get_ruang();

            if($this->db->affected_rows() > 0){

                $response = [
                    "getRuang" => $ruang,
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];

                $this->template->load('template/template','formonline/update_form', $response);
                
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil mendapatkan Data Booking!",
                    "status" => false
                ];
                // echo json_encode($response);
            }

        }else if($kategorimeeting === "joinmeeting"){

            $data = $this->Formonline_model->getDetailJoinMeeting($id_pemesanan, $kategorimeeting);
            $ruang = $this->Formonline_model->get_ruang();

            if($this->db->affected_rows() > 0){

                $response = [
                    "getRuang" => $ruang,
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];
                
                $this->template->load('template/template','formonline/update_form', $response);

            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil mendapatkan Data Booking!",
                    "status" => false
                ];
                // echo json_encode($response);
            }

        }
        
        
    }

    public function delete_ajax(){
        $id = $this->input->post("id_pemesanan");

        $this->Formonline_model->delete($id);

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

    public function update_ajax(){
        try{
            // to grab all of those
            $data = $this->input->post();
            // var_dump($data);
            if($this->input->post('kategorimeeting') === "newmeeting"){

                $this->Formonline_model->updateNewMeeting($data);

                if($this->db->affected_rows() > 0){
                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Berhasil memperbarui Data Booking!",
                        "status" => true
                    ];
                    echo json_encode($response);
                }else{
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Tidak berhasil memperbarui Data Booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }

            }else{

                $this->Formonline_model->updateJoinMeeting($data);

                // var_dump($data1);

                if($this->db->affected_rows() > 0){
                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Berhasil memperbarui Data Booking!",
                        "status" => true
                    ];
                    echo json_encode($response);
                }else{
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Tidak berhasil memperbarui Data Booking!",
                        "status" => false
                    ];
                    echo json_encode($response);
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

    public function getDetailKategoriMeeting(){
        $kategorimeeting = $this->input->post('kategorimeeting');
        $id_pemesanan = $this->input->post('id');
        // var_dump($id_pemesanan);
        if($kategorimeeting === "newmeeting"){

            $data = $this->Formonline_model->getDetailNewMeeting($id_pemesanan, $kategorimeeting);

            if($this->db->affected_rows() > 0){
                $response = [
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];
                echo json_encode($response);
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil mendapatkan Data Booking!",
                    "status" => false
                ];
                echo json_encode($response);
            }

        }else if($kategorimeeting === "joinmeeting"){

            $data = $this->Formonline_model->getDetailJoinMeeting($id_pemesanan, $kategorimeeting);

            if($this->db->affected_rows() > 0){
                $response = [
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];
                echo json_encode($response);
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil mendapatkan Data Booking!",
                    "status" => false
                ];
                echo json_encode($response);
            }

        }

    }

    public function create() 
    {
        
        $data['getss'] = $this->db->get('tbl_ruang')->result_array();
        // echo var_dump($data['room']);die;
        $informationUser = $this->Formonline_model->getInformationUser($this->fungsi->user_login()->emp_no);
        $getRuang = $this->Formonline_model->get_ruang();

        $data = array(
            'getRuang' => $getRuang,
            'informationUser' => $informationUser,
            'button' => 'Create',
            'action' => site_url('formonline/create_action'),
            'id_pemesanan' => set_value('id_pemesanan'),
            'emp_no' => set_value('emp_no'),
            'nama_user' => set_value('nama_user'),
            'phone' => set_value('phone'),
            'namaruang' => set_value('namaruang'),
            'jumlah_peserta' => set_value('jumlah_peserta'),
            'nama_kegiatan' => set_value('nama_kegiatan'),
            'aplikasi' => set_value('aplikasi'),
            'email' => set_value('email'),
            'password' => set_value('password'),
            'tanggal' => set_value('tanggal'),
            'mulai' => set_value('mulai'),
            'selesai' => set_value('selesai'),
            'daftar_peserta' => set_value('daftar_peserta'),
	    );
        $this->template->load('template/template', 'formonline/tbl_pemesananonline_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
    
		'emp_no' => $this->input->post('emp_no',TRUE),
		'nama_user' => $this->input->post('nama_user',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'namaruang' => $this->input->post('namaruang',TRUE),
		'jumlah_peserta' => $this->input->post('jumlah_peserta',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'aplikasi' => $this->input->post('aplikasi',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' => $this->input->post('password',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
		'selesai' => $this->input->post('selesai',TRUE),
		'daftar_peserta' => $this->input->post('daftar_peserta',TRUE),
	    );

            $this->Formonline_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('formonline'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Formonline_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('formonline/update_action'),
		'id_pemesanan' => set_value('id_pemesanan', $row->id_pemesanan),
		'emp_no' => set_value('emp_no', $row->emp_no),
		'nama_user' => set_value('nama_user', $row->nama_user),
		'phone' => set_value('phone', $row->phone),
		'namaruang' => set_value('namaruang', $row->namaruang),
		'jumlah_peserta' => set_value('jumlah_peserta', $row->jumlah_peserta),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'aplikasi' => set_value('aplikasi', $row->aplikasi),
		'email' => set_value('email', $row->email),
		'password' => set_value('password', $row->password),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'mulai' => set_value('mulai', $row->mulai),
		'selesai' => set_value('selesai', $row->selesai),
		'daftar_peserta' => set_value('daftar_peserta', $row->daftar_peserta),
	    );
            $this->template->load('template/template', 'formonline/tbl_pemesananonline_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formonline'));
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
		'aplikasi' => $this->input->post('aplikasi',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' => $this->input->post('password',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
		'mulai' => $this->input->post('mulai',TRUE),
		'selesai' => $this->input->post('selesai',TRUE),
		'daftar_peserta' => $this->input->post('daftar_peserta',TRUE),
	    );

            $this->Formonline_model->update($this->input->post('id_pemesanan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('formonline'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Formonline_model->get_by_id($id);

        if ($row) {
            $this->Formonline_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('formonline'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('formonline'));
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
	$this->form_validation->set_rules('aplikasi', 'aplikasi', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('mulai', 'mulai', 'trim|required');
	$this->form_validation->set_rules('selesai', 'selesai', 'trim|required');
	$this->form_validation->set_rules('daftar_peserta', 'daftar peserta', 'trim|required');

	$this->form_validation->set_rules('id_pemesanan', 'id_pemesanan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pemesananonline.xls";
        $judul = "tbl_pemesananonline";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Emp No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama User");
	xlsWriteLabel($tablehead, $kolomhead++, "Phone");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ruang");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Peserta");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Aplikasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Mulai");
	xlsWriteLabel($tablehead, $kolomhead++, "Selesai");
	xlsWriteLabel($tablehead, $kolomhead++, "Daftar Peserta");

	foreach ($this->Formonline_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->emp_no);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->phone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->namaruang);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_peserta);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->aplikasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->mulai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->selesai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->daftar_peserta);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pemesananonline.doc");

        $data = array(
            'tbl_pemesananonline_data' => $this->Formonline_model->get_all(),
            'start' => 0
        );
        
        $this->template->load('template/template', 'formonline/tbl_pemesananonline_doc',$data);
    }

}

/* End of file Formonline.php */
/* Location: ./application/controllers/Formonline.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-25 17:54:54 */
/* http://harviacode.com */