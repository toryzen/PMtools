  <?php $this->load->view('rbac_head');?>
    
  <div class="container">
      <div class="page-header">
        <h2  style="margin-top:-30px"><?php echo $docs['bname'];?> - 文件夹</h2>
      </div>
		
      <h3>文档列表</h3>
      <div>
      	<table class="table">
              <thead>
                <tr>
                  <th>名称</th>
                  <th>类型</th>
                  <th>大小</th>
                  <th>上传时间</th>
              	  <th>操作</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($list as $l):?>
              <tr>
              	<td><?php echo $l['fname']; ?></td>
              	<td><?php echo $l['ftype']; ?></td>
              	<td><?php echo $l['fsize']; ?></td>
              	<td><?php echo $l['updatetime']; ?></td>
              	<td>
              		<a class="btn btn-primary btn-xs" href="<?php echo base_url("index.php/tools/docs/download?rldwz=").$docs['rldwz']."&id=".$l['id']; ?>">下载</a>
              	</td>
              </tr>
              <?php endforeach;?>
           	  </tbody>
          </table>
      </div>

      <hr/>
      
    <br/><br/>
    </div> <!-- /container -->
    
    

  </body>
</html>