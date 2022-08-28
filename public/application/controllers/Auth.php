<?php 
    defined ('BASEPATH') OR exit('No direct script access allowed');
    Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
    Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
    Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

class Auth extends CI_Controller {

public function __construct(){
parent::__construct();

$this->load->library('form_validation');

}
    
public function index()
    {
//        var_dump($this->session);die;
        if ($this->session->userdata('emp_no')) {
            redirect('User');
        }

        $this->form_validation->set_rules('emp_no', 'emp_no', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('authv/login');
        } else {
            // validasinya success
            $this->_login();
        }
        
    }

    private function _login()
    {
        $emp_no = $this->input->post('emp_no');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['emp_no' => $emp_no])->row_array();
        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'emp_no' => $user['emp_no'],
                        'id_userlevel' => $user['id_userlevel']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['id_userlevel'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Employee number is not registered!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('emp_no');
        $this->session->unset_userdata('id_userlevel');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function api_otp(){
    
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
            'to' => $this->input->post('phone'),
            'message' => $this->input->post('message')
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        echo json_encode($results);
        curl_close($curlHandle);
    }

    public function store(){
        try{

            $checkEmpNo = $this->db->get_where('user', ['emp_no' => $this->input->post('emp_no')])->row_array();
            if($checkEmpNo){
                $response = [
                    "pesan" => "Gagal",
                    "msg" => "Mohon maaf employee number anda sudah terdaftar di dalam sistem kami!",
                    "status" => false
                ];
                echo json_encode($response);
            }else{

                $data = [
                    'emp_no' => $this->input->post('emp_no'),
                    'nama_user'=> $this->input->post('nama_user'),
                    'phone'=> $this->input->post('phone'),
                    'email'=> $this->input->post('email'),
                    'password'=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'alamat'=> $this->input->post('alamat'),
                    'id_userlevel' => 2,
                    'is_active' => 1
                ];

                $this->db->insert('user', $data);

                $response = [
                    "pesan" => "Sukses",
                    "msg" => "Berhasil membuat akun!",
                    "status" => true
                ];
                echo json_encode($response);
    
            }


        }catch(Exception $err){
            $response = [
                "pesan" => "Gagal",
                "msg" => $err,
                "status" => false
            ];
            echo json_encode($response);
        }
    }

    public function registrasi()
	{
        $this->form_validation->set_rules('emp_no', 'employee number', 'required|trim');
        $this->form_validation->set_rules('nama_user', 'user name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]',[
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('alamat', 'address', 'required|trim');
        $this->form_validation->set_rules('phone', 'phone number', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('alamat', 'address', 'required');

        if($this->form_validation->run() == false){

		    $this->load->view('authv/regist');
        
        }else{

            $email = $this->input->post('email', true);
            $data = [
                'emp_no' => htmlspecialchars($this->input->post('emp_no', true)),
                'nama_user'=> htmlspecialchars($this->input->post('nama_user', true)) ,
                'phone'=> htmlspecialchars ($this->input->post('phone', true)),
                'email'=>htmlspecialchars($email),
                'password'=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'alamat'=> htmlspecialchars($this->input->post('alamat', true)),
                'id_userlevel' => 2,
                'is_active' => 1
            ];

            $checkEmpNo = $this->db->get_where('user', ['emp_no' => $this->input->post('emp_no', true)])->row_array();

            if($checkEmpNo){
    
                echo "<script>
                     alert('Employee Number sudah terdaftar di dalam sistem!');</script>";
                echo "<script>window.location='".site_url('auth/registrasi')."';</script>";
                
            }else{

                $this->db->insert('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
                congratulation Your account has been created. Please Login </div>');
                redirect('auth');

            }

        }
    }


    public function blocked()
    {
        $this->load->view('authv/blocked');
    }


}
