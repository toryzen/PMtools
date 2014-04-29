  <?php $this->load->view('rbac_head');?>
  
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>
 
  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2  style="margin-top:-30px">修改计划 </h2>
      </div>

      <h3>基本信息</h3>
      <p></p>
      <div class="row">
        <div class="col-md-2"><input value="<?php echo $plan['bname'];?>" name="plan[bname]" class="form-control" type="text"  placeholder="名称" errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></div>
        <div class="col-md-3">
          <div class="input-group">
            <input value="<?php echo $plan['begintime'];?>" name="plan[begintime]" id="begin_time" class="form-control" type="text" placeholder="开始日期" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" errormsg="请选择日期！"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <input  value="<?php echo $plan['endtime'];?>" name="plan[endtime]"  id="end_time" class="form-control" type="text" placeholder="结束日志" onclick="WdatePicker({onpicked:function(){change_except();},dateFmt:'yyyy-MM-dd'})" errormsg="请选择日期！"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <select id="chosen-select" name="plan[exceptdays][]" value="" data-placeholder="请选择排除日期" class="form-control" multiple >
            <?php 
            for($tmp_time = date("Y-m-d",strtotime($plan['begintime']));$tmp_time<=$plan['endtime'];$tmp_time = date("Y-m-d",strtotime("+1 day",strtotime($tmp_time))) ){
				if(in_array($tmp_time,$plan['exceptdays'])){
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
              <td><input class="form-control" type="text" name="task[title][]"  placeholder="名称" datatype="*"/></td>
              <td><input class="form-control" type="text" name="task[describ][]"  placeholder="描述" datatype="*" /></td>
              <td><input class="form-control" type="text" name="task[owner][]"  placeholder="参与" datatype="*" /></td>
              <td><input class="form-control" type="text" name="task[pdays][]"  placeholder="人天" datatype="*" /></td>
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
              <input type="hidden" value="" name="task[id][]">
            </tr>
            
            <?php if($task): foreach($task as $tlist): ?>
            <tr>
              <td><input value="<?php echo $tlist['title'] ?>" class="form-control" type="text" name="task[title][]"  placeholder="名称"  datatype="*"/></td>
              <td><input value="<?php echo $tlist['describ'] ?>" class="form-control" type="text" name="task[describ][]"  placeholder="描述"  datatype="*"/></td>
              <td><input value="<?php echo $tlist['owner'] ?>" class="form-control" type="text" name="task[owner][]"  placeholder="参与" datatype="*" /></td>
              <td><input value="<?php echo $tlist['pdays'] ?>" class="form-control" type="text" name="task[pdays][]"  placeholder="人天" datatype="*"/></td>
              <td>
	              <div class="input-group">
		            <input value="<?php echo $tlist['expstrt'] ?>" name="task[expstrt][]"  id="end_time" class="form-control" type="text" placeholder="预计开始" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td>
	              <div class="input-group">
		            <input value="<?php echo $tlist['expendt'] ?>" name="task[expendt][]"  id="end_time" class="form-control" type="text" placeholder="预计完成" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
              <input type="hidden" value="<?php echo $tlist['id'] ?>" name="task[id][]">
            </tr>
            <?php endforeach;endif;?>
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
              <th style="width:15%;">时间点</th>
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
              <input type="hidden" value="" name="milestone[id][]">
            </tr>
            <?php if($milestone): foreach($milestone as $mlist): ?>
            <tr>
              <td><input value="<?php echo $mlist['title'] ?>" class="form-control" type="text" name="milestone[title][]"  placeholder="名称" datatype="*" /></td>
              <td><input value="<?php echo $mlist['describ'] ?>" class="form-control" type="text" name="milestone[describ][]"  placeholder="描述" datatype="*" /></td>
              <td>
	              <div class="input-group">
		            <input value="<?php echo $mlist['timepoint'] ?>" name="milestone[timepoint][]"  id="end_time" class="form-control" type="text" placeholder="里程碑时间" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            <input type="hidden" value="<?php echo $mlist['id'] ?>" name="milestone[id][]">
            </tr>
            <?php endforeach;endif;?>
            
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><button id="addlcb" type="button" class="btn btn-default pull-right">新增里程碑</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div style="text-align:center">
      	<input type="hidden" name="dwz" value="<?php echo $plan['dwz']; ?>"/>
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
      </div>
      
    </form>
    </div> <!-- /container -->
    
    <script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script>
    <script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
    <script>
    $(function(){
        $('#addtask').click(function(){
            $('.table_task tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        })
        $('#addlcb').click(function(){
            $('.table_lcb tbody').append('<tr>'+$('#tr_demo_lcb').html()+'</tr>');
        })
        
        $(".registerform").Validform({
            ignoreHidden:true
        });
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
    </script>
  </body>
</html>