  <?php $this->load->view('rbac_head');?>
  
  <!-- CUSTUM CSS -->
  <style>
    	body{font-size:12px;}
        table thead tr th{white-space:nowrap;}
        table tbody tr td{white-space:nowrap;}
  </style>
    
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h2 style="margin-top:-30px"><?php echo $borad['bname']; ?></h2>
        <p class="lead">开始:<?php echo $borad['begintime']; ?> 结束:<?php echo $borad['endtime']; ?> 排除:<?php if(is_array($borad['exceptdays'])){foreach($borad['exceptdays'] as $l){ @$exl.= $l."/"; }echo substr($exl,0,-1);}else{echo "无" ;} ?></p>
        
      </div>

      <h3>任务详情</h3>
      
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
	                  	foreach($time as $use_time){
	                  		echo "<th>".$use_time."</th>";
	                  	}
                  	}
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php if($task){foreach($task as $tlist): ?>
                <tr class="<?php if($tlist['workload'][end($time)]=="0")echo "success"; ?>">
                  <td><?php echo $tlist['story']; ?></td>
                  <td><?php echo $tlist['owner']; ?></td>
                  <td><?php echo date("m-d",strtotime($tlist['expendt'])); ?></td>
                  <?php 
                  	  if($time){
		                  foreach($time as $use_time){
		                  	echo '<td>'.$tlist['workload'][$use_time].'</td>';
		                  }
	                  }
                  ?>
                </tr>
                <?php  endforeach;}?>
              </tbody>
              <tbody>
                <tr>
              	  <td colspan="3"><span class="pull-right">剩余工作量</span></td>
				  <?php 
                  	  if($time){
						  for($i=0;$i<count($time);$i++){
						  	echo '<td class="left_'.$i.'"></td>';
						  }
	                  }
                  ?>
              	</tr>
              	<tr>
              	  <td colspan="3"><span class="pull-right">预计燃尽轨道</span></td>
				  <?php 
                  	  if($time){
		                  for($i=0;$i<count($time);$i++){
							echo '<td class="locus_'.$i.'"></td>';
						}
	                  }
                  ?>
              	</tr>
              </tbody>
            </table>
        </div>
       </div>
        <hr/>
        <h3>燃尽图</h3>
        <div class="row" >
	        <div class="col-md-12">
	          <div id="burnchart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	        </div>
       </div>
       </form>
    </div> <!-- /container -->
    <br/><br/>
    <script src="<?php echo base_url();?>static/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url();?>static/highcharts/modules/exporting.js"></script>
    <script type="text/javascript">
    	$(function () {
    		redrag();
        });
        
	  	function redrag(){
	  		$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/tools/tasks/burnpic"); ?>",
		        data: {'dwz':'<?php echo $borad['dwz']; ?>'},
		        success: function(data) {
		        	var tdata = data.split("|");
		        	var left  = tdata[0].split(",");
		        	for(i=0;i<left.length;i=i+1){
						$('.left_'+i).html(left[i]);
				    }
		        	var locus = tdata[1].split(",");
		        	for(j=0;j<locus.length;j=j+1){
						$('.locus_'+j).html(locus[j]);
				    }
	        	    drag(eval("["+tdata[0]+"]"),eval("["+tdata[1]+"]"));
		        }
		    });
	  	}
	    function drag( left_work, remind_work){
	           $('#burnchart').highcharts({
	              title: {
	                  text: '',
	                  x: -20
	              },
	              xAxis: {
	                  categories: [<?php if($time){foreach($time as $use_time){@$carlist .= "'".$use_time."',";}@$carlist = substr($carlist,0,-1);echo str_replace("-","",$carlist);}?>]
	              },
	              yAxis: {
	                  title: {
	                      text: ''
	                  },
	                  plotLines: [{
	                      value: 0,
	                      width: 1,
	                      color: '#808080'
	                  }]
	              },
	              tooltip: {
	                  valueSuffix: ''
	              },
	              legend: {
	                  layout: 'vertical',
	                  align: 'right',
	                  verticalAlign: 'middle',
	                  borderWidth: 0
	              },
	              series: [{
	                  name: '剩余',
	                  data: left_work
	              }, {
	                  name: '轨迹',
	                  data: remind_work
	              }]
	          });
	           
	      }
	     
		</script>
  </body>
</html>