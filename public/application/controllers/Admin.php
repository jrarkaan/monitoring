<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model('Admin_model');
    }

    public function index(){
        
        $user = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
        $i = 0;
        // to get spesific user login to system
        $id = $this->fungsi->user_login()->id_userlevel;
        if($id === "1"){
            $status = 1;

            $booking_list = $this->Admin_model->getDataBooking($status)->result_array();
            $listOfBooking = $this->Admin_model->getDataBookingOnline($status, "newmeeting");
            $listOfBooking1 = $this->Admin_model->getDataBookingOnline($status, "joinmeeting");
        }
    
        $data["user"] = $user;
        $data["booking_list"] = $booking_list;
        $data["listOfBooking"] = $listOfBooking;
        $data["listOfBooking1"] = $listOfBooking1;
        $data["i"] = $i;
        $this->template->load('template/template','admin/dashboardadm', $data);
     
    }

    public function update_status(){
        try{
    
            $kategorimeeting = $this->input->post('kategorimeeting');
    
            if($kategorimeeting === "newmeeting"){

                $status = $this->input->post("status");

                if($status === "2"){ // ditolak

                    $simpan = [
                        "status" => $status,
                        "pesan_approve" => $this->input->post("pesan_approve"),
                        "id_pemesanan" => $this->input->post("id_pemesanan"),
                        "linkatauid" => null,
                        "password" => null,
                    ];

                    $this->Admin_model->updateNewMeeting($simpan);

                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Berhasil Menolak Data Booking Online!",
                        "status" => true
                    ];
                    
                    echo json_encode($response);
        

                }else if($status === "3"){

                    $simpan = [
                        "status" => $status,
                        "pesan_approve" => $this->input->post("pesan_approve"),
                        "id_pemesanan" => $this->input->post("id_pemesanan"),
                        "linkatauid" => $this->input->post("linkatauid"),
                        "password" => $this->input->post("password"),
                    ];

                    $this->Admin_model->updateNewMeeting($simpan);

                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Berhasil Memperbarui Data Booking Online!",
                        "status" => true
                    ];
                    
                    echo json_encode($response);

                }

            }else if($kategorimeeting === "joinmeeting"){

                $simpan = [
                    "status" => $this->input->post('status'),
                    "pesan_approve" => $this->input->post("pesan_approve"),
                    "id_pemesanan" => $this->input->post("id_pemesanan"),
                    "linkatauid" => null,
                    "password" => null,
                ];

                $this->Admin_model->updateNewMeeting($simpan);

                $response = [
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Memperbarui Data Booking Online!",
                    "status" => true
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
    
    public function detail(){
        $kategorimeeting = $this->uri->segment(4);
        $id_pemesanan = $this->uri->segment(3);

        if($kategorimeeting === "newmeeting"){

            $data = $this->Admin_model->getDetailNewMeeting($id_pemesanan, $kategorimeeting);
            $ruang = $this->Admin_model->get_ruang();

            if($this->db->affected_rows() > 0){

                $response = [
                    "getRuang" => $ruang,
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];

                $this->template->load('template/template','admin/approve', $response);
                
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Tidak berhasil mendapatkan Data Booking!",
                    "status" => false
                ];
                // echo json_encode($response);
            }

        }else if($kategorimeeting === "joinmeeting"){

            $data = $this->Admin_model->getDetailJoinMeeting($id_pemesanan, $kategorimeeting);
            $ruang = $this->Admin_model->get_ruang();

            if($this->db->affected_rows() > 0){

                $response = [
                    "getRuang" => $ruang,
                    "data" => $data,
                    "pesan" => "Sukses",
                    "msg" => "Berhasil Mendapatkan Data Booking!",
                    "status" => true
                ];
                
                $this->template->load('template/template','admin/approve', $response);

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

    public function updatestatusbook(){
        try{
            $id_pemesanan = $this->input->post('id_pemesanan');
            $status = $this->input->post('status');
            $pesan_approve = $this->input->post('pesan_approve');

            if($id_pemesanan){

                $this->Admin_model->updatebookingstatus($status, $id_pemesanan, $pesan_approve);

                if($this->db->affected_rows() > 0){
                    $data = [
                        "msg" => "Booking berhasil dikonfirmasi!", 
                        "pesan" => "Sukses",
                        "status" => true
                    ];
                    echo json_encode($data);
                }else{
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Terjadi kesalahan ketika update! Silahkan Hubungi TIM IT!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }
                
            }else{

                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Gagal! Silahkan Hubungi TIM IT!",
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

    public function role(){
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
        $data['role'] = $this->db->get('userole')->result_array();
    
        $this->template->load('template/template','admin/role', $data);
    }


    public function roleAccess($id_userlevel){
        $data['title'] = 'Management Role Access';
        $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
        $data['role'] = $this->db->get_where('userole', ['id_userlevel' => $id_userlevel])->row_array();
    
        $this->db->where('id!=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
    
        $this->template->load('template/template','admin/role-access', $data);
    }
    
    
    public function changeAccess(){
        $menu_id = $this->input->post('menuId');
        $id_userlevel = $this->input->post('roleId');
    
        $data = [
            'id_userlevel' => $id_userlevel,
            'menu_id' => $menu_id
        ];
    
        $result = $this->db->get_where('user_access_menu', $data);
    
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        }else{
            $this->db->delete('user_access_menu', $data);
        }
    
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
}
    
