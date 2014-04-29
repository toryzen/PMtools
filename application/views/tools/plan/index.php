  <?php $this->load->view('rbac_head');?>
  
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>

  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2  style="margin-top:-30px">新建计划 </h2>
        <p class="lead">确认资料后请牢记计划网址，这是您修改/管理计划的唯一条件！</p>
      </div>
      <h3>基本信息</h3>
      <p></p>
      <div class="row">
          <div class="col-md-2"><input name="plan[bname]" value="" class="form-control" type="text"  placeholder="名称"  errormsg="至少1个字符,最多50个字符！" datatype="*1-50"/></div>
        <div class="col-md-3">
          <div class="input-group">
            <input name="plan[begintime]" value="" id="begin_time" class="form-control" type="text" placeholder="开始日期" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <input name="plan[endtime]" value=""  id="end_time" class="form-control" type="text" placeholder="结束日志" onclick="WdatePicker({onpicked:function(){change_except();},dateFmt:'yyyy-MM-dd'})"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <input id="chosen-select-demo" class="form-control" type="text" placeholder="排除日期" disabled />
            <select name="plan[exceptdays][]" data-placeholder="请选择排除日期" class="form-control hide" id="chosen-select" multiple ></select>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
       </div>
      </div>
      <hr/>
      <h3>任务信息</h3>
      <div>
        <table class="table table-striped table-hover table_task">
          <thead>
            <tr>
              <th style="width:10%;">名称</th>
              <th style="width:30%;">描述</th>
              <th style="width:10%;">参与(数/人)</th>
              <th style="width:10%;">人天</th>
              <th style="width:15%;">预计开始</th>
              <th style="width:15%;">预计结束</th>
              <th style="width:5%;">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_demo" class="hide">
              <td><input class="form-control" type="text" name="task[title][]"  placeholder="名称"  datatype="*"/></td>
              <td><input class="form-control" type="text" name="task[describ][]"  placeholder="描述"  datatype="*"/></td>
              <td><input class="form-control" type="text" name="task[owner][]"  placeholder="参与"  datatype="*"/></td>
              <td><input class="form-control" type="text" name="task[pdays][]"  placeholder="人天"  datatype="*"/></td>
              <td>
	              <div class="input-group">
		            <input name="task[expstrt][]"  id="end_time" class="form-control" type="text" placeholder="预计开始" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td>
	              <div class="input-group">
		            <input name="task[expendt][]"  id="end_time" class="form-control" type="text" placeholder="预计完成" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><button id="addtask" type="button" class="btn btn-default pull-right">新增任务</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <hr/>
      <h3>里程碑信息</h3>
      <div>
        <table class="table table-striped table-hover table_lcb">
          <thead>
            <tr>
              <th style="width:10%;">名称</th>
              <th style="width:40%;">描述</th>
              <th style="width:15%;">时间</th>
              <th style="width:5%;">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_demo_lcb" class="hide">
              <td><input class="form-control" type="text" name="milestone[title][]"  placeholder="名称"  datatype="*"/></td>
              <td><input class="form-control" type="text" name="milestone[describ][]"  placeholder="描述"  datatype="*"/></td>
              <td>
	              <div class="input-group">
		            <input name="milestone[timepoint][]"  id="end_time" class="form-control" type="text" placeholder="里程碑时间" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><button id="addlcb" type="button" class="btn btn-default pull-right">新增里程碑</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div style="text-align:center">
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
      </div>
      
    </form>
    </div> <!-- /container -->
    
    <script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
    <script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script> 
    <script>
    $(function(){
        $('.table_task tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        $('.table_lcb tbody').append('<tr>'+$('#tr_demo_lcb').html()+'</tr>');
        $('#addtask').click(function(){
            $('.table_task tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        })
        $('#addlcb').click(function(){
            $('.table_lcb tbody').append('<tr>'+$('#tr_demo_lcb').html()+'</tr>');
        })
        //表单验证
        $(".registerform").Validform({ignoreHidden:true});
    });
    function deltr(obj)
    {
        $(obj).parent().parent().remove();
    }
    function change_except(){
        $('#chosen-select-demo').show();
        $('#chosen-select').hide();
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
              
             $('#chosen-select-demo').hide();
             $('#chosen-select').show();
             $('#chosen-select').append('<option value="'+s_data+'">'+s_data+'</option>');
        }
        $("#chosen-select").chosen({width: "100%"}); 
    }
    </script>
  </body>
</html>