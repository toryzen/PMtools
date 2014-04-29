<div class="well well-sm">
    <h4 style="display:inline">项目大厅</h4>
</div>
<style>
.table{font-size:12px;}
.total{background-color:#81F3D6}
.daytime{background-color:#E1F281}
.leftwork{background-color:#F6B47E}
.burnwork{background-color:#AC8CE8}
</style>
<table class="table  table-bordered table-sm well well-sm">
	<thead>
		<tr>
			<th rowspan="2" style="vertical-align:middle;">名称</th>
			<th rowspan="2" style="vertical-align:middle;">计划开始</th>
			<th rowspan="2" style="vertical-align:middle;">计划结束</th>
			<th rowspan="2" style="vertical-align:middle;">负责</th>
			<th rowspan="2" style="vertical-align:middle;">敏捷</th>
			<th rowspan="2" style="vertical-align:middle;">需求</th>
			<th rowspan="2" style="vertical-align:middle;">类型</th>
			<th rowspan="2" style="vertical-align:middle;">状态</th>
			<th colspan="2" class="total">总计</th>
			<th colspan="3" class="daytime">天数</th>
			<th colspan="3" class="leftwork">剩余工作</th>
			<th colspan="3" class="burnwork">燃尽工作</th>
			<th rowspan="2" style="vertical-align:middle;">资料</th>
		</tr>
		<tr>
			<th class="total">迭</th>
			<th class="total">任</th>
			<th class="daytime">总</th>
			<th class="daytime">累</th>
			<th class="daytime">剩</th>
			<th class="leftwork">1天</th>
			<th class="leftwork">3天</th>
			<th class="leftwork">7天</th>
			<th class="burnwork">1天</th>
			<th class="burnwork">3天</th>
			<th class="burnwork">7天</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $p):?>
		<tr <?php if($p['status']==3){echo "class='success'";}if($p['status']==2){echo "class='danger'";}?>>
			<td><a target="_blank" href="<?php echo base_url("/index.php/project/single/main/")."/".$p['pid']; ?>" ><?php echo $p['pname']; ?></a></td>
			<td><?php echo date('m/d',strtotime($p['plan_start'])); ?></td>
			<td><?php echo date('m/d',strtotime($p['plan_end'])); ?></td>
			<td><?php echo $p['manager']; ?></td>
			<td><?php echo $p['scrummaster']; ?></td>
			<td><?php echo $p['demander']; ?></td>
			<td>
			<?php if($p['ptype']<0):?>
					<span class='label label-warning'>审批</span>
				<?php elseif($p['ptype']==1):?>
					<span class='label label-default'>计划</span>
				<?php else:?>
					<span class='label label-success'>常规</span>
			<?php endif;?>
			</td>
			<td>
				<?php if($p['status']<0):?>
					<span class='label label-warning'>审批</span>
				<?php elseif($p['status']==1):?>
					<span class='label label-default'>正常</span>
				<?php elseif($p['status']==2):?>
					<span class='label label-danger'>冻结</span>
				<?php elseif($p['status']==3):?>
					<span class='label label-success'>完成</span>
				<?php endif;?>
			</td>
			<td class="total"><?php echo $p['total_stage']; ?></td>
			<td class="total"><?php echo $p['total_tasks']; ?></td>
			<td class="daytime"><?php echo $p['daytime_all']; ?></td>
			<td class="daytime"><?php echo $p['status']==1?$p['daytime_left']:'X'; ?></td>
			<td class="daytime"><?php echo $p['status']==1?($p['daytime_all']-$p['daytime_left']):'X'; ?></td>
			<td class="leftwork"><?php echo $p['status']==1?$p['leftwork_1']:'X'; ?></td>
			<td class="leftwork"><?php echo $p['status']==1?$p['leftwork_3']:'X'; ?></td>
			<td class="leftwork"><?php echo $p['status']==1?$p['leftwork_7']:'X'; ?></td>
			<td class="burnwork"><?php echo $p['status']==1?$p['burnwork_1']:'X'; ?></td>
			<td class="burnwork"><?php echo $p['status']==1?$p['burnwork_3']:'X'; ?></td>
			<td class="burnwork"><?php echo $p['status']==1?$p['burnwork_7']:'X'; ?></td>
			<th><a class="btn btn-xs btn-info" onclick="show_detail(<?php echo $p['pid']; ?>);" >资料</a></th>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<script>
function show_detail(id){
	$('#mainFrame').attr("src","<?php echo base_url("index.php/project/single/index/")."/" ?>"+id);
	$('#myModal').modal();
}
</script>
<div class="modal fade"  id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">资料</h4>
      </div>
      <div class="modal-body">
        <iframe id="mainFrame"  src="" name="tools" style="width:100%;border:0;height:500px;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<hr/>
<?php echo $this->pagination->create_links(); ?>