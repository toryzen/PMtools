<?php

/**
 * 
 */
class Tools_task_model extends CI_Model {

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
		$sql = "SELECT id FROM `tools_tasks` WHERE $where LIMIT 1";
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
	public function insert_data($borad,$task){
		//插入borad
		$dwz = dwz(md5(uniqid()));
		$rldwz = dwz($dwz);
		$sql = "INSERT INTO `tools_tasks` (bname,begintime,endtime,exceptdays,dwz,rldwz) 
				VALUES('".$borad['bname']."','".$borad['begintime']."','".$borad['endtime']."','".json_encode($borad['exceptdays'])."','".$dwz."','".$rldwz."')";
		$this->db->query($sql);
		$fid = $this->db->insert_id();
		//插入task
		$sql = "INSERT INTO `tools_tasks_list` (fid,story,owner,expendt,workload) VALUES ";
		for($tmp_time = date("Y-m-d",strtotime($borad['begintime']));$tmp_time<=$borad['endtime'];$tmp_time = date("Y-m-d",strtotime("+1 day",strtotime($tmp_time))) ){
			if(!in_array($tmp_time,$borad['exceptdays'])){
				$workload[date("m-d",strtotime($tmp_time))] = "";
			}
		}
		$workload = json_encode($workload);
		for($i=1;$i<count($task['story']);$i++){
			$sql.="('".$fid."','".$task['story'][$i]."','".$task['owner'][$i]."','".$task['expendt'][$i]."','".$workload."'),";
		}
		$sql = substr($sql, 0,-1);
		$this->db->query($sql);
		
		
		in_depot('tasks',$dwz,$borad['bname']);
		
		//--------------------
		in_log('tools',array('tid'=>$fid,'ttype'=>'plan','title'=>'新建','contents'=>'新建任务工具('.$borad['bname'].')','old_data'=>''));
		//--------------------
		
		return $dwz;
	}
	/**
	 * 获取面板与任务数据
	 * @param int $fid
	 * @return Ambigous <string, unknown, void, unknown>
	 */
	public function get_info($fid){
		$sql = "SELECT * FROM `tools_tasks` WHERE id = '$fid' LIMIT 1";
		
		$query = $this->db->query($sql);
		$reuslt['borad']  = $query->row_array();
		
		$reuslt['borad']['exceptdays'] = json_decode($reuslt['borad']['exceptdays'],TRUE);
		$sql = "SELECT * FROM `tools_tasks_list` WHERE fid = '$fid' AND is_del = 0";
		$query = $this->db->query($sql);
		$reuslt['task'] = $query->result_array();
		
		if($reuslt['task']){
			foreach($reuslt['task'] as &$vo){
				$vo['workload'] = json_decode($vo['workload'],TRUE);
				
			}
		}
		for($tmp_time = date("Y-m-d",strtotime($reuslt['borad']['begintime']));$tmp_time<=$reuslt['borad']['endtime'];$tmp_time = date("Y-m-d",strtotime("+1 day",strtotime($tmp_time))) ){
			if(@!in_array($tmp_time,$reuslt['borad']['exceptdays'])){
				$reuslt['time'][] = date("m-d",strtotime($tmp_time));
			}
				
		}
        $reuslt['bname'] = $reuslt['borad']['bname'];
		return $reuslt;
	}
	
	/**
	 * 更新面板与任务数据
	 * @param int $fid
	 * @param string $borad
	 * @param string $task
	 */
	public function update_data($fid,$borad,$task){
		
		//-------------------
		$sql = "SELECT * FROM  `tools_tasks`  WHERE id = $fid";
		$query = $this->db->query($sql);
		$old_data['tasks'] = $query->row_array();
		$sql = "SELECT * FROM `tools_tasks_list` WHERE fid = $fid";
		$query = $this->db->query($sql);
		$old_data['list'] = $query->result_array();
		in_log('tools',array('tid'=>$fid,'ttype'=>'tasks','title'=>'更新任务','contents'=>'更新面板与任务数据','old_data'=>serialize($old_data)));
		//-------------------
		
		//print_r($task);die();
		//更新Borad
		$sql = "UPDATE `tools_tasks` SET bname = '".$borad['bname']."',begintime='".$borad['begintime']."',endtime='".$borad['endtime']."',exceptdays='".json_encode($borad['exceptdays'])."' WHERE id = $fid";
		$this->db->query($sql);
		//更新Task
		$sql = "UPDATE `tools_tasks_list` SET is_del = '1' WHERE fid = $fid";
		$this->db->query($sql);
		for($tmp_time = date("Y-m-d",strtotime($borad['begintime']));$tmp_time<=$borad['endtime'];$tmp_time = date("Y-m-d",strtotime("+1 day",strtotime($tmp_time))) ){
			if(@!in_array($tmp_time,$borad['exceptdays'])){
				$workload[date("m-d",strtotime($tmp_time))] = "";
			}
		}
		for($i=1;$i<count($task['story']);$i++){
			if($task['id'][$i]){
				$wk = array();$sourcewl=array();
				$sourcewl = json_decode($task['workload'][$i],TRUE);
				foreach($workload as $key=>$twk){
					$wk[$key] = $sourcewl[$key]!=""?$sourcewl[$key]:"";
				}
				$wk = json_encode($wk);
				$sql = "UPDATE `tools_tasks_list` SET is_del = 0, story = '".$task['story'][$i]."',owner='".$task['owner'][$i]."',expendt='".$task['expendt'][$i]."',workload='$wk' WHERE id = '".$task['id'][$i]."'";
				//echo $sql;
			}else{
				$sql = "INSERT INTO `tools_tasks_list` (fid,story,owner,expendt,workload) VALUES ('".$fid."','".$task['story'][$i]."','".$task['owner'][$i]."','".$task['expendt'][$i]."','".$workload."')";
			}
			$this->db->query($sql);
		}
		
	}
	
	
	
	/**
	 * 更新任务剩余工作量
	 * @param unknown $tid
	 * @param unknown $tdate
	 * @param unknown $dwz
	 * @param unknown $val
	 * @return boolean|string
	 */
	public function update_task($tid,$tdate,$dwz,$val){
		$sql = "SELECT id,workload,fid FROM `tools_tasks_list` WHERE id = '{$tid}'";
		$query = $this->db->query($sql);
		$tdata  = $query->row_array();
		
		
		//-------------------
		$old_data = $tdata;
		in_log('tools',array('tid'=>$tdata['fid'],'ttype'=>'tasks','title'=>'更新任务剩余工作量','contents'=>'任务ID:'.$tid.';时间:'.$tdate.';剩余:'.$val,'old_data'=>serialize($old_data)));
		//-------------------
		
		//$tdata = $this->fetch_one($sql);
		if($this->get_id($dwz,'dwz')==$tdata['fid']){
			if($tdata['id']>0){
				$workload = json_decode($tdata['workload'],true);
				$workload[$tdate] = $val;
				$workload = json_encode($workload);
				$sql = "UPDATE `tools_tasks_list` SET workload = '{$workload}' WHERE id = '{$tid}'";
				$this->db->query($sql);
				return TRUE;
			}else{
				return "故事不存在！";
			}
		}else{
			return "故事不存在！";
		}
	}
	
	/**
	 * 获取燃尽数据
	 * @param unknown $fid
	 * @return number
	 */
	public function picdate($fid){
		$sql = "SELECT workload FROM `tools_tasks_list` WHERE fid = '{$fid}' AND is_del = 0";
		$query = $this->db->query($sql);
		$tdata  = $query->result_array();
		
		if($tdata){
			foreach($tdata as $vo){
				$workload = json_decode($vo['workload'],true);
				if($workload){
					foreach($workload as $key=>$tvo){
						$return[$key] = $return[$key]+$tvo;
					}
				}
				
			}
		}
		return $return;
	}

}

