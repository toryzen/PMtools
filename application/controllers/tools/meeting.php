<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meeting extends CI_Controller {
    
    private $dwz;
    private $rldwz;
	
	function __construct(){
		parent::__construct();
		$this->load->model("tools_meeting_model");
		//处理DWZ
		$this->dwz=$this->input->post('dwz')?$this->input->post('dwz'):$this->input->get('dwz');
		if($this->dwz){
			$this->fid = $this->tools_meeting_model->get_id($this->dwz,'dwz');
			$type['type'] = "dwz";
			$type['value'] = $this->dwz;
		}
		$this->rldwz=$this->input->get('rldwz');
		if($this->rldwz){
			$this->fid = $this->tools_meeting_model->get_id($this->rldwz,'rldwz');
			$type['type'] = "rldwz";
			$type['value'] = $this->rldwz;
		}
		$this->type = "meeting";
		$this->info = $type;
	}
	/**
	 * 新建
	 */
	public function index()
	{
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/meeting/index') === FALSE) {
                error_redirct("tools/meeting/index");
            }  else {
                $dwz = $this->tools_meeting_model->insert_data($this->input->post('bname'),$this->input->post('meeting'));
                success_redirct("tools/meeting/pannel/?dwz=".$dwz);
            }
		}  else {
            $this->load->view("tools/meeting/index");    
        }
	}
	
	public function pannel(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_meeting_model->get_info($this->fid);
        if($this->dwz){
            $this->load->view("tools/meeting/pannel",$data);
        }else{
            $this->load->view("tools/meeting/readonly",$data);
        }
	}
	
	public function edit(){
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/meeting/edit') === FALSE) {
                error_redirct("tools/meeting/edit/?dwz=".$_POST['dwz']);
            }  else {
                $this->tools_meeting_model->update_data($this->input->post('bname'),$this->input->post('meeting'),$this->fid);
                success_redirct("tools/meeting/pannel/?dwz=".$_POST['dwz']);
            }
		}  else {
            if($_GET['dwz']){
                $data = $this->tools_meeting_model->get_info($this->fid);
                $this->load->view("tools/meeting/edit",$data);
            }    
        }
	}
	
	
}
