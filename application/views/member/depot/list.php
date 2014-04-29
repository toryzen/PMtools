<style>input{width:100%}</style>

<h3 style="margin:0px;">
	<?php echo $uri_title; ?>
	<div class="btn-group pull-right">
	  <a href="<?php echo base_url("/index.php/member/depot/$uri_dirc/all/$uri_is_hide/"); ?>"  class="btn btn-primary">全部</a>
	  <a href="<?php echo base_url("/index.php/member/depot/$uri_dirc/manage/$uri_is_hide/"); ?>" class="btn btn-info">管理</a>
	  <a href="<?php echo base_url("/index.php/member/depot/$uri_dirc/readonly/$uri_is_hide/"); ?>" class="btn btn-warning">只读</a>
	</div>
</h3>
<table class="table  table-bordered table-condensed well">
	<thead>
          <tr>
            <th style="width:10%">别称</th>
            <th style="width:5%">权限</th>
            <th style="width:60%">地址：</th>
            <th style="width:25%">操作</th>
          </tr>
        </thead>
   <tbody>
   <?php if(count($data)>0):?>
   <?php foreach($data as $mb):?>
   <tr>
   		<td><a id='dname_<?php echo $mb->id;?>' class="pops" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $mb->bname;?>"><?php echo $mb->dname;?></a></td>
		<td> <?php echo $mb->ctype=='dwz'?"<span class='label label-success'>管理</span>":"<span class='label label-warning'>只读</span>"; ?> </td>
		<td>
			<?php if($mb->ctype=='dwz'): ?>
				<input type="text" value="<?php echo base_url("index.php/tools/".$uri_dirc."/pannel?dwz=").$mb->keys; ?>"  />
			<?php else:?>
				<input type="text" value="<?php echo base_url("index.php/tools/".$uri_dirc."/pannel?rldwz=").$mb->keys; ?>"  />
			<?php endif;?>
			</td>
		<td>
			<div class="btn-group  btn-group-xs">
			<?php if($mb->ctype=='dwz'): ?>
				<a class="btn btn-success btn-xs" href="<?php echo base_url("index.php/tools/".$uri_dirc."/pannel?dwz=").$mb->keys; ?>" target="_blank">访问工具</a>
			    <a class="btn btn-primary btn-xs" onclick="cg_dname('<?php echo $mb->id;?>','<?php echo $mb->dname;?>');">修改别称</a>
			    <?php if($uri_is_hide=='yes'): ?>
			    	<a class="btn btn-warning btn-xs" onclick="hd_depot(this,'<?php echo $mb->id;?>','0');">显示</a>
			    <?php else:?>
			    	<a class="btn btn-warning btn-xs" onclick="hd_depot(this,'<?php echo $mb->id;?>','1');">隐藏</a>
			    <?php endif;?>
			    <a class="btn btn-danger" onclick="depot(this,'del','<?php echo $uri_dirc;?>','dwz','<?php echo $mb->keys;?>')" >删除</a>
			<?php else:?>
				<a class="btn btn-success btn-xs" href="<?php echo base_url("index.php/tools/".$uri_dirc."/pannel?rldwz=").$mb->keys; ?>" target="_blank">访问工具</a>
			    <a class="btn btn-primary btn-xs" onclick="cg_dname('<?php echo $mb->id;?>','<?php echo $mb->dname;?>');">修改别称</a>
			    <?php if($uri_is_hide=='yes'): ?>
			    	<a class="btn btn-warning btn-xs" onclick="hd_depot(this,'<?php echo $mb->id;?>','0');">显示</a>
			    <?php else:?>
			    	<a class="btn btn-warning btn-xs" onclick="hd_depot(this,'<?php echo $mb->id;?>','1');">隐藏</a>
			    <?php endif;?>
			    <a class="btn btn-danger" onclick="depot(this,'del','<?php echo $uri_dirc;?>','rldwz','<?php echo $mb->keys;?>')" >删除</a>
			<?php endif;?>
			</div>
		</td>
	</tr>
	<?php endforeach;?>
	<?php else:?>
	<tr><td colspan="10" style="text-align:center">暂无相关数据</td></tr>
	<?php endif;?>
  </tbody>
  <tfoot>
  	<tr><td colspan="10">
  	<div class="btn-group pull-right">
	  <a href="<?php echo base_url("/index.php/member/depot/$uri_dirc/$uri_type/no/"); ?>" class="btn btn-default btn-sm">正常列表</a>
	  <a href="<?php echo base_url("/index.php/member/depot/$uri_dirc/$uri_type/yes/"); ?>" class="btn btn-default btn-sm">隐藏列表</a>
	</div>
  	</td></tr>
  </tfoot>
</table>

<hr/>
<?php echo $this->pagination->create_links(); ?>

<!-- EDIT DNAME -->
<div class="modal fade" id="edit_dname" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">仓库操作</h4>
      </div>
      <div class="modal-body">
        <label>仓库别名:</label>
		<input id="depot_name" class="form-control"   placeholder="仓库别名!" value="" />
		<input id="depot_id" type="hidden" value="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消操作</button>
	    <button type="button" class="btn btn-primary" onclick="cg_dname_action();">确认操作</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

	//修改别称弹出框
	$('.pops').tooltip();
    function cg_dname(id,olddname){
        if(id){
	    	$('#depot_id').val(id);
	        $('#depot_name').val(olddname);
			$('#edit_dname').modal();
        }else{
			alert('参数错误！');
        }
    }
    //修改别称
    function cg_dname_action(){
    	var id = $('#depot_id').val();
        var name =$('#depot_name').val();
        if(id && name){
            $.ajax({
				'type':'POST',
				'url':'<?php echo base_url("index.php/member/depot/edit_depot/"); ?>',
				data:{'id':id,'dname':name},
				success:function(data){
					if(data=='ok'){
						$('#edit_dname').modal('hide');
						$('#dname_'+id).html(name);
					}else{
						alert(data);
					}
				  }
                });
        }else{
			alert('参数错误');
        }
    }
    //隐藏条目
    function hd_depot(obj,id,t){
    	if (window.confirm("确定隐藏本条目？")) {
    		$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/member/depot/hide_depot/"); ?>",
					        data: {'id':id,'type':t},
					        success: function(data) {
					        	if(data=='ok'){
					        		$(obj).parent().parent().parent().remove();
						        }else{
						        	alert(data);
								}
					        }
				});
        }
    }
    //删除条目
	function depot(obj,adde,dtype,ctype,keys){
		if (window.confirm("确定删除吗?删除后不可恢复,建议使用隐藏功能！")) {
			$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/member/depot/set_depot/"); ?>",
					        data: {'adde':adde,'dtype':dtype,'ctype':ctype,'keys':keys},
					        success: function(data) {
					        	if(data=='del_ok'){
					        		$(obj).parent().parent().parent().remove();
						        }else{
						        	alert(data);
								}
					        }
					    });
					}
	}
</script>
