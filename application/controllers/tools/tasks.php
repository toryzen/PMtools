<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->model("tools_task_model");
		//处理DWZ
		$this->dwz=$this->input->post('dwz')?$this->input->post('dwz'):$this->input->get('dwz');
		if($this->dwz){
			$this->fid = $this->tools_task_model->get_id($this->dwz,'dwz');
			$type['type'] = "dwz";
			$type['value'] = $this->dwz;
		}
		$this->rldwz=$this->input->get('rldwz');
		if($this->rldwz){
			$this->fid = $this->tools_task_model->get_id($this->rldwz,'rldwz');
			$type['type'] = "rldwz";
			$type['value'] = $this->rldwz;
		}
		$this->type = "tasks";
		$this->info = $type;
	}
	/**
	 * 新建面板
	 */
	public function index()
	{
		$this->view_override = FALSE;
		
		if($this->input->post()){
            //表单验证
			$this->load->library('form_validation');
            if($this->form_validation->run('tools/tasks/index') === FALSE) {
                error_redirct("tools/tasks/index");
            }  else {
                $dwz = $this->tools_task_model->insert_data($this->input->post('borad'),$this->input->post('task'));
                success_redirct("tools/tasks/pannel/?dwz=".$dwz);
            }
		}  else {
            $this->load->view("tools/tasks/index");
        }
	}
	
	/**
	 * 展示面板
	 */
	public function pannel(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_task_model->get_info($this->fid);
        if($this->dwz){
            $this->load->view("tools/tasks/pannel",$data);
        }else{
            $this->load->view("tools/tasks/readonly",$data);
        }
	}
	
	/**
	 * 修改面板
	 */
	public function edit(){
		$this->view_override = FALSE;
		if(!empty($_POST)){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/tasks/edit') === FALSE) {
                error_redirct("tools/tasks/edit/?dwz=".$_POST['dwz']);
            }  else {
                $this->tools_task_model->update_data($this->fid,$_POST['borad'],$_POST['task']);
                success_redirct("tools/tasks/pannel/?dwz=".$_POST['dwz']);
            }
		}  else {
            if($_GET['dwz']){
                $data = $this->tools_task_model->get_info($this->fid);
                $this->load->view("tools/tasks/edit",$data);
            }    
        }
	}
	
	/**
	 * 更新任务剩余工作量Ajax
	 */
	public function update_task(){
		$this->view_override = FALSE;
		@$retid = explode("|",$_POST['tid']);
		@$dwz = $_POST['dwz'];
		@$val = $_POST['val'];
		if(count($retid)==2){
			$re = $this->tools_task_model->update_task($retid[0],$retid[1],$dwz,$val);
			echo $re;
		}else{
			echo "信息错误！";
		}
	}
	
	/**
	 * 燃尽图数据Ajax
	 */
	public function burnpic(){
		$this->view_override = FALSE;
		@$data = $this->tools_task_model->picdate($this->fid);
		@$first = current($data);
		$left = "";
		$locus = "";
		if($data){
			foreach($data as $vo){
				if($vo){
					$left.=$vo.",";
				}
			}
		}
		$left = substr($left,0,-1);
		for($i = 0;$i<count($data);$i++){
			$locus.=round($first-($i*($first/count($data))),2).",";
		}
		$locus = substr($locus,0,-1);
		echo $left."|".$locus;
	}
	
}
