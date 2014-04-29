<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs extends CI_Controller {
	
	public $dirc = "/home/htdocs/project_manage/uploads/";
    private $dwz;
    private $rldwz;
	
	function __construct(){
		parent::__construct();
		$this->load->model("tools_docs_model");
        $this->dwz=$this->input->post('dwz')?$this->input->post('dwz'):$this->input->get('dwz');
		if($this->dwz){
			$this->fid = $this->tools_docs_model->get_id($this->dwz,'dwz');
			$type['type'] = "dwz";
			$type['value'] = $this->dwz;
		}
        if(!$this->fid){
            $this->rldwz=$this->input->post('rldwz')?$this->input->post('rldwz'):$this->input->get('rldwz');
            if($this->rldwz){
                $this->fid = $this->tools_docs_model->get_id($this->rldwz,'rldwz');
                $type['type'] = "rldwz";
                $type['value'] = $this->rldwz;
            }    
        }
		$this->type = "docs";
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
            if($this->form_validation->run('tools/docs/index') === FALSE) {
                error_redirct("tools/docs/index");
            }  else {
                $dwz = $this->tools_docs_model->insert_data($this->input->post());
                success_redirct("tools/docs/pannel/?dwz=".$dwz);
            }
		}  else {
            $this->load->view("tools/docs/index");
        }
	}
	
	public function edit(){
		$this->view_override = FALSE;
		if($this->input->post()){
            //表单验证
            $this->load->library('form_validation');
            if($this->form_validation->run('tools/docs/edit') === FALSE) {
                error_redirct("tools/docs/edit/?dwz=".$_POST['dwz']);
            }  else {
                $this->tools_docs_model->update_data($this->input->post(),$this->fid);
                success_redirct("tools/docs/pannel/?dwz=".$_POST['dwz']);
            }
		}else{
            if($_GET['dwz']){
                $data = $this->tools_docs_model->get_docs_info($this->fid);
                $this->load->view("tools/docs/edit",$data);
            }    
        }
	}
	
	/**
	 * 文件夹
	 */
	public function pannel(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_docs_model->get_info($this->fid);
		$this->load->view("tools/docs/pannel",$data);
	}
	
	public function readonly(){
		$this->depot = if_depot($this->type,$this->info['type'],$this->info['value']);
		$this->view_override = FALSE;
		$data = $this->tools_docs_model->get_info($this->fid);
		$this->load->view("tools/docs/readonly",$data);
	}
	
	public function download(){
		$this->view_override = FALSE;
		$data = $this->tools_docs_model->get_file_info($this->fid,$this->input->get('id'));
		$filename = $this->dirc.md5($this->input->get('rldwz'))."\\".md5($data['dwz']);
		//文件的类型
		header('Content-type: '.$data['ftype']);
		//下载显示的名字
		header('Content-Disposition: attachment; filename="'.$data['fname'].'');
		readfile("$filename");
		exit();
	}
	
	/**
	 * Ajax上传文档
	 */
	public function upload(){
		$this->view_override = FALSE;
		if(!empty($_FILES)){
			$dwz = dwz(md5(uniqid()));
			$file_name = $_FILES['file']['tmp_name'];
			$targetDirc  = $this->dirc.md5($_GET['rldwz'])."\\";
			$targetFile  = $targetDirc.md5($dwz);
			if (!file_exists($targetDirc))
			{
				mkdir($targetDirc, 0777);
			}
			if(move_uploaded_file($file_name,$targetFile)){
				$info['fname'] = $_FILES['file']['name'];
				$info['fsize'] = $_FILES['file']['size'];
				$info['ftype'] = $_FILES['file']['type'];
				$info['updatetime'] = date("Y-m-d H:i:s");
				$this->tools_docs_model->upload_docs($info,$this->fid,$dwz);
			}
		}
	}
	
	/**
	 * Ajax删除文档
	 */
	public function delete_doc(){
		$this->view_override = FALSE;
		$data = $this->tools_docs_model->delete_file($this->fid,$this->input->post('id'));
		echo $data;
	}
	
	/**
	 * Ajax文档列表
	 */
	public function get_doc_list(){
		$this->view_override = FALSE;
		$data = $this->tools_docs_model->file_list($this->fid);
		//print_r($this->fid);
		foreach($data as $l){
			$html .= "<tr>
              	<td>".$l['fname']."</td>
              	<td>".$l['ftype']."</td>
              	<td>".$l['fsize']."</td>
              	<td>".$l['updatetime']."</td>
              	<td>
              		<a class='btn btn-primary btn-xs' href='".base_url("index.php/tools/docs/download?rldwz=").$_POST['rldwz'].'&id='.$l['id']."'>下载</a>
  					<button type='button' class='btn btn-danger btn-xs' onclick='del_file(this,".$l['id'].")'>删除</button>
              	</td>
              </tr>";
		}
		echo $html;
	}
	
}
