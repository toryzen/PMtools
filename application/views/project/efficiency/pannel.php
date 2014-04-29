  <?php $this->load->view('head');?>
  
  <!-- CUSTUM CSS -->
  <style>
    	body{font-size:12px;}
  </style>
    
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h2 style="margin-top:-30px;">绩效评分【<?php echo $borad['bname']; ?>】</h2>
      </div>
	  
	   
      <h3>任务信息</h3>
      

            <table class="table well well-sm">
              <thead>
                <tr>
                  <th>故事/任务名称</th>
                  <th>所有者</th>
                  <th>预计完成</th>
                  <?php 
                  	if($time){
						$i=0;
	                  	foreach($time as $use_time){
	                  		echo "<th class='".($i==0?'danger':'')."'>".$use_time."</th>";
	                  		$i++;
	                  	}
                  	}
                  ?>
                  <th class="danger">绩效月</th>
                  <th class="danger">得人分</th>
                  <th class="danger">剩</th>
                  <th class="danger">延</th>
                  <th>操作</th>
                  <th class="warning">公式</th>
                  <th class="warning">得分</th>
                </tr>
              </thead>
              <tbody>
                <?php if($task){foreach($task as $tlist): ?>
                <tr <?php if($tlist['jx_time'])echo "class='success'"; ?>>
                  <td><?php echo $tlist['story']; ?></td>
                  <td><?php echo $tlist['owner']; ?></td>
                  <td><?php echo date("m-d",strtotime($tlist['expendt'])); ?></td>
                  <?php 
                  	  if($time){
						  $i=0;
		                  foreach($time as $use_time){
		                  	echo '<td class="'.($i==0?'danger workload_'.$tlist['id']:'').'" >'.$tlist['workload'][$use_time].'</td>';
		                  	$i++;
						}
	                  }
                  ?>
                  <td class="danger"><input class="jx_time_<?php echo $tlist['id']; ?>" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM'})" style='width:50px;' value="<?php echo $tlist['jx_time']; ?>"/></td>
                  <td class="danger"><input class="getpoint_<?php echo $tlist['id']; ?>" name="getpoint_<?php echo $tlist['id']; ?>" pubtype="people" type="text" value="<?php echo $tlist['getpoint']; ?>" /></td>
                  <td class="danger"><input class="leftwork_<?php echo $tlist['id']; ?>" type="text" style="width:30px;" value="<?php echo $tlist['leftwork']; ?>" /></td>
                  <td class="danger"><input class="delayday_<?php echo $tlist['id']; ?>" type="text"  style="width:30px;" value="<?php echo $tlist['delayday']; ?>" /></td>
                  <td><a onclick="set_point(this,<?php echo $tlist['id']; ?>);" class="btn btn-success btn-xs" >确定</a></td>
                  <td class="warning"><span class="jx_char_<?php echo $tlist['id']; ?>"><?php echo $tlist['jx_char']; ?></span></td>
                  <td class="warning"><b class="jx_point_<?php echo $tlist['id']; ?>"><?php echo $tlist['jx_point']; ?></b></td>
                </tr>
                <?php  endforeach;}?>
              </tbody>
            </table>
       <hr/>
       
       <h3>人员绩效</h3>
	   <table class="table well well-sm">
	   	<thead>
	   		<th>绩效月</th>
	   		<th>姓名</th>
	   		<th>任务数</th>
	   		<th>本阶段累计得分</th>
	   	</thead>
	   	<tbody class="jx_tbody"></tbody>
	   </table>
	   
	   <h3>绩效公式</h3>
	   <table class="table well well-sm">
        <tr>
        	<td>
        		<h4>公式</h4>
	   			(工作量-剩余工作量)-(((工作量-剩余工作量))*(atan(超期天数)/(pi()/2)))
	   			<h4>解释</h4>
	   			当工作没有剩余工作量且按时完成时，将获得全部的任务分数<br/>
	   			当工作没有剩余工作量但没有按时完成时，将按超期天数按比例减分(详见右表)<br/>
	   			当工作按时完成但有剩余工作量时，将获得所做的工作量等同的任务分数<br/>
	   			当工作没有按时完成，且有剩余工作量时，将获得所做的工作量等同的任务分数且按超期比例减分的分数(详见右表)
	   			<h4>其他</h4>
	   			项目成员每完成一项任务，项目负责人将获得其1/5等同的任务分数
	   		</td>
        <td>
        	<img src="<?php echo base_url()."static/image/percent.png" ;?>" />
        </td>
        </tr>
       </table>
	   
    </div> <!-- /container -->
    <br/><br/>
    <script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
	<script>
	function set_point(obj,id){
		var workload = $('.workload_'+id).html();
		var getpoint = $('.getpoint_'+id).val();
		var leftwork = $('.leftwork_'+id).val();
		var delayday = $('.delayday_'+id).val();
		var jx_time = $('.jx_time_'+id).val();
		if(getpoint && leftwork && delayday){
			if(workload<leftwork){
				alert('剩余工作量不得大于实际工作量不符！');
				return;
			}
			if(!jx_time){
				alert('绩效月不能为空！');
				return;
			}
			//var jx_char = "("+workload+"-"+leftwork+")/"+delayday;
			//var jx_char = "("+workload+"-"+leftwork+")-(("+workload+"-"+leftwork+")*(Math.atan("+delayday+")/(Math.PI/2)))";
			$.ajax({
				'type':'POST',
				'url':'<?php echo base_url("index.php/project/efficiency/insert_jx/")."/".$pid."/".$fid;?>',
				'data':{'task':id,'workload':workload,'getpoint':getpoint,'leftwork':leftwork,'delayday':delayday,'jx_time':jx_time},
				success :function(data){
					var re = data.split("|");
					//alert(data);
					if(re[0]=='ok'){
						//var jx_poin = Math.round(eval(jx_char),2);
						
						$('.jx_char_'+id).html(re[1]);
						$('.jx_point_'+id).html(re[2]);
						$(obj).parent().parent().addClass('success');
						reget_jx();
					}else{
						alert(data);
					}
				}
			});
			
		}else{
			alert('资料填写不全！请重试！');
		}
	}
	function reget_jx(){
		$.ajax({
			'type':'GET',
			'url':'<?php echo base_url("index.php/project/efficiency/get_jx_table/".$pid."/".$fid);?>',
			success:function(jx_tbody){
				$('.jx_tbody').html(jx_tbody);
			}
		});
	}
	$(function(){
		set_userlist("<?php echo base_url("index.php/pubinfo/userlist");?>");
		$(".chosen_select").chosen({width: "20%"});
		reget_jx();
	});
	</script>
  </body>
</html>