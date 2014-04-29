<?php

/**
 * 
 */
class Tools_setup_model extends CI_Model {

	public function __construct(){
		//$this->load->helper("tools");
		$this->load->database();
	}
	/**
	 * 根据DWZ or RLDWZ 获取ID
	 * @param string $dwz
     * @param string $type 0 dwz,1 rldwz.
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
		$sql = "SELECT id FROM `tools_setup` WHERE $where LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		return $reuslt['id'];
	}
	/**
	 * 插入面板与任务数据
	 * @param array $borad
	 * @param array $task
	 * @return string dwz
	 */
	public function insert_data($info){
		//插入borad
		$dwz = dwz(md5(uniqid()));
		$rldwz = dwz($dwz);
		unset($info['other']['name'][0]);
		unset($info['other']['value'][0]);
		$info['describ'] = str_replace("\n","<br/>",$info['describ']);
		$info['background'] = str_replace("\n","<br/>",$info['background']);
		$info['demand'] = str_replace("\n","<br/>",$info['demand']);
		$info['meaning'] = str_replace("\n","<br/>",$info['meaning']);
		$sql = "INSERT INTO `tools_setup` (bname,describ,background,demand,meaning,other,dwz,rldwz) 
				VALUES('".$info['bname']."','".$info['describ']."','".$info['background']."','".$info['demand']."','".$info['meaning']."','".serialize($info['other'])."','".$dwz."','".$rldwz."')";
		$this->db->query($sql);
		$fid = $this->db->insert_id();
		
		in_depot('setup',$dwz,$info['bname']);
		
		//--------------------
		in_log('tools',array('tid'=>$fid,'ttype'=>'setup','title'=>'新建','contents'=>'新建立项工具('.$info['bname'].')','old_data'=>''));
		//--------------------
		
		return $dwz;
	}
	
	/**
	 * 获取数据
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info($fid){
		$sql = "SELECT * FROM `tools_setup` WHERE id = '$fid' LIMIT 1";
		//echo $sql;
		$query = $this->db->query($sql);
		$reuslt  = $query->row_array();
		$reuslt['other'] = unserialize($reuslt['other']);
		return $reuslt;
	}
	
	/**
	 * 更新立项数据
	 * @param int $fid
	 * @param string $borad
	 * @param string $task
	 */
	public function update_data($info,$fid){
		//-------------------
		$sql = "SELECT * FROM `tools_setup` WHERE id = $fid";
		$query = $this->db->query($sql);
		$old_data = $query->result_array();
		in_log('tools',array('tid'=>$fid,'ttype'=>'setup','title'=>'更新立项','contents'=>'更新立项信息','old_data'=>serialize($old_data)));
		//-------------------
		
		unset($info['other']['name'][0]);
		unset($info['other']['value'][0]);
		$info['describ'] = str_replace("\n","<br/>",$info['describ']);
		$info['background'] = str_replace("\n","<br/>",$info['background']);
		$info['demand'] = str_replace("\n","<br/>",$info['demand']);
		$info['meaning'] = str_replace("\n","<br/>",$info['meaning']);
		//更新Borad
		$sql = "UPDATE `tools_setup` SET 
				bname = '".$info['bname']."'
				,describ='".$info['describ']."'
				,background='".$info['background']."'
				,demand='".$info['demand']."'
				,meaning='".$info['meaning']."'
				,other='".addslashes(serialize($info['other']))."' 
				WHERE id = $fid";
		$this->db->query($sql);
	}


}

