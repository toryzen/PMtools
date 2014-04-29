
<div class="well well-sm" style="height: 60px">
    <h4 style="display:inline"><?php echo $date_time;?>绩效人员列表</h4>
    <div style="float:right;">
        <form action="" method="POST">
            <div class="input-group" style="width:120px;float: left;">
            <input name="date_time" value="<?php echo $date_time;?>" id="begin_time" class="form-control" type="text" placeholder="开始" onclick="WdatePicker({dateFmt:'yyyy-MM'})">
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
          <input style="margin-top: 3px;margin-left:10px;float: left;" type="submit" value="查询历史" id="show_time" class="btn btn-primary btn-sm"/>
        </form>
    </div>
</div>

<table class="table table-hover table-bordered table-condensed">
    <thead>
    <tr> 
        <th rowspan="2" style="width:15px;">部门</th>
        <th rowspan="2">姓名</th>
        <th colspan="2" style="text-align:center">负责人相关</th>
        <th colspan="2" style="text-align:center">成员相关</th>
        <th rowspan="2" style="text-align:center">人天</th>
        <th rowspan="2" style="text-align:center">总分</th>
    </tr>
    <tr>
        <th style="text-align:center">数量</th>
        <th style="text-align:center">得分</th>
        <th style="text-align:center">数量</th>
        <th style="text-align:center">得分</th>
    </tr>
    </thead>
    <?php foreach ($info as $sinfo){?>
    <?php foreach ($sinfo as $k=>$item){?>
	    <tr>
            <?php if($k==0){ ?><th  class="leftborder" rowspan="<?php echo count($sinfo);?>" ><?php echo $item['depart'];?></th><?php };?>
	    	<td><a href="<?php echo base_url("/index.php/member/pubinfo/efficiency?user_name")."=".$item['username']."&date_time=".$date_time; ?>"><?php echo $item['username'];?></a></td>
	    	<td  style="text-align:center"><?php echo $item['member_count_task'];?></td>
	    	<td  style="text-align:center"><?php echo $item['member_sum_point'];?></td>
            <td  style="text-align:center"><?php echo $item['manage_count_task'];?></td>
	    	<td  style="text-align:center"><?php echo $item['manage_sum_point'];?></td>
	    	<td  style="text-align:center"><?php echo $item['work'];?></td>
	    	<td  style="text-align:center;background-color:#fbfeea"><b><?php echo $item['sum_point'];?></b></td>
	    </tr>
    <?php }?>
    <?php }?>
</table>

<script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
