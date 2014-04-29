  <?php $this->load->view('rbac_head');?>
  
  <!-- CUSTUM CSS -->
  <style>
    	body{font-size:12px;}
		.gante table{border-collapse:collapse;font-size:12px;}  
		.gante td{border:1px red solid;} 
    </style>
    
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h2  style="margin-top:-30px"><?php echo $info['bname']; ?> <a class="btn btn-default pull-right" href="<?php echo base_url("index.php/tools/meeting/edit?dwz=").$info['dwz']; ?>">修改资料</a></h2>
        
      </div>

      <h3>会议列表</h3>
      
      <div>
            <table class="table">
              <thead>
                <tr>
                    <th style="width:15%;">名称</th>
		              <th style="width:20%;">时间</th>
		              <th style="width:10%;">参会人员</th>
		              <th style="width:25%;">会议内容</th>
		              <th style="width:30%;">会议纪要</th>
                </tr>
              </thead>
              <tbody>
                <?php if($metting){foreach($metting as $t): ?>
                <tr>
                  <td><?php echo $t['mname']; ?></td>
                  <td><?php echo $t['begintime']; ?></td>
                  <td><?php echo str_replace("<br/>","\n",$t['people']); ?></td>
                  <td><?php echo str_replace("<br/>","\n",$t['info']); ?></td>
                  <td><?php echo str_replace("<br/>","\n",$t['memo']); ?></td>
                </tr>
                <?php endforeach;}?>
              </tbody>
            </table> 
        
       </div>
       <hr/>
       
       <div class="pull-right">只读地址：<input class="readurl" type="text" value="<?php  echo base_url("index.php/tools/meeting/pannel?rldwz=").$info['rldwz']; ?>" style="width:400px;"  />
	   </div>

    </div> <!-- /container -->
    <br/><br/>
    
    
  </body>
</html>