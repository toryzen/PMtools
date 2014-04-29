<?php

/**
 * 
 */
class Tools_plan_model extends CI_Model {

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
		$sql = "SELECT id FROM `tools_plan` WHERE $where LIMIT 1";
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
	public function insert_data($plan,$task,$milestone){
		$dwz = dwz(md5(uniqid()));
		$rldwz = dwz($dwz);
		
		
		//插入Plan
		$sql = "INSERT INTO `tools_plan` (bname,begintime,endtime,exceptdays,dwz,rldwz)
				VALUES('".$plan['bname']."','".$plan['begintime']."','".$plan['endtime']."','".json_encode($plan['exceptdays'])."','".$dwz."','".$rldwz."')";
		$this->db->query($sql);
		$fid = $this->db->insert_id();
		
		//插入task
		$sql = "INSERT INTO `tools_plan_task` (fid,title,describ,owner,pdays,expstrt,expendt) VALUES ";
		for($i=1;$i<count($task['title']);$i++){
			$sql.="('".$fid."','".$task['title'][$i]."','".$task['describ'][$i]."','".$task['owner'][$i]."','".$task['pdays'][$i]."','".$task['expstrt'][$i]."','".$task['expendt'][$i]."'),";
		}
		$sql = substr($sql, 0,-1);
		$this->db->query($sql);
		
		//插入milestone
		$sql = "INSERT INTO `tools_plan_milestone` (fid,title,describ,timepoint) VALUES ";
		for($i=1;$i<count($milestone['title']);$i++){
			$sql.="('".$fid."','".$milestone['title'][$i]."','".$milestone['describ'][$i]."','".$milestone['timepoint'][$i]."'),";
		}
		$sql = substr($sql, 0,-1);
		$this->db->query($sql);
		
		in_depot('plan',$dwz,$plan['bname']);
		
		//--------------------
		in_log('tools',array('tid'=>$fid,'ttype'=>'plan','title'=>'新建','contents'=>'新建计划工具('.$plan['bname'].')','old_data'=>''));
		//--------------------
		
		return $dwz;
	}
	
	/**
	 * 获取数据
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info($fid){
		$sql = "SELECT * FROM `tools_plan` WHERE id = '$fid' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt['plan']  = $query->row_array();
		$reuslt['plan']['exceptdays'] = json_decode($reuslt['plan']['exceptdays'],TRUE);
		$reuslt['plan']['pic_start'] =  date("Y-m-d",strtotime("-".(date('w',strtotime($reuslt['plan']['begintime']))-1)." days" , strtotime($reuslt['plan']['begintime']) ));
		$reuslt['plan']['pic_end'] = date("Y-m-d",strtotime("+".(7-date('w',strtotime($reuslt['plan']['endtime'])))." days" , strtotime($reuslt['plan']['endtime']) ));
		 
		$sql = "SELECT *,expstrt as timepoint,'task' as type FROM `tools_plan_task` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$task  = $query->result_array();
		
		
		$sql = "SELECT *,'milestone' as type FROM `tools_plan_milestone` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$milestone  = $query->result_array();
		
		$tm = array_merge($task,$milestone);
		
		$reuslt['tm']  = array_sort($tm,'timepoint');
		$reuslt['bname'] = $reuslt['plan']['bname'];
		return $reuslt;
	}
	
	/**
	 * 获取数据(FOR EDIT)
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info_for_edit($fid){
		$sql = "SELECT * FROM `tools_plan` WHERE id = '$fid' LIMIT 1";
		$query = $this->db->query($sql);
		$reuslt['plan']  = $query->row_array();
		$reuslt['plan']['exceptdays'] = json_decode($reuslt['plan']['exceptdays'],TRUE);
		$reuslt['plan']['pic_start'] =  date("Y-m-d",strtotime("-".(date('w',strtotime($reuslt['plan']['begintime']))-1)." days" , strtotime($reuslt['plan']['begintime']) ));
		$reuslt['plan']['pic_end'] = date("Y-m-d",strtotime("+".(7-date('w',strtotime($reuslt['plan']['endtime'])))." days" , strtotime($reuslt['plan']['endtime']) ));
			
		$sql = "SELECT *,expstrt as timepoint,'task' as type FROM `tools_plan_task` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$reuslt['task']  = $query->result_array();
	
	
		$sql = "SELECT *,'milestone' as type FROM `tools_plan_milestone` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$reuslt['milestone']  = $query->result_array();

		return $reuslt;
	}
	
	/**
	 * 更新数据
	 * @param int $fid
	 * @param string $borad
	 * @param string $task
	 */
	public function update_data($plan,$task,$milestone,$fid){
		
		//-------------------
		$sql = "SELECT * FROM  `tools_plan`  WHERE id = $fid";
		$query = $this->db->query($sql);
		$old_data['plan'] = $query->row_array();
		$sql = "SELECT * FROM `tools_plan_task` WHERE fid = $fid";
		$query = $this->db->query($sql);
		$old_data['list'] = $query->result_array();
		in_log('tools',array('tid'=>$fid,'ttype'=>'plan','title'=>'更新计划','contents'=>'更新计划','old_data'=>serialize($old_data)));
		//-------------------
		
		//更新plan
		$sql = "UPDATE `tools_plan` SET bname = '".$plan['bname']."',begintime='".$plan['begintime']."',endtime='".$plan['endtime']."',exceptdays='".json_encode($plan['exceptdays'])."' WHERE id = $fid";
		$this->db->query($sql);
		//更新Task
		$sql = "UPDATE `tools_plan_task` SET is_del = '1' WHERE fid = $fid";
		$this->db->query($sql);
		for($i=1;$i<count($task['id']);$i++){
			if($task['id'][$i]){
				$sql = "UPDATE `tools_plan_task` SET is_del = 0, 
						title = '".$task['title'][$i]."'
						,describ='".$task['describ'][$i]."'
						,owner='".$task['owner'][$i]."'
						,pdays='".$task['pdays'][$i]."'
						,expstrt='".$task['expstrt'][$i]."'
						,expendt='".$task['expendt'][$i]."'
				WHERE id = '".$task['id'][$i]."'";
			}else{
				$sql = "INSERT INTO `tools_plan_task` (fid,title,describ,owner,pdays,expstrt,expendt) VALUES ";
				$sql.="('".$fid."','".$task['title'][$i]."','".$task['describ'][$i]."','".$task['owner'][$i]."','".$task['pdays'][$i]."','".$task['expstrt'][$i]."','".$task['expendt'][$i]."')";
			}
			$this->db->query($sql);
		}
		//更新Milestone
		$sql = "UPDATE `tools_plan_milestone` SET is_del = '1' WHERE fid = $fid";
		//print_r($milestone);
		$this->db->query($sql);
		for($i=1;$i<count($milestone['id']);$i++){
			if($milestone['id'][$i]){
				$sql = "UPDATE `tools_plan_milestone` SET is_del = 0,
						title = '".$milestone['title'][$i]."'
						,describ='".$milestone['describ'][$i]."'
						,timepoint='".$milestone['timepoint'][$i]."'
				WHERE id = '".$milestone['id'][$i]."'";
			}else{
				$sql = "INSERT INTO `tools_plan_milestone` (fid,title,describ,timepoint) VALUES ";
				$sql.="('".$fid."','".$milestone['title'][$i]."','".$milestone['describ'][$i]."','".$milestone['timepoint'][$i]."')";
			}
			//echo $sql;die;
			$this->db->query($sql);
			//echo $sql;
		}
	
	}

}

