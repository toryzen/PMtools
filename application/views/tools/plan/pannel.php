  <?php $this->load->view('rbac_head');?>
  <!-- CUSTUM CSS -->
  <style>
    	body{font-size:12px;}
		.gante table{border-collapse:collapse;font-size:12px;}  
		.gante td{border:1px red solid;width:20px;height:5px;} 
  </style>
    
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h2  style="margin-top:-30px"><?php echo $plan['bname']; ?> <a class="btn btn-default pull-right" href="<?php echo base_url("index.php/tools/plan/edit?dwz=").$plan['dwz']; ?>">修改资料</a></h2>
        <p class="lead">开始:<?php echo $plan['begintime']; ?> 结束:<?php echo $plan['endtime']; ?> 排除:<small><?php if(is_array($plan['exceptdays'])){foreach($plan['exceptdays'] as $l){ @$exl.= substr($l,5,5)."/"; }echo substr($exl,0,-1);}else{echo "无" ;} ?></small></p>
        
      </div>

      <h3>详情</h3>
      
      <div>
            <table class="table">
              <thead>
                <tr>
                  <th>名称</th>
                  <th>描述</th>
                  <th>参与(数/人)</th>
                  <th>人天</th>
              	  <th>预计开始</th>
              	  <th>预计结束</th>
                </tr>
              </thead>
              <tbody>
                <?php if($tm){foreach($tm as $t): if($t['type']=='task'):?>
                <tr>
                  <td><?php echo $t['title']; ?></td>
                  <td><?php echo $t['describ']; ?></td>
                  <td><?php echo $t['owner']; ?></td>
                  <td><?php echo $t['pdays']; ?></td>
                  <td><?php echo $t['expstrt']; ?></td>
                  <td><?php echo $t['expendt']; ?></td>
                </tr>
                <?php else:?>
                <tr class="warning">
                  <td colspan="7">
                   <div class="row">
                  	<div class="col-md-2"><b>名称：</b><?php echo $t['title']; ?> </div>
                  	<div class="col-md-6"><b>描述:</b><?php echo $t['describ']; ?></div>
                  	<div class="col-md-2"><b>时间点:</b><?php echo $t['timepoint']; ?></div>
                  	<div class="col-md-2"><span class="pull-right glyphicon glyphicon-star"></span></div>
                  </div>
                  </td>
                </tr>
                <?php endif; endforeach;}?>
              </tbody>
            </table>
        
       </div>
       <hr/>
       <h3>甘特图</h3>
       <div class="gante"  style="width:100%;overflow-x:auto;overflow-y:hidden;">
       
       <table>
		    <tr>
		    	<td>名称</td>
		        <?php
		        for($i=strtotime($plan['pic_start']);$i<strtotime($plan['pic_end']);$i=$i+86400){
		            if(date('w',$i) == 1){
		                echo "<td colspan='7'>".date('m-d',$i)."</td>";
		            }
		        }
		        ?>
		    </tr>
		    <tr>
		    	<td>星期</td>
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
		    <?php if($tm):foreach($tm as $t):?>
			    <tr>
			    	<?php echo '<tr class="popups" data-placement="bottom" data-toggle="tooltip" data-original-title="'.$t['describ'].'['.$t['owner'].']('.$t['expendt'].')">';?>
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
								echo "<td $except><div style='background-color:red;height:10px;'>&nbsp;</div></td>";
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
		    <?php endforeach; endif;?>
		</table>
       
       	
       </div>
       <hr/>
       
       <div class="pull-right">只读地址：<input class="readurl" type="text" value="<?php  echo base_url("index.php/tools/plan/pannel?rldwz=").$plan['rldwz']; ?>" style="width:400px;"  />
	   </div>

    </div> <!-- /container -->
    <br/><br/>
    
    <script>
    $('.popups').tooltip();
    </script>
  </body>
</html>