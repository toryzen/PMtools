<div class="well well-sm">
    <h4 style="display:inline">我的项目</h4>
	<div class="btn-group pull-right" style="top:-7px;">
	  <a href="<?php echo base_url("index.php/member/manage/mylist")?>"  class="btn btn-default">项目负责人</a>
	  <a href="<?php echo base_url("index.php/member/manage/mylist/scrummaster")?>"  class="btn btn-default">敏捷负责人</a>
	  <a href="<?php echo base_url("index.php/member/manage/mylist/demander")?>"  class="btn btn-default">需求接口人</a>
	  <a href="<?php echo base_url("index.php/member/manage/mylist/tester")?>"  class="btn btn-default">测试接口人</a>
	  <a href="<?php echo base_url("index.php/member/manage/mylist/pointer")?>"  class="btn btn-default">评分人</a>
	  <a href="<?php echo base_url("index.php/member/manage/mylist/developer")?>"  class="btn btn-default">开发人员</a>
	</div>
	&nbsp;
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
            <th style="width:35%">项目操作</th>
          </tr>
	</thead>
	<tbody>
	   <?php foreach($data as $mb):?>
	   <tr <?php if($mb['status']==3){echo "class='success'";}if($mb['status']==2){echo "class='danger'";}?>>
			<td><a class="pop" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $mb['describ'];?>" ><?php echo $mb['pname'];?></a></td>
			<td><b><?php echo $mb['priority'];?></b></td>
			<td>
				<?php if($mb['ptype']<0):?>
					<span class='label label-warning'>审批</span>
				<?php elseif($mb['ptype']==1):?>
					<span class='label label-default'>计划</span>
				<?php else:?>
					<span class='label label-success'>常规</span>
				<?php endif;?>
			</td>
			<td>
				<?php if($mb['status']<0):?>
					<span class='label label-warning'>审批</span>
				<?php elseif($mb['status']==1):?>
					<span class='label label-default'>正常</span>
				<?php elseif($mb['status']==2):?>
					<span class='label label-danger'>冻结</span>
				<?php elseif($mb['status']==3):?>
					<span class='label label-success'>完成</span>
				<?php endif;?>
			</td>
			<td>
				<?php if($mb['publish']<0):?>
					<span class='label label-warning'>审批</span>
				<?php elseif($mb['publish']==1):?>
					<span class='label label-default'>内部</span>
				<?php else:?>
					<span class='label label-success'>公开</span>
				<?php endif;?>
			</td>
			<td><a class="pop" data-toggle="tooltip" data-placement="bottom" data-original-title="负责:<?php echo $mb['manager'];?>;敏捷:<?php echo $mb['scrummaster'];?>;需求:<?php echo $mb['demander'];?>;测试:<?php echo $mb['tester'];?>;评分:<?php echo $mb['pointer'];?>;成员:<?php echo $mb['developer'];?>" >详情</a></td>
			<td><?php echo $mb['plan_start'];?></td>
			<td><?php echo $mb['plan_end'];?></td>
			<td>
				<div class="btn-group pull-right">
					<a target="_blank" href="<?php echo base_url("/index.php/project/single/main/")."/".$mb['pid']; ?>" class="btn btn-default btn-xs">访问项目</a>
					<?php if($utype=='manager'):?>
					
						<?php if($mb['ptype']=='1'):?>
							<a href="<?php echo base_url("/index.php/member/manage/sub_verify")."/".$mb['pid']."/ptype/-2/"; ?>" onclick="return confirm('确定要将项目类型变为常规？(此操作需经过审批！)')" class="btn btn-default btn-xs">常规</a>
						<?php endif; ?>
						
						<?php if($mb['status']=='1'):?>
							<a href="<?php echo base_url("/index.php/member/manage/sub_verify")."/".$mb['pid']."/status/-2/"; ?>" onclick="return confirm('确定要将项目状态变为冻结？(此操作需经过审批！)')"  class="btn btn-info btn-xs">冻结</a>
							<a href="<?php echo base_url("/index.php/member/manage/sub_verify")."/".$mb['pid']."/status/-3/"; ?>" onclick="return confirm('确定要将项目状态变为完成？(此操作需经过审批！)')"  class="btn btn-success btn-xs">完成</a>
						<?php endif; ?>
						
						<?php if($mb['publish']=='1'):?>
							<a href="<?php echo base_url("/index.php/member/manage/sub_verify")."/".$mb['pid']."/publish/-2/"; ?>"  onclick="return confirm('确定要将项目变为公开？(此操作需经过审批！)')"  class="btn btn-warning btn-xs">公开</a>
						<?php endif; ?>
						
						<a href="<?php echo base_url("/index.php/project/operating/edit/")."/".$mb['pid']; ?>" class="btn btn-danger btn-xs">修改资料</a>
					<?php endif;?>
				</div>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->pagination->create_links(); ?>

 <script>
	$(function(){
		$('.pop').tooltip();
	});
 </script>