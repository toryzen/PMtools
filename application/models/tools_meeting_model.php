<?php

/**
 * 
 */
class Tools_meeting_model extends CI_Model {

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
		$sql = "SELECT id FROM `tools_meeting` WHERE $where LIMIT 1";
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
	public function insert_data($bname,$meeting){
		$dwz = dwz(md5(uniqid()));
		$rldwz = dwz($dwz);
		
		//插入
		$sql = "INSERT INTO `tools_meeting` (bname,dwz,rldwz)
				VALUES('".$bname."','".$dwz."','".$rldwz."')";
		$this->db->query($sql);
		$fid = $this->db->insert_id();
		$meeting['info'] = str_replace("\n","<br/>",$meeting['info']);
		$meeting['memo'] = str_replace("\n","<br/>",$meeting['memo']);
		//插入
		$sql = "INSERT INTO `tools_meeting_list` (fid,mname,begintime,people,info,memo) VALUES ";
		for($i=1;$i<count($meeting['mname']);$i++){
			$sql.="('".$fid."','".$meeting['mname'][$i]."','".$meeting['begintime'][$i]."','".$meeting['people'][$i]."','".$meeting['info'][$i]."','".$meeting['memo'][$i]."'),";
		}
		$sql = substr($sql, 0,-1);
        if(count($meeting['mname'])>1){
            $this->db->query($sql);
        }
		
        in_depot('meeting',$dwz,$bname);
        
        //-------------------
        in_log('tools',array('tid'=>$fid,'ttype'=>'meeting','title'=>'新建会议工具','contents'=>'新建会议夹('.$bname.')','old_data'=>''));
        //-------------------
		
		return $dwz;
	}
	
	/**
	 * 获取数据
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info($fid){
		$sql = "SELECT * FROM `tools_meeting` WHERE id = '$fid' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt['info']  = $query->row_array();
		 
		$sql = "SELECT * FROM `tools_meeting_list` WHERE fid = '$fid' AND is_del = 0 ORDER BY begintime ASC";
		$query = $this->db->query($sql);
		$reuslt['metting']  = $query->result_array();
        $reuslt['bname'] = $reuslt['info']['bname'];
		return $reuslt;
	}
	
	
	/**
	 * 更新数据
	 * @param int $fid
	 * @param string $borad
	 * @param string $task
	 */
	public function update_data($bname,$meeting,$fid){
		//-------------------
		$sql = "SELECT * FROM  `tools_meeting`  WHERE id = $fid";
		$query = $this->db->query($sql);
		$old_data['meeting'] = $query->row_array();
		$sql = "SELECT * FROM `tools_meeting_list` WHERE fid = $fid";
		$query = $this->db->query($sql);
		$old_data['list'] = $query->result_array();
		in_log('tools',array('tid'=>$fid,'ttype'=>'meeting','title'=>'更新会议','contents'=>'更新会议','old_data'=>serialize($old_data)));
		//-------------------
		
		//更新plan
		$sql = "UPDATE `tools_meeting` SET bname = '".$bname."' WHERE id = $fid";
		$this->db->query($sql);
		//更新Task
		$sql = "UPDATE `tools_meeting_list` SET is_del = '1' WHERE fid = $fid";
		$this->db->query($sql);
		for($i=1;$i<count($meeting['id']);$i++){
			if($meeting['id'][$i]){
				$sql = "UPDATE `tools_meeting_list` SET is_del = 0, 
						mname = '".$meeting['mname'][$i]."'
						,begintime='".$meeting['begintime'][$i]."'
						,people='".$meeting['people'][$i]."'
						,info='".$meeting['info'][$i]."'
						,memo='".$meeting['memo'][$i]."'
				WHERE id = '".$meeting['id'][$i]."'";
			}else{
				$sql = "INSERT INTO `tools_meeting_list` (fid,mname,begintime,people,info,memo) VALUES ";
				$sql.="('".$fid."','".$meeting['mname'][$i]."','".$meeting['begintime'][$i]."','".$meeting['people'][$i]."','".$meeting['info'][$i]."','".$meeting['memo'][$i]."')";
			}
			$this->db->query($sql);
		}
	}
}

