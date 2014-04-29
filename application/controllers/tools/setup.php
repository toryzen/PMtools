<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller {
	
    private $dwz;
    private $rldwz;
    
	function __construct(){
		parent::__construct();
		$this->load->model("tools_setup_model");
		//处理DWZ
		$this->dwz=$this->input->post('dwz')?$this->input->post('dwz'):$this->input->get('dwz');
		if($this->dwz){
			$this->fid = $this->tools_setup_model->get_id($this->dwz,'dwz');
			$type['type'] = "dwz";
			$type['value'] = $this->dwz;
		}
		$this->rldwz=$this->input->get('rldwz');
		if($this->rldwz){
			$this->fid = $this->tools_setup_model->get_id($this->rldwz,'rldwz');
			$type['type'] = "rldwz";
			$type['value'] = $this->rldwz;
		}
		$this->type = "setup";
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
            if($this->form_validation->run('tools/setup/index') === FALSE) {
                error_redirct("tools/setup/index");
            }  else {
                $dwz = $this->tools_setup_model->insert_data($this->input->post());
                success_redirct("tools/setup/pannel/?dwz=".$dwz);
            }
        }  else {
            $this->load->view('tools/setup/index');
        }
	}
	
	public function pannel(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_setup_model->get_info($this->fid);
        if($this->dwz){
            $this->load->view("tools/setup/pannel",$data);
        }else{
            $this->load->view("tools/setup/readonly",$data);
        }
	}
	
	public function edit(){
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/setup/edit') === FALSE) {
                error_redirct("tools/setup/edit/?dwz=".$_POST['dwz']);
            }  else {
                $this->tools_setup_model->update_data($this->input->post(),$this->fid);
                success_redirct("tools/setup/pannel/?dwz=".$_POST['dwz']);
            }
		}  else {
            if($_GET['dwz']){
                $data = $this->tools_setup_model->get_info($this->fid);
                $this->load->view("tools/setup/edit",$data);
            }    
        }
	}
    
}
