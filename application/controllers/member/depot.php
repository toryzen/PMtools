<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 仓库
 * @author Huangzhen
 */
class Depot extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("member_depot_model");
	}
	
	public function setup($type="all",$ishide="no",$page=1){
		$data = $this->member_depot_model->get_list($page,rbac_conf(array('INFO','id')),'setup',$type,$ishide);
		$param['uri_title'] = "立项仓库";
		$param['uri_type'] = $type;
		$param['uri_is_hide'] = $ishide;
		$param['uri_dirc'] = __FUNCTION__;
		$this->load->view('member/depot/list',array_merge(array("data"=>$data),$param));
	}
	
	public function plan($type="all",$ishide="no",$page=1){
		$data = $this->member_depot_model->get_list($page,rbac_conf(array('INFO','id')),'plan',$type,$ishide);
		$param['uri_title'] = "计划仓库";
		$param['uri_type'] = $type;
		$param['uri_is_hide'] = $ishide;
		$param['uri_dirc'] = __FUNCTION__;
		$this->load->view('member/depot/list',array_merge(array("data"=>$data),$param));
	}
	
	public function tasks($type="all",$ishide="no",$page=1){
		$data = $this->member_depot_model->get_list($page,rbac_conf(array('INFO','id')),'tasks',$type,$ishide);
		$param['uri_title'] = "任务仓库";
		$param['uri_type'] = $type;
		$param['uri_is_hide'] = $ishide;
		$param['uri_dirc'] = __FUNCTION__;
		$this->load->view('member/depot/list',array_merge(array("data"=>$data),$param));
	}
	
	public function docs($type="all",$ishide="no",$page=1){
		$data = $this->member_depot_model->get_list($page,rbac_conf(array('INFO','id')),'docs',$type,$ishide);
		$param['uri_title'] = "文档仓库";
		$param['uri_type'] = $type;
		$param['uri_is_hide'] = $ishide;
		$param['uri_dirc'] = __FUNCTION__;
		$this->load->view('member/depot/list',array_merge(array("data"=>$data),$param));
	}
	
	public function meeting($type="all",$ishide="no",$page=1){
		$data = $this->member_depot_model->get_list($page,rbac_conf(array('INFO','id')),'meeting',$type,$ishide);
		$param['uri_title'] = "会议仓库";
		$param['uri_type'] = $type;
		$param['uri_is_hide'] = $ishide;
		$param['uri_dirc'] = __FUNCTION__;
		$this->load->view('member/depot/list',array_merge(array("data"=>$data),$param));
	}
	
	//插入&删除条目_AJAX
	public function set_depot(){
		$this->view_override = FALSE;
		if($this->input->post('adde') && $this->input->post('adde') && $this->input->post('dtype') && $this->input->post('ctype') && $this->input->post('keys') ){
			$result = $this->member_depot_model->set_depot($_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["id"],
					$this->input->post('adde') ,
					$this->input->post('dtype') ,
					$this->input->post('ctype') ,
					$this->input->post('keys') ,
					$this->input->post('dname')
			);
			echo $result;
		}else{
			echo "信息获取失败,请刷新重试！";
		}
	}
	
	//修改条目别称_AJAX
	public function edit_depot(){
		$this->view_override = FALSE;
		if($this->input->post('id') && $this->input->post('dname')){
			$result = $this->member_depot_model->edit_depot($_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["id"],
					$this->input->post('id') ,
					$this->input->post('dname')
			);
			echo $result;
		}else{
			echo "信息获取失败,请刷新重试！";
		}
	}
	
	//隐藏条目别称_AJAX
	public function hide_depot(){
		$this->view_override = FALSE;
		if($this->input->post('id') && ($this->input->post('type')==1 || $this->input->post('type')==0)){
			$result = $this->member_depot_model->hide_depot($_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["id"],
					$this->input->post('id'),
					$this->input->post('type')
			);
			echo $result;
		}else{
			echo "信息获取失败,请刷新重试！";
		}
	}
    
}
