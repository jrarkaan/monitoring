<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportOffline extends CI_Controller
{
      public function __construct()
      {
          parent::__construct();
          check_admin();
          check_not_login();
          $this->load->model(['ReportOffline_M', 'Admin_model']);
      }

      public function index(){
         $bulan = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
         $getDataOffline = $this->ReportOffline_M->getDataOffline()->result();
         $i = 1;
         $data = [
            "test"=> "tamvan",
            "getDataOffline" => $getDataOffline,
            "i" => $i,
            "bulan" => $bulan
         ];
         
         $this->template->load('template/template','report/offline/index', $data);
      }

      public function search_status(){
         try{
 
           $status = $this->input->post('status');
           
            if($status === "all"){

               $data = $this->ReportOffline_M->getDataFromStatus()->result();
               $checkLengthArray = count($data) === 0 ? [] : $data;
 
               $response = [
                   "pesan" => "Sukses",
                   "msg" => "Berhasil mendapatkan data!",
                   "status" => true,
                   "data" => $checkLengthArray
               ];
 
               echo json_encode($response);
            }else{
               $data = $this->ReportOffline_M->getDataFromStatus($status)->result();
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

      public function detail(){

         $id_pemesanan = $this->uri->segment(3);

         $data = $this->ReportOffline_M->getDetailDataOffline($id_pemesanan)->result();
         $ruang = $this->Admin_model->get_ruang();

         $checkLengthArray = count($data) === 0 ? [] : $data;
 
         $response = [
             "pesan" => "Sukses",
             "msg" => "Berhasil mendapatkan data!",
             "status" => true,
             "data" => $checkLengthArray,
             "getRuang" => $ruang
         ];
 
         $this->template->load('template/template','report/offline/detail', $response);

      }

      public function cetak(){
         $bulan = $this->uri->segment(3);
         $tahun = $this->uri->segment(4);

         $data = [
            "bulan" => $bulan,
            "tahun" => $tahun
         ];

         $this->load->view('report/offline/print', $data);

      }

      public function get_ajax(){
         $bulan = $this->uri->segment(3);
         $tahun = $this->uri->segment(4);

         $list = $this->ReportOffline_M->get_datatables($bulan, $tahun);

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
            "recordsTotal" => $this->ReportOffline_M->count_all($bulan, $tahun),
            "recordsFiltered" => $this->ReportOffline_M->count_filtered($bulan, $tahun),
            "data" => $data,
         ];
         // output to json format
         echo json_encode($output);
      }

}