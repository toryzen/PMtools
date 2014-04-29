<style>
.bs-glyphicons {padding-left: 0;padding-bottom: 1px;margin-bottom: 20px;list-style: none;overflow: hidden;}
.bs-glyphicons li {float: left;width: 25%;height: 115px;padding: 10px;margin: 0 -1px -1px 0;font-size: 12px;line-height: 1.4;text-align: left;border: 1px solid #ddd;}
.bs-glyphicons li p {margin-top:5px;}
</style>
<div class="well well-sm">
    <h4 style="display:inline">进度报告</h4>
</div>
<ul class="bs-glyphicons">
	<?php foreach($data as $vo):?>
		<li>
			<b>ID:</b><?php echo $vo['id']; ?><br/>
			<b>范围:</b><?php echo $vo['start_day']."至".$vo['end_day']; ?><br/>
			<b>项目:</b><?php echo $vo['project_num']; ?><br/>
			<b>任务:</b><?php echo $vo['tasks_num']; ?>
			<p><a href="<?php echo base_url("index.php/member/pubinfo/report_detail/")."/".$vo['id']; ?>" class="btn btn-success btn-xs" style="width:98%">查看报告</a></p>
		</li>
	<?php endforeach;?>
</ul>
<hr/>
<?php echo $this->pagination->create_links(); ?>