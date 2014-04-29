  <?php $this->load->view('rbac_head');?>
  
  <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/dropzone/css/dropzone.css"/>
  <div class="container" >
      <div class="page-header">
        <h2 style="margin-top:-30px"><?php echo $docs['bname'];?> - 文件夹 <a class="btn btn-default pull-right" href="<?php echo base_url("index.php/tools/docs/edit?dwz=").$docs['dwz']; ?>">修改资料</a></h2>
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
  					<button type="button" class="btn btn-danger btn-xs" onclick="del_file(this,<?php echo $l['id']; ?>)">删除</button>
              	</td>
              </tr>
              <?php endforeach;?>
           	  </tbody>
          </table>
      </div>
      <hr/>
      
      <h3>文档上传</h3>
      <div style="background-color:gray">
      	<form  id="my-awesome-dropzone" action="<?php echo base_url("index.php/tools/docs/upload?rldwz=").$docs['rldwz']; ?>" class="dropzone" id="my-awesome-dropzone">
      	  <div class="fallback">
		    <input name="file" type="file" multiple />
		  </div>
      	</form>
      </div>
      
      <hr/>
      <div class="pull-right">只读地址：<input class="readurl" type="text" value="<?php  echo base_url("index.php/tools/docs/pannel?rldwz=").$docs['rldwz']; ?>" style="width:400px;"  />
    <br/><br/>
    </div> <!-- /container -->
    
    
    <script src="<?php echo base_url();?>static/dropzone/dropzone.min.js"></script>
	<script>
		Dropzone.options.myAwesomeDropzone = { 
				paramName: "file",
				maxFilesize: 10,
				complete: function(file, done) {
					refush_list();
					done();
				}
		};
		function refush_list(){
			$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/tools/docs/get_doc_list"); ?>",
		        data: {'rldwz':'<?php echo $docs['rldwz']; ?>'},
		        success: function(data) {
			        $('table tbody').html(data);
		        }
		    });
		}
		function del_file(obj,id)
		{
			//alert(id);
			$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/tools/docs/delete_doc"); ?>",
		        data: {'dwz':'<?php echo $docs['dwz']; ?>','id':id},
		        success: function(data) {
			        if(data==1){
			        	$(obj).parent().parent().remove();
				    }else{
						alert(data);
					}
		        }
		    });
			
		}
	</script>
  </body>
</html>