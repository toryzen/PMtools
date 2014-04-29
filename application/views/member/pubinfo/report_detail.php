
  <!-- CUSTUM CSS -->
  <style>
    	body{font-size:12px;}
		.gante table{border-collapse:collapse;font-size:12px;}  
		.gante td{border:1px red solid;width:5px;height:5px;} 
		.gante_green table{border-collapse:collapse;font-size:12px;}  
		.gante_green td{border:1px green solid;width:5px;height:5px;}
		.green_background{background-color:#E1F281}
		.over_background{background-color:#F6B47E}
  </style>
  
<div class="well well-sm">
    <h4 style="display:inline"><?php echo $report['start_day']."至".$report['end_day']; ?>报告</h4>
    <div class="btn-group pull-right" style="top:-7px;">
	  <?php foreach($pname_list as $pl):?>
	  <a href="<?php echo base_url('index.php/member/pubinfo/report_detail/')."/".$rid."/".$pl['pid']?>" class="btn btn-default"><?php echo $pl['pname'];?></a>
	  <?php endforeach;?>
	</div>
    
</div>
  
  <div class="container">
  	   <?php if($project):?>
  	   <h4>项目信息</h4>
  	   <table class="table well well-sm">
  	   	<thead>
	  	   	<tr>
	  	   		<th>项目名</th>
	  	   		<th>优先级</th>
	  	   		<th>预计开始</th>
	  	   		<th>预计结束</th>
	  	   		<th>介绍</th>
	  	   		<th>负责</th>
	  	   		<th>敏捷</th>
	  	   		<th>需求</th>
	  	   		<th>成员</th>
	  	   	</tr>
  	   	</thead>
  	   	<tbody>
  	   		<tr>
  	   			<td><?php echo $project['pname'];?></td>
	  	   		<td><?php echo $project['priority'];?></td>
	  	   		<td><?php echo $project['plan_start'];?></td>
	  	   		<td><?php echo $project['plan_end'];?></td>
	  	   		<td><?php echo $project['describ'];?></td>
	  	   		<td><?php echo $project['manager'];?></td>
	  	   		<td><?php echo $project['scrummaster'];?></td>
	  	   		<td><?php echo $project['demander'];?></td>
	  	   		<td><?php echo $project['member'];?></td>
  	   		</tr>
  	   	</tbody>
  	   </table>
       <div class="well well-sm">
       <h4>项目计划</h4>
       <?php if($tm):?>
       <div class="gante_green pull-left">
       <table>
		    <tr>
		    	<td>名称</td>
		    	<td style="width:200px;">描述</td>
		    	<td style="width:50px;">所有</td>
		    	<td style="width:30px;">工作</td>
		    	<td style="width:40px;">预计</td>
		    </tr>
		    <?php foreach($tm as $t):?>
		    <tr class="<?php if($t['timepoint']>=$report['start_day'] && $t['timepoint']<=$report['end_day']){echo "green_background";} ?>" <?php if($t['type']=='task'){?> onmouseover="show_pops(<?php echo $t['id']; ?>)" onmouseout="show_pops(<?php echo $t['id']; ?>)" <?php } ?>>
		    	<td><?php echo $t['title'];?> </td>
		    	<td><?php echo $t['describ'];?> </td>
		    	<td><?php echo $t['owner'];?> </td>
		    	<td><?php echo $t['pdays'];?> </td>
		    	<td><?php echo date('m/d',strtotime($t['timepoint']));?> </td>
		    </tr>
			<?php endforeach;?>
		</table>
       </div>
       
       <div class="gante pull-left"  style="margin-left:20px;overflow-x:auto;overflow-y:hidden;">
       
       <table>
		    <tr>
		    	<td rowspan="2">名称</td>
		        <?php
		        for($i=strtotime($plan['pic_start']);$i<strtotime($plan['pic_end']);$i=$i+86400){
		            if(date('w',$i) == 1){
		                echo "<td colspan='7'>".date('m-d',$i)."</td>";
		            }
		        }
		        ?>
		    </tr>
		    <tr>
		        <?php
		        for($i=strtotime($plan['pic_start']);$i<strtotime($plan['pic_end']);$i=$i+86400){
					if(in_array(date("Y-m-d",$i),$plan['exceptdays'])){
						$except = " style='background-color:gray;' ";
					}else{
						$except = "";
					}
		            echo "<td $except>".(date("w",$i)==0?7:date("w",$i))."</td>";
		        }
		        ?>
		    </tr>
		    <?php foreach($tm as $t):?>
			    	<tr class="popups  <?php if($t['timepoint']>=$report['start_day'] && $t['timepoint']<=$report['end_day']){echo "green_background";} ?>" id="popups_<?php echo $t['id']; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo $t['describ'].'['.$t['owner'].']('.$t['expendt'].')'; ?>">
			    	<td><?php echo $t['title'];?> </td>
			        <?php
			        for($i=strtotime($plan['pic_start']);$i<strtotime($plan['pic_end']);$i=$i+86400){
						if(in_array(date("Y-m-d",$i),$plan['exceptdays'])){
							$except = " style='background-color:gray;' ";
						}else{
							$except = "";
						}
						if($t['type']=='task'){
							if(strtotime($t['expstrt'])<=$i&&strtotime($t['expendt'])>=$i){
								echo "<td $except><div style='background-color:red;height:10px;' ></div></td>";
							}else{
								echo "<td $except>&nbsp;</td>";
							}
						}else{
							if(strtotime($t['timepoint'])==$i){
								echo "<td $except><div style='background-color:green;height:10px;'>&nbsp;</div></td>";
							}else{
								echo "<td $except>&nbsp;</td>";
							}
						}
			        }
			        ?>
			    </tr>
		    <?php endforeach; ?>
		</table>
       
       </div>
       <br style="clear:both">
       
       <?php else:?>
       <div class="alert alert-danger" style="width:99%;text-align:center">暂无计划</div>
       <?php endif;?>
       </div>
       <?php else:?>
       	<div class="alert alert-success" style="width:99%;text-align:center">请选择项目报告！</div>
       <?php endif;?>
    </div> <!-- /container -->
    <span class="pull-right"><small>双击页面空白处隐藏左侧导航</small></span>
    <br/><br/>
    <script>
    $(function(){
    	leftmenutoggle();
    });
    function show_pops(id){
    	$('#popups_'+id).tooltip('toggle');
    	if($('#popups_'+id).hasClass('over_background')){
        	$('#popups_'+id).removeClass('over_background');
        }else{
        	$('#popups_'+id).addClass('over_background');
        }
    }
    $('.popups').tooltip();
    </script>
  </body>
</html>