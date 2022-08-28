<?php
    Class Fungsi {
        protected $ci;
        function __construct(){
            $this->ci =& get_instance();
        }

        function user_login(){
            $this->ci->load->model('User_Model');
            $emp_no = $this->ci->session->userdata('emp_no');
            $user_data = $this->ci->User_Model->get($emp_no)->row();
            return $user_data;
        }

        function _isCurl(){
            return function_exists('curl_version');
        }

        public function count_bookingOnline(){
            $status = "1";
            $this->ci->load->model('admin_model');
            return $this->ci->admin_model->getDataBookingOnline1($status);
        }

        public function count_bookingOffline(){
            $status = "1";
            $this->ci->load->model('admin_model');
            return $this->ci->admin_model->getDataBooking1($status);
        }

    }
?>