<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//include(APPPATH."third_party/rbac/controllers/index.php");


class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->login();
	}

	public function login(){
		
		$this->load->model("rbac_model");
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username&&$password){
			$STATUS = $this->rbac_model->check_user($username,$password);
			if($STATUS===TRUE){
				success_redirct($this->config->item('rbac_default_index'),"登录成功！");
			}else{
				error_redirct($this->config->item('rbac_auth_gateway'),$STATUS);
				die();
			}
			
		}else{
			//session_destroy();
			$this->load->view("login");
		}
		
	}

	public function logout(){
		session_destroy();
		success_redirct($this->config->item('rbac_auth_gateway'),"登出成功！",2);
	}

}

