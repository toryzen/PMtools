
<div class="well well-sm" style="height: 60px">
    <h3 style="display:inline"><b><?php echo $user_name;?></b>本期总绩效得分：<b><?php if($total)echo $total;else echo 0;?></b>分</h3>
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
<?php foreach ($info as $pro){?>
<h3 style="text-algin:center;"><?php echo $pro['pname']?></h3>
<?php foreach ($pro['task'] as $item){ ?>
<table  class="well well-sm table table-hover table-bordered table-condensed" style="margin-bottom:0px;border-bottom: 0px;">
<thead>
    <tr><th class="warning" colspan="12" style="text-align:center"><?php echo $item['bname']?></th></tr>
    <tr>
        <th style="vertical-align:middle;width:5%;">ID</th>
        <th style="vertical-align:middle;width:30%;">任务名</th>
        <th style="vertical-align:middle;width:10%;" colspan="2">工作量</th>
        <th style="vertical-align:middle;width:10%;" colspan="2">剩余</th>
        <th style="vertical-align:middle;width:10%;" colspan="2">超期</th>
        <th style="vertical-align:middle;width:10%;">评分人</th>
        <th style="vertical-align:middle;width:10%;">职责</th>
        <th style="vertical-align:middle;width:30%;">绩效公式</th>
        <th style="vertical-align:middle;width:5%;">得分</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($item['task'] as $task){?>
    <tr class="<?php if($task['utype']=='manage')echo 'success';else echo 'active';?>">
        <td><?php echo $task['id']?></td>
        <td><?php echo $task['story']?></td>
        <td colspan="2"><?php echo $task['work']?></td>
        <td colspan="2"><?php echo $task['leftwork']?></td>
        <td colspan="2"><?php echo $task['delayday']?></td>
        <td><?php echo $task['pfuser']?></td>
        <td><?php if($task['utype']=='manage')echo '负责人';else echo '成员';?></td>
        <td><?php echo $task['jx_char']?></td>
        <td><?php echo $task['jx_point']?></td>
    </tr>
    <?php }?>
</tbody>
</table>
<?php }?>
<h3><br/></h3>
<?php }?>

<h3>绩效公式</h3>
<table class="table well well-sm">
 <tr>
     <td>
         <h4>公式</h4>
         (工作量-剩余工作量)-(((工作量-剩余工作量))*(atan(超期天数)/(pi()/2)))
         <h4>解释</h4>
         当工作没有剩余工作量且按时完成时，将获得全部的任务分数<br/>
         当工作没有剩余工作量但没有按时完成时，将按超期天数按比例减分(详见右表)<br/>
         当工作按时完成但有剩余工作量时，将获得所做的工作量等同的任务分数<br/>
         当工作没有按时完成，且有剩余工作量时，将获得所做的工作量等同的任务分数且按超期比例减分的分数(详见右表)
         <h4>其他</h4>
         项目成员每完成一项任务，项目负责人将获得其1/5等同的任务分数
     </td>
     <td><img src="<?php echo base_url()."static/image/percent.png" ;?>" /></td>
 </tr>
</table>
<script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
