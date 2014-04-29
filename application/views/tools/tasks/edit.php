  <?php $this->load->view('rbac_head');?>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>

  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2 style="margin-top:-30px">修改面板</h2>
        <p class="lead"></p>
      </div>

      <h3>基本信息</h3>
      <p></p>
      <div class="row">
        <div class="col-md-2"><input value="<?php echo $borad['bname']; ?>" name="borad[bname]" class="form-control" type="text"  placeholder="名称" errormsg="至少1个字符,最多50个字符！" datatype="*1-50" /></div>
        <div class="col-md-3">
          <div class="input-group">
            <input  value="<?php echo $borad['begintime']; ?>" name="borad[begintime]" id="begin_time" class="form-control" type="text" placeholder="开始日期" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <input value="<?php echo $borad['endtime']; ?>" name="borad[endtime]"  id="end_time" class="form-control" type="text" placeholder="结束日志" onclick="WdatePicker({onpicked:function(){change_except();},dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <select id="chosen-select" name="borad[exceptdays][]" data-placeholder="请选择排除日期" class="form-control" multiple >
            <?php 
            for($tmp_time = date("Y-m-d",strtotime($borad['begintime']));$tmp_time<=$borad['endtime'];$tmp_time = date("Y-m-d",strtotime("+1 day",strtotime($tmp_time))) ){
				if(in_array($tmp_time,$borad['exceptdays'])){
					$check = "selected";
				}else{
					$check = "";
				}
				echo "<option $check value='$tmp_time'>$tmp_time</option>";
			}
			?>
            </select>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
       </div>
      </div>
      <hr/>
      <h3>任务信息</h3>
      <div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:50%;">故事/任务名称</th>
              <th style="width:20%;">所有者</th>
              <th style="width:20%;">预计完成</th>
              <th style="width:10%;">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_demo" class="hide">
              <td><input class="form-control" type="text" name="task[story][]"  placeholder="故事/任务名称"  datatype="*"/></td>
              <td><input class="form-control" type="text" name="task[owner][]"  placeholder="所有者" datatype="*"/></td>
              <td>
	              <div class="input-group">
		            <input name="task[expendt][]"  id="end_time" class="form-control" type="text" placeholder="预计完成" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="*"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
              <input type="hidden" value="" name="task[id][]">
              <input type="hidden" value="" name="task[workload][]">
            </tr>
            <?php if($task): foreach($task as $tlist): ?>
            <tr>
              <td><input value="<?php echo $tlist['story']; ?>" class="form-control" type="text" name="task[story][]"  placeholder="故事/任务名称"  datatype="*"/></td>
              <td><input value="<?php echo $tlist['owner']; ?>" class="form-control" type="text" name="task[owner][]"  placeholder="所有者"  datatype="*"/></td>
              <td>
	              <div class="input-group">
		            <input value="<?php echo $tlist['expendt']; ?>" name="task[expendt][]"  id="end_time" class="form-control" type="text" placeholder="预计完成" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  datatype="*"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
            <input type="hidden" value="<?php echo $tlist['id']; ?>" name="task[id][]">
            <input type="hidden" value='<?php echo json_encode($tlist['workload']); ?>' name="task[workload][]">
            <?php  endforeach; endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5"><button id="addtask" type="button" class="btn btn-default pull-right">新增任务</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <hr/>
      <div style="text-align:center">
      	<input type="hidden" name="dwz" value="<?php echo $borad['dwz']; ?>"/>
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
        <a href="<?php echo base_url("index.php/tools/tasks/pannel?dwz=").$borad['dwz']; ?>" class="btn btn-default btn-lg" >取消修改</a>
      </div>
    </form>
    </div> <!-- /container -->
    
    <script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script>
    <script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
    <script>
    $(function(){
        $('#addtask').click(function(){
            $('table tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        })
        //表单验证
        $(".registerform").Validform({ignoreHidden:true});
    });
    function deltr(obj)
    {
        $(obj).parent().parent().remove();
    }
    function change_except(){
        $('#chosen-select').html("");
        if(!$('#begin_time').val()){
            alert('开始时间不能为空！');
            return;
        }
        beginDate_t = new Date($('#begin_time').val().replace(/\-/g,"/"));
        beginDate =new Date( beginDate_t.setMonth(beginDate_t.getMonth()));
        
        endDate_t = new Date($('#end_time').val().replace(/\-/g,"/"));
        endDate =new Date( endDate_t.setMonth(endDate_t.getMonth()));
        if(beginDate && beginDate>endDate){
            alert('开始时间不能大于结束时间！');
            return;
        }
        var date = new Date();
        beginDate.setDate(beginDate.getDate()-1);
        date = beginDate;
        while(date<endDate){
             date.setDate(date.getDate() + 1);
             var s_data = date.getFullYear()+"-";
             
             if((date.getMonth()+1)<10){
            	 s_data+= "0"+(date.getMonth()+1)+"-";
             }else{
            	 s_data+= (date.getMonth()+1)+"-";
             }
             if(date.getDate()<10){
            	 s_data+= "0"+date.getDate();
             }else{
            	 s_data+= date.getDate();
             }
             $('#chosen-select').append('<option value="'+s_data+'">'+s_data+'</option>');
        }
    }
    </script>
  </body>
</html>