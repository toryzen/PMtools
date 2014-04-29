<?php

/**
 * 
 */
class Tools_Docs_model extends CI_Model {

	public function __construct(){
		//$this->load->helper("tools");
		$this->load->database();
	}
	/**
	 * 根据DWZ or RLDWZ 获取ID
	 * @param string $dwz
	 * @return int fid
	 */
    public function get_id($v,$type='dwz'){
        if($type=='dwz'){
            $where = " dwz = '$v'";
        }elseif ($type=='rldwz') {
            $where = " rldwz = '$v'";
        }else{
            return FALSE;
        }
		$sql = "SELECT id FROM `tools_docs` WHERE $where LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		return $reuslt['id'];
	}
	/**
	 * 新建文件工具
	 * @param array 
	 * @param array $task
	 * @return string dwz
	 */
	public function insert_data($info){
		//插入
		$dwz = dwz(md5(uniqid()));
		$rldwz = dwz($dwz);
		$sql = "INSERT INTO `tools_docs` (bname,dwz,rldwz) 
				VALUES('".$info['bname']."','".$dwz."','".$rldwz."')";
		$this->db->query($sql);
		$fid = $this->db->insert_id();
		in_depot('docs',$dwz,$info['bname']);
		//--------------------
		in_log('tools',array('tid'=>$fid,'ttype'=>'docs','title'=>'新建','contents'=>'新建文件工具('.$info['bname'].')','old_data'=>''));
		//--------------------
		
		return $dwz;
	}
	
	/**
	 * 获取数据(全部)
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info($fid){
		$sql = "SELECT * FROM `tools_docs` WHERE id = '$fid' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt['docs']  = $query->row_array();
		$sql = "SELECT * FROM `tools_docs_list` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$reuslt['list']  = $query->result_array();
        $reuslt['bname'] = $reuslt['docs']['bname'];
		return $reuslt;
	}
	
	/**
	 * 获取文档数据
	 * @param unknown $fid
	 * @return unknown
	 */
	public function get_docs_info($fid){
		$sql = "SELECT * FROM `tools_docs` WHERE id = '$fid' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		return $reuslt;
	}
	
	/**
	 * 更新文件工具
	 * @param unknown $info
	 * @param unknown $fid
	 */
	public function update_data($info,$fid){
		//--------------------
		$sql = "SELECT * FROM  `tools_docs` WHERE id = {$fid} ";
		$query = $this->db->query($sql);
		$old_data = serialize($query->row_array());
		in_log('tools',array('tid'=>$fid,'ttype'=>'docs','title'=>'修改','contents'=>'文件夹名称修改为('.$info['bname'].')','old_data'=>$old_data));
		//-------------------
		$sql = "UPDATE `tools_docs` set bname = '".$info['bname']."' WHERE id = {$fid} ";
		$query = $this->db->query($sql);
	}
	
	/**
	 * 获取文件列表
	 * @param unknown $fid
	 * @return unknown
	 */
	public function file_list($fid){
		$sql = "SELECT * FROM `tools_docs_list` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$reuslt  = $query->result_array();
		return $reuslt;
	}
	
	/**
	 * 获取单一文件信息
	 * @param unknown $fid
	 * @param unknown $id
	 * @return unknown
	 */
	public function get_file_info($fid,$id){
		$sql = "SELECT * FROM `tools_docs_list` WHERE fid = '{$fid}' AND id = '{$id}' AND is_del = 0 LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		return $reuslt;
	}
	
	/**
	 * 删除单一文件
	 * @param unknown $fid
	 * @param unknown $id
	 * @return unknown
	 */
	public function delete_file($fid,$id){
		//--------------------
		$sql = "SELECT * FROM  `tools_docs_list`  WHERE id = '{$id}' AND fid = '{$fid}'";
		$query = $this->db->query($sql);
		$old_data = $query->row_array();
		in_log('tools',array('tid'=>$fid,'ttype'=>'docs','title'=>'删除文件','contents'=>'删除文件('.$old_data['fname'].')','old_data'=>serialize($old_data)));
		//-------------------
		
		$sql = "UPDATE  `tools_docs_list` SET is_del = 1 WHERE id = '{$id}' AND fid = '{$fid}'";
		$query = $this->db->query($sql);
		return $query;
	}
	
	/**
	 * 添加单一文档
	 * @param int $fid
	 * @param string $borad
	 * @param string $task
	 */
	public function upload_docs($info,$fid,$dwz){
		
		//--------------------
		in_log('tools',array('tid'=>$fid,'ttype'=>'docs','title'=>'上传文件','contents'=>'上传文件('.$info['fname'].')','old_data'=>''));
		//-------------------
		
		$sql = "INSERT INTO  `tools_docs_list` (fid,fname,fsize,ftype,updatetime,dwz) 
				values('".$fid."','".$info['fname']."','".$info['fsize']."','".$info['ftype']."','".$info['updatetime']."','".$dwz."')";
		$this->db->query($sql);
	}


}

