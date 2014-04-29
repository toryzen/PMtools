  <?php $this->load->view('rbac_head');?>
  
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>
  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2  style="margin-top:-30px">新建会议列表 </h2>
        <p class="lead">确认资料后请牢记会议列表网址，这是您修改/管理会议列表的唯一条件！</p>
      </div>

      <h3>基本信息</h3>
      <p></p>
      <div class="row">
        <span class="col-md-12"><input value="" name="bname" class="form-control" type="text"  placeholder="名称"  errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></span>
      </div>
      <hr/>
      
      <h3>会议信息</h3>
      <div>
        <table class="table table-striped table-hover table_task">
          <thead>
            <tr>
              <th style="width:15%;">名称</th>
              <th style="width:20%;">时间</th>
              <th style="width:10%;">参会人员</th>
              <th style="width:25%;">会议内容</th>
              <th style="width:25%;">会议纪要</th>
              <th style="width:5%;">操作</th>
            </tr>
          </thead>
          <tbody>
              <tr id="tr_demo" class="hide">
              <td><input class="form-control" type="text" name="meeting[mname][]"  placeholder="名称" errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></td>
              <td>
	              <div class="input-group">
		            <input name="meeting[begintime][]" id="begin_time" class="form-control" type="text" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})"  datatype="/\d{4}-\d{2}-\d{2}/i"/>
		            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
		          </div>
              </td>
              <td><textarea name="meeting[people][]" class="form-control" rows="3" ></textarea></td>
              <td><textarea name="meeting[info][]" class="form-control" rows="3" ></textarea></td>
              <td><textarea name="meeting[memo][]" class="form-control" rows="3" ></textarea></td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7"><button id="addtask" type="button" class="btn btn-default pull-right">新增会议</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div style="text-align:center">
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
      </div>
    </form>
    </div> <!-- /container -->
      
<script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script>
<script>
$(function(){
    $(".registerform").Validform({
		ignoreHidden:true
	});
});
</script>
    <script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
    <script>
    $(function(){
        $('.table_task tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        $('#addtask').click(function(){
            $('.table_task tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        })
    });
    function deltr(obj){
        $(obj).parent().parent().remove();
    }
    </script>
  </body>
</html>