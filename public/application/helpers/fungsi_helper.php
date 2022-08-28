<?php 

function check_already_login(){
    $ci=& get_instance();
    $user_session = $ci->session->userdata('emp_no');
    if($user_session){
        redirect('auth');
    }
}

function check_not_login(){
    $ci=& get_instance();
    $user_session = $ci->session->userdata('emp_no');
    if(!$user_session){
        redirect('auth');
    }
}

function check_admin()
{
	$ci =& get_instance();
	$ci->load->library('fungsi');
	if($ci->fungsi->user_login()->id_userlevel != 1){
		redirect('user');
	}
}

function check_access($id_userlevel, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('id_userlevel', $id_userlevel);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
?>