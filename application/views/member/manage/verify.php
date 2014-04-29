<div class="well well-sm">
    <h4 style="display:inline">项目审核</h4>
</div>
<table class="table table-sm well">
	<thead>
		<tr>
            <th>名称</th>
            <th>优先</th>
            <th>类型</th>
            <th>状态</th>
            <th>公开</th>
            <th>人员</th>
            <th>计划开始</th>
            <th>计划结束</th>
            <th style="width:15%">项目操作</th>
          </tr>
	</thead>
	<tbody>
	   <?php foreach($data as $mb):?>
	   <tr>
			<td><a class="pop" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $mb['describ'];?>" ><?php echo $mb['pname'];?></a></td>
			<td><b><?php echo $mb['priority'];?></b></td>
			<td>
				<?php if($mb['ptype']<0):?>
					<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/ptype/2/" ;?>" class='btn btn-success btn-xs'>通过[常规]</a>
					<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/ptype/1/" ;?>" class='btn btn-danger btn-xs'>拒绝[常规]</a>
				<?php elseif($mb['ptype']==1):?>
					<span class='label label-default'>计划</span>
				<?php else:?>
					<span class='label label-success'>常规</span>
				<?php endif;?>
			</td>
			<td>
				<?php if($mb['status']<0):?>
					<?php if($mb['status']=='-2'):?>
						<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/status/2" ;?>" class='btn btn-success btn-xs'>通过[冻结]</a>
						<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/status/1" ;?>" class='btn btn-danger btn-xs'>拒绝[冻结]</a>
					<?php else:?>
						<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/status/3" ;?>" class='btn btn-success btn-xs'>通过[完成]</a>
						<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/status/1" ;?>" class='btn btn-danger btn-xs'>拒绝[完成]</a>
					<?php endif;?>
				<?php elseif($mb['status']==1):?>
					<span class='label label-default'>正常</span>
				<?php else:?>
					<span class='label label-danger'>冻结</span>
				<?php endif;?>
			</td>
			<td>
				<?php if($mb['publish']<0):?>
					<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/publish/2" ;?>" class='btn btn-success btn-xs'>通过[公开]</a>
					<a href="<?php echo base_url('index.php/member/manage/do_verify')."/".$mb['pid']."/publish/1" ;?>" class='btn btn-danger btn-xs'>拒绝[公开]</a>
				<?php elseif($mb['publish']==1):?>
					<span class='label label-default'>公开</span>
				<?php else:?>
					<span class='label label-success'>内部</span>
				<?php endif;?>
			</td>
			<td><a class="pop" data-toggle="tooltip" data-placement="bottom" data-original-title="负责:<?php echo $mb['manager'];?>;敏捷:<?php echo $mb['scrummaster'];?>;需求:<?php echo $mb['demander'];?>;测试:<?php echo $mb['tester'];?>;评分:<?php echo $mb['pointer'];?>;成员:<?php echo $mb['developer'];?>" >详情</a></td>
			<td><?php echo $mb['plan_start'];?></td>
			<td><?php echo $mb['plan_end'];?></td>
			<td>
				<div class="btn-group">
					<a target="_blank" href="<?php echo base_url("/index.php/project/single/main/")."/".$mb['pid']; ?>" class="btn btn-info btn-xs">访问项目</a>
				</div>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->pagination->create_links(); ?>

 <script>
 	function cg_field(pid,btype,status,pubish){
 	 	if(btype!=""){
 	 		var title = btype==1?'确定要将项目类型变为常规？(此操作需经过审批！)':'确定要将项目类型变为计划？(此操作需经过审批！)'; 
	 		var field = 'ptype';
 	 	}
 	 	if(status!=""){
 	 		var title = btype==1?'确定要将项目状态变为进行？(此操作需经过审批！)':'确定要将项目状态变为冻结？(此操作需经过审批！)'; 
 	 		var field = 'status';
 	 	}
	 	if(pubish!=""){
 	 		var title = btype==1?'确定要将项目公开项变为公开？(此操作需经过审批！)':'确定要将项目公开项变为内部？(此操作需经过审批！)';
 	 		var field = 'publish';
	 	}
 	 	if (window.confirm(title)) {
 	 		$.ajax({
 				type:'post',
 				url:'<?php echo base_url("/index.php/project/operating/cg_field/"); ?>/'+field,
 				data:{'pid':pid},
				success:function(data){
					if(data=='ok'){
						location.reload();
					}else{
						alert(data);
					}
					
				}
 			});
 	 	}
 	}
 	function cg_status(){
 		var title = btype==1?'进行':'冻结'; 
 	 	if (window.confirm("确定要将项目状态变为"+title+"?")) {
 	 		$.ajax({
 				type:'post',
 				url:'<?php echo base_url("/index.php/project/operating/cg_field/status"); ?>',
 				data:{'pid':pid},
				success:function(data){
					if(data=='ok'){
						
					}else{
						alert(data);
					}
					
				}
 			});
 	 	}
 	}
 	function cg_publish(){
 		var title = btype==1?'公开':'独步'; 
 	 	if (window.confirm("确定要将项目公开项变为"+title+"?")) {
 	 		$.ajax({
 				type:'post',
 				url:'<?php echo base_url("/index.php/project/operating/cg_field/publish"); ?>',
 				data:{'pid':pid},
				success:function(data){
					if(data=='ok'){
						
					}else{
						alert(data);
					}
					
				}
 			});
 	 	}
 	}
	$(function(){
		$('.pop').tooltip();
	});
 </script>