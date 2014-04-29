<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {
	
    private $dwz;
    private $rldwz;
    
	function __construct(){
		parent::__construct();
		$this->load->model("tools_plan_model");
		//处理DWZ
		$this->dwz=$this->input->post('dwz')?$this->input->post('dwz'):$this->input->get('dwz');
		if($this->dwz){
			$this->fid = $this->tools_plan_model->get_id($this->dwz,'dwz');
			$type['type'] = "dwz";
			$type['value'] = $this->dwz;
		}
		$this->rldwz=$this->input->get('rldwz');
		if($this->rldwz){
			$this->fid = $this->tools_plan_model->get_id($this->rldwz,'rldwz');
			$type['type'] = "rldwz";
			$type['value'] = $this->rldwz;
		}
		$this->type = "plan";
		$this->info = $type;
	}
	/**
	 * 新建计划
	 */
	public function index()
	{
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/plan/index') === FALSE) {
                error_redirct("tools/plan/index");
            }  else {
                $dwz = $this->tools_plan_model->insert_data($this->input->post('plan'),$this->input->post('task'),$this->input->post('milestone'));
                success_redirct("tools/plan/pannel/?dwz=".$dwz);
            }
		}  else {
            $this->load->view("tools/plan/index");
        }
	}
	
	public function pannel(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_plan_model->get_info($this->fid);
        if($this->dwz){
            $this->load->view("tools/plan/pannel",$data);
        }else{
            $this->load->view("tools/plan/readonly",$data);
        }
	}
	
	public function edit(){
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/plan/edit') === FALSE) {
                error_redirct("tools/plan/edit/?dwz=".$_POST['dwz']);
            }  else {
                $this->tools_plan_model->update_data($this->input->post('plan'),$this->input->post('task'),$this->input->post('milestone'),$this->fid);
                success_redirct("tools/plan/pannel/?dwz=".$_POST['dwz']);
            }
		}  else {
            if($_GET['dwz']){
                $data = $this->tools_plan_model->get_info_for_edit($this->fid);
                $this->load->view("tools/plan/edit",$data);
            }    
        }
	}
	
	
}
