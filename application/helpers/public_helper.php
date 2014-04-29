<?php

//加密KEY
if(!function_exists("dwz")){
	function dwz($url){
		$code = sprintf('%u', crc32($url));
		$surl = '';
		while($code){
			$mod = $code % 62;
			if($mod>9 && $mod<=35){
				$mod = chr($mod + 55);
			}elseif($mod>35){
				$mod = chr($mod + 61);
			}
			$surl .= $mod;
			$code = floor($code/62);
		}
		return $surl;
	}
}

//二维数组排序
if(!function_exists("array_sort")){
	function array_sort($arr,$keys,$type='asc'){
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
		}
		return $new_array;
	}
}
if(!function_exists("getIP")){
	function getIP()
	{
		if (getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if(getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if(getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
		else $ip = "Unknow";
		return $ip;
	}
}
//是否已记录至仓库
function if_depot($dtype,$ctype,$keys){
	$obj = &get_instance();
	$obj->load->model("member_depot_model");
	//echo rbac_conf(array('INFO','id'));
	return $obj->member_depot_model->if_depot(rbac_conf(array('INFO','id')),$dtype,$ctype,$keys);
}


//记录至仓库
function in_depot($dtype,$keys,$dname){
	$obj = &get_instance();
	$obj->load->model("member_depot_model");
	$uid = rbac_conf(array('INFO','id'));
	if($uid){
		$obj->member_depot_model->set_depot($uid,'add',$dtype,'dwz',$keys,$dname);
	}
}

//日志记录
function in_log($type="tools",$param){
	$obj      = &get_instance();
	$obj->load->model("system_log_model");
	$obj->system_log_model->$type($param);

}