<?php
defined('BASEPATH') or exit('No direct script access allowed');
Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

class ReportOnline extends CI_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        check_admin();
        check_not_login();
        $this->load->model(['ReportOnline_M', 'Admin_model']);
    }

    public function index(){

       $getDataOnline = $this->ReportOnline_M->getDataBookingOnline('newmeeting');
       $getDataOnline1 = $this->ReportOnline_M->getDataBookingOnline1('joinmeeting');

       $data = [
          "test"=> "tamvan",
          "getDataOnline" => $getDataOnline,
          "getDataOnline1" => $getDataOnline1
       ];
       
       $this->template->load('template/template','report/online/index', $data);
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

              $this->template->load('template/template','report/online/detail', $response);
              
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
              
              $this->template->load('template/template','report/online/detail', $response);

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

    public function cetak(){
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);

        $data = [
           "bulan" => $bulan,
           "tahun" => $tahun
        ];

        $this->load->view('report/online/print', $data);

    }

    public function get_ajax(){
        $bulan = $this->uri->segment(3);
        $tahun = $this->uri->segment(4);

        $list = $this->ReportOnline_M->get_datatables($bulan, $tahun);

        $data = [];
        $no = @$_POST['start'];
        foreach($list as $item){
           $no++;
           $row = [];
           $row[] = $no.".";
           $row[] = $item->nama_user;
           $row[] = $item->namaruang;
           $row[] = $item->nama_kegiatan;
           $row[] = date('d-m-Y', strtotime($item->tanggal));
           $row[] = $item->mulai;
           $row[] = $item->selesai;
           $row[] = date('H', strtotime($item->waktu)) === "00" ? date('i', strtotime($item->waktu))." Menit" : date('H', strtotime($item->waktu))." Jam ".date('i', strtotime($item->waktu))." Menit";

           $data[] = $row;
        }

        $output = [
           "draw" => @$_POST['draw'],
           "recordsTotal" => $this->ReportOnline_M->count_all($bulan, $tahun),
           "recordsFiltered" => $this->ReportOnline_M->count_filtered($bulan, $tahun),
           "data" => $data,
        ];
        // output to json format
        echo json_encode($output);
    }

    public function search_status2(){
        try{

            $status = $this->input->post('status');
            // var_dump($status);
            if($status === "all"){
                
                $data = $this->ReportOnline_M->getDataFromStatus2();
                $checkLengthArray = count($data) === 0 ? [] : $data;
  
                $response = [
                    "pesan" => "Sukses",
                    "msg" => "Berhasil mendapatkan data!",
                    "status" => true,
                    "data" => $checkLengthArray
                ];
  
                echo json_encode($response);
            }else{
                $data = $this->ReportOnline_M->getDataFromStatus2($status);
                $checkLengthArray = count($data) === 0 ? [] : $data;
  
                $response = [
                    "pesan" => "Sukses",
                    "msg" => "Berhasil mendapatkan data!",
                    "status" => true,
                    "data" => $checkLengthArray
                ];
                
                echo json_encode($response);
            }
    
          }catch(Exception $e){
            $response = [
                "pesan" => "Gagal",
                "msg" => "Tidak berhasil mendapatkan Data Booking!".$e,
                "status" => false
            ];
            echo json_encode($response);
          }
    }

    public function search_status(){
        try{

          $status = $this->input->post('status');
          
          if($status === "all"){
              
              $data = $this->ReportOnline_M->getDataFromStatus();
              $checkLengthArray = count($data) === 0 ? [] : $data;

              $response = [
                  "pesan" => "Sukses",
                  "msg" => "Berhasil mendapatkan data!",
                  "status" => true,
                  "data" => $checkLengthArray
              ];

              echo json_encode($response);
          }else{
              $data = $this->ReportOnline_M->getDataFromStatus($status);
              $checkLengthArray = count($data) === 0 ? [] : $data;

              $response = [
                  "pesan" => "Sukses",
                  "msg" => "Berhasil mendapatkan data!",
                  "status" => true,
                  "data" => $checkLengthArray
              ];
              
              echo json_encode($response);
          }
  
        }catch(Exception $e){
          $response = [
              "pesan" => "Gagal",
              "msg" => "Tidak berhasil mendapatkan Data Booking!".$e,
              "status" => false
          ];
          echo json_encode($response);
        }
    }

    public function check_data(){
        try{

            $id_pemesanan = $this->input->post('id_pemesanan');
            $kategorimeeting = $this->input->post('kategorimeeting');

            $data = $this->ReportOnline_M->getDetailNewMeeting($id_pemesanan, $kategorimeeting);

            if($data->num_rows() > 0){

                $pesan_approve = $data->row()->pesan_approve;
                $linkatauid = $data->row()->linkatauid;
                $password = $data->row()->password;

                if($password === null && $linkatauid === null){
                    $response = [
                        "pesan" => "Gagal",
                        "msg" => "Datanya belum ada di dalam Sistem! Silahkan inputkan Link, Password!",
                        "status" => false
                    ];
                    echo json_encode($response);
                }else{
                    $response = [
                        "pesan" => "Sukses",
                        "msg" => "Datanya suda ada di dalam Sistem",
                        "status" => true,
                        "data"=> true
                    ];
                    echo json_encode($response);
                }
            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Datanya belum ada di dalam Sistem! Silahkan inputkan Link, Password!",
                    "status" => false
                ];
                echo json_encode($response);
            }
    
          }catch(Exception $e){
            $response = [
                "pesan" => "Gagal",
                "msg" => "Tidak berhasil mendapatkan Data Booking!".$e,
                "status" => false
            ];
            echo json_encode($response);
          }
    }


    public function sendwhatsapp(){
        try{

            $id_pemesanan = $this->input->post('id_pemesanan');
            $kategorimeeting = $this->input->post('kategorimeeting');

            $data = $this->ReportOnline_M->getDetailNewMeeting($id_pemesanan, $kategorimeeting);

            if($data->num_rows() > 0){

                $pesan_approve = $data->row()->pesan_approve;
                $linkatauid = $data->row()->linkatauid;
                $password = $data->row()->password === "(none)" ? "Tidak ada password" : $data->row()->password;
                $phone = strval($data->row()->phone);
                $mulai = $data->row()->mulai;
                $selesai = $data->row()->selesai;
                
                // var_dump($password);
                $message = "-Pesan Otomatis dari PT KSS-\n Link Zoom anda: ".$linkatauid."\n Password: ".$password."\n Harap bergabung pada meeting sesuai dengan waktunya";
                
                // var_dump(gettype($phone));

                $userkey = '5a1b95f53e00';
                $passkey = '8219bae5f01a86351d115868';

                $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
                $curlHandle = curl_init();
                curl_setopt($curlHandle, CURLOPT_URL, $url);
                curl_setopt($curlHandle, CURLOPT_HEADER, 0);
                curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
                    'userkey' => $userkey,
                    'passkey' => $passkey,
                    'to' => $phone,
                    'message' => $message
                ));
                $results = json_decode(curl_exec($curlHandle), true);
                echo json_encode($results);
                curl_close($curlHandle);


            }else{
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Datanya belum ada di dalam Sistem! Silahkan inputkan Link, Password!",
                    "status" => false
                ];
                echo json_encode($response);
            }

        }catch(Exception $e){
            $response = [
                "pesan" => "Gagal",
                "msg" => "Tidak berhasil mendapatkan Data Booking!".$e,
                "status" => false
            ];
            echo json_encode($response);
        }
    }

}