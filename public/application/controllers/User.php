<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check_admin();ini jangan ditambahin admin, nanti usernya ga bisaa masuk
        check_not_login();
        $this->load->model('user_model');
    }

    public function index()
    {
        $data['counter'] = 1;
        $data['counter_online'] = 1;
        $data['user'] = $this->db->get_where('user',['emp_no' => $this->session->userdata('emp_no')])->row_array();
        $data['listDataOfBooking'] = $this->user_model->getDetailListOfBooking()->result();
        $data['listDataOfBookingOnline'] = $this->user_model->getDetailListOfBookingOnline()->result();
        //this->load fungsi di library template-> load view(folder/template.php,isi yang diinginkan)
        $this->template->load('template/template','user/dashboard', $data);
        
    }

    public function get_ajax(){
        $list = $this->user_model->get_datatables();

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

            $data[] = $row;
        }

        $output = [
            "draw" => @$_POST['draw'],
			"recordsTotal" => $this->user_model->count_all(),
			"recordsFiltered" => $this->user_model->count_filtered(),
			"data" => $data,
        ];
		// output to json format
		echo json_encode($output);
    }

    public function get_ajax_online(){
        $list = $this->user_model->get_datatables_online();

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

            $data[] = $row;
        }

        $output = [
            "draw" => @$_POST['draw'],
			"recordsTotal" => $this->user_model->count_all_online(),
			"recordsFiltered" => $this->user_model->count_filtered_online(),
			"data" => $data,
        ];
		// output to json format
		echo json_encode($output);
    }
    
}
