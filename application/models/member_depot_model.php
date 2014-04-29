<?php

/**
 * 
 */
class Member_depot_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}

	/**
	 * 记录/取消仓库
	 * @param unknown $userid
	 * @param unknown $adde
	 * @param unknown $dtype
	 * @param unknown $ctype
	 * @param unknown $keys
	 * @return number
	 */
	public function set_depot($userid,$adde,$dtype,$ctype,$keys,$dname){
		$sql = "SELECT id FROM `member_depot`  WHERE userid = '$userid' AND dtype= '$dtype' AND ctype='$ctype' AND `keys` = '$keys' ";
		$query = $this->db->query($sql);
		if(!$query->row_array()){
			if($adde=="add"){
				$sql = "INSERT INTO `member_depot` (userid,dtype,ctype,`keys`,`dname`)
						VALUES ('$userid','$dtype','$ctype','$keys','$dname')";
				$this->db->query($sql);
			}
			return 'add_ok';
		}else{
			if($adde=="del"){
				$sql = "DELETE FROM `member_depot` WHERE userid = '$userid' AND dtype= '$dtype' AND ctype='$ctype' AND `keys` = '$keys' ";
				$this->db->query($sql);
			}
			return 'del_ok';
		}
	}
	/**
	 * 修改仓库别称
	 * @param unknown $userid
	 * @param unknown $id
	 * @param unknown $dname
	 * @return string
	 */
	public function edit_depot($userid,$id,$dname){
		$sql = "SELECT count(1) FROM `member_depot` WHERE userid = '$userid' AND id = '$id'";
		$query = $this->db->query($sql);
		if($query->row_array()){
			$sql = "UPDATE `member_depot` set `dname` = '$dname' WHERE id ='$id' ";
			$this->db->query($sql);
			//return $sql;
			return 'ok';
		}else{
			return "操作失败,未找到此条目";
		}
	}
	/**
	 * 隐藏条目
	 * @param unknown $userid
	 * @param unknown $id
	 * @param unknown $dname
	 * @return string
	 */
	public function hide_depot($userid,$id,$type){
		$sql = "SELECT count(1) FROM `member_depot` WHERE userid = '$userid' AND id = '$id'";
		$query = $this->db->query($sql);
		if($query->row_array()){
			$sql = "UPDATE `member_depot` set `hide` = '$type' WHERE id ='$id' ";
			$this->db->query($sql);
			return 'ok';
		}else{
			return "操作失败,未找到此条目";
		}
	}
	/**
	 * 是否已记录至仓库
	 * @param unknown $userid
	 * @param unknown $dtype
	 * @param unknown $ctype
	 * @param unknown $keys
	 * @return boolean
	 */
	public function if_depot($userid,$dtype,$ctype,$keys){
		$sql = "SELECT id FROM `member_depot`  WHERE userid = '$userid' AND dtype= '$dtype' AND ctype='$ctype' AND `keys` = '$keys' ";
		//echo $sql;
		$query = $this->db->query($sql);
		if($query->row_array()){
			return 1;
		}else{
			return 0;
		}
	}
	/**
	 * 获取仓库列表
	 * @param unknown $page
	 * @param unknown $userid
	 * @param unknown $dtype
	 * @return unknown
	 */
	public function get_list($page,$userid,$dtype,$type,$ishide){
		//分页
		$this->load->library('pagination');
		$config['base_url'] = site_url("member/depot/".$dtype."/".$type);
		$config['total_rows'] = $this->get_num($userid,$dtype);
		$config['per_page']   = 35;
		$config['uri_segment']= '6';
		$this->pagination->initialize($config);		
		$limit = (($page-1)*$config['per_page']).",".$config['per_page'];
		if($type=='manage'){
			$on = "`a`.`keys` = `b`.`dwz`";
		}elseif($type=='readonly'){
			$on = "`a`.`keys` = `b`.`rldwz`";
		}else{
			$on = "`a`.`keys` = `b`.`dwz` OR `a`.`keys` = `b`.`rldwz`";
		}
		if($ishide=='yes'){
			$where = "and a.hide = 1";
		}else{
			$where = "and a.hide = 0";
		}
		$sql = "SELECT a.id as id,`dname`,`ctype`,`bname`,`a`.`keys` FROM `member_depot` a 
				INNER JOIN `tools_$dtype` b 
				ON $on
				WHERE a.dtype = '$dtype' and a.userid = '$userid' $where ORDER BY id desc
				LIMIT $limit";
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}
	
	public function get_num($userid,$dtype){
		$sql = "SELECT COUNT(1) as cnt FROM `member_depot` WHERE dtype = '$dtype' AND userid = '$userid' ";
		$query = $this->db->query($sql);
		$cnt_data = $query->row_array();
		return $cnt_data['cnt'];
	}
	
}

