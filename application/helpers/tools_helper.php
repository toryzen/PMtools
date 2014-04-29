<?php
//短网址
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
//是否已记录至仓库
function if_depot($dtype,$ctype,$keys){
	$obj = &get_instance();
	$obj->load->model("member_depot_model");
	return $obj->member_depot_model->if_depot($_SESSION[$obj->config->item('rbac_auth_key')]["INFO"]["id"],$dtype,$ctype,$keys);
}