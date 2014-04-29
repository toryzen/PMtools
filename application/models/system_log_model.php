<?php

/**
 * 
 */
class System_log_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	/**
	 * 根据dwz获取FID
	 * @param string $dwz
	 * @return int fid
	 */
	public function get_id_by_dwz($dwz){
		$sql = "SELECT id FROM `tools_docs` WHERE dwz = '$dwz' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		return $reuslt['id'];
	}
	
	public function tools($param){
		$tid      = $param['tid'];
		$ttype    = $param['ttype'];
		$title    = $param['title'];
		$contents = $param['contents'];
		$old_data = $param['old_data'];
		$nickname = $_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["nickname"];
		$sql = "INSERT INTO system_tools_log (tid,ttype,title,contents,auser,aip,old_data)
				VALUES('$tid','$ttype','$title','$contents','$nickname','".getIP()."','$old_data')
				";
		$this->db->query($sql);
	}

}

