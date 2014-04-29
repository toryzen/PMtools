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
		<div class="row">
        <div class="col-md-12 well well-sm" style="overflow-x:auto;overflow-y:hidden;">
            <table class="table">
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
                  <td class="danger"><?php echo $tlist['jx_time']; ?></td>
                  <td class="danger"><?php echo $tlist['getpoint']; ?></td>
                  <td class="danger"><?php echo $tlist['leftwork']; ?></td>
                  <td class="danger"><?php echo $tlist['delayday']; ?></td>
                  <td class="warning"><?php echo $tlist['jx_char']; ?></td>
                  <td class="warning"><?php echo $tlist['jx_point']; ?></b></td>
                </tr>
                <?php  endforeach;}?>
              </tbody>
            </table>
          </div>
        </div>
       <hr/>
       
       <h3>人员绩效</h3>
	   <table class="table well well-sm">
	   	<thead>
	   		<th>绩效月</th>
	   		<th>姓名</th>
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
    <script>
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
		reget_jx();
	});
	</script>
  </body>
</html>