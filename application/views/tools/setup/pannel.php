<?php $this->load->view('rbac_head');?>
  
  <div class="container">
      <form action="" method="post">
      <div class="page-header">
        <h2 style="margin-top:-30px"><?php echo $bname;?> <a class="btn btn-default pull-right" href="<?php echo base_url("index.php/tools/setup/edit?dwz=").$dwz; ?>">修改资料</a></h2>
      </div>
		
      <h3>项目概述</h3>
      <div>
      	<?php echo $describ;?>
      <hr/>
      
      <h3>项目背景</h3>
      <div>
      	<?php echo $background;?>
      <hr/>
      
      <h3>项目需求</h3>
      <p></p>
      <div>
        <?php echo $demand;?>
      </div>
      <hr/>
      
      <h3>项目意义</h3>
      <div>
      	<?php echo $meaning;?>
      <hr/>
      <?php if($other):?>
      <h3>补充资料</h3>
      <div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:20%;">名称</th>
              <th style="width:75%;">内容</th>
            </tr>
          </thead>
          <tbody>
          	<?php for($i=0;$i<count($other['name']);$i++ ):?>
            <tr>
              <td><?php echo $other['name'][$i+1];?></td>
              <td><?php echo $other['value'][$i+1];?></td>
            </tr>
            <?php endfor;?>
          </tbody>
        </table>
      </div>
      <?php endif;?>
      <hr/>
      <div class="pull-right">只读地址：<input class="readurl" type="text" value="<?php  echo base_url("index.php/tools/setup/pannel?rldwz=").$rldwz; ?>" style="width:400px;"  />
    <br/><br/>
    </div> <!-- /container -->
  </body>
</html>