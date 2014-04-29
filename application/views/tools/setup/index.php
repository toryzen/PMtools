<?php $this->load->view('rbac_head');?>

<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>

  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2 style="margin-top:-30px">新建立项 </h2>
        <p class="lead">确认资料后请牢记面板网址，这是您修改/管理面板的唯一条件！</p>
      </div>
	  
	  <h3>项目名称<span class="pull-right"><button type="button" class="btn btn-default demo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="XX工具">示例</button></span></h3>
      <div class="Validdiv">
          <span><input name="bname" value="" class="form-control" type="text" errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></span><span></span>
      </div>
      <hr/>
		
      <h3>项目概述<span class="pull-right"><button type="button" class="btn btn-default demo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="通过Hadoop(Hive+Hbase)提供数据以及计算能力，迁移原xx工具的各项功能（完成当前xxx物品找回业务），提升运算的范围与速度，并将将原有的固定化流程用系统实现，达到提升使用部门处理业务的效率。">示例</button></span></h3>
      	<span><textarea name="describ" class="form-control" rows="3"  datatype="*1-500"></textarea></span><span></span>
      <hr/>
      
      <h3>项目背景<span class="pull-right"><button type="button" class="btn btn-default demo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="原xx工具为XXX提供的PC客户端程序，通过连接XXX数据库的形式对玩家的数据进行相应查询，但工具因为年限以及技术问题无法提供更高效的查询与处理速度，目前已经达到瓶颈，影响部分部门的工作效率">示例</button></span></h3>
      	<span><textarea name="background" class="form-control" rows="3" errormsg="至少1个字符,最多500个字符！" datatype="*1-500"></textarea></span><span></span>
      <hr/>
      
      <h3>项目需求<span class="pull-right"><button type="button" class="btn btn-default demo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="功能：帐号信息查询，角色信息查询，登录日志查询，物品交易日志查询，背包信息查询，封号，物品封服务器，物品转移操作，并可以将上述功能流程化运行。 
性能：允许多人对同一区组同时进行相关数据查询(各单项业务10人同时查询，15s内返回所查询数据)
输出：可以将部分相关的玩家数据导出为Excel
输入：手工输入或SYS工单提供的数据(玩家帐号/玩家角色/丢失物品/时间范围)
安全：每人每号且可由高权限用户自由分配权限
      ">示例</button></span></h3>
      <p></p>
      <div>
        <span><textarea name="demand" class="form-control" rows="6" errormsg="至少1个字符,最多500个字符！" datatype="*1-500"></textarea></span><span></span>
      </div>
      <hr/>
      
      <h3>项目意义<span class="pull-right"><button type="button" class="btn btn-default demo" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="	解决原工具所遇到的部分无法使用/查询缓慢问题
	新系统通过Hadoop(Hive+Hbase)提供强大的数据支撑，避免对线上游戏产生影响，并可以同时对同一区组进行数据查询
	新系统将流程化工作一步到位，通过最终的运算，将业务所涉及到的所有数据一次性进行展示
	通过定制化系统，可以智能判断是否为恶意找回等事项，减少xxx人员工作量
      ">示例</button></span></h3>
      <div>
      	<span><textarea name="meaning" class="form-control" rows="3" errormsg="至少1个字符,最多500个字符！" datatype="*1-500"></textarea></span><span></span>
      <hr/>
      <h3>补充资料</h3>
      <div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="width:20%;">名称</th>
              <th style="width:75%;">内容</th>
              <th style="width:5%;">操作</th>
            </tr>
          </thead>
          <tbody>
            <tr id="tr_demo" class="hide">
              <td><input class="form-control" type="text" name="other[name][]"  placeholder="名称" datatype="*1-50" /></td>
              <td><input class="form-control" type="text" name="other[value][]"  placeholder="内容" datatype="*1-500" /></td>
              <td><button type="button" class="btn btn-default" onclick="deltr(this)">删除</button></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5"><button id="addtask" type="button" class="btn btn-default pull-right">新增</button></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <hr/>
      <div style="text-align:center">
          <input type="submit" value="确认资料" class="btn btn-default btn-lg" />
      </div>
      <br/><br/>
    </div> <!-- /container -->
    </form>
      
      <script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script>
    <script>
    $(function(){
        $(".registerform").Validform({
            ignoreHidden:true
        });
    });
    </script>
    <script>
    $(function(){
    	$('.demo').tooltip();
        $('#addtask').click(function(){
            $('table tbody').append('<tr>'+$('#tr_demo').html()+'</tr>');
        });
    });
    function deltr(obj){
        $(obj).parent().parent().remove();
    }
    </script>
  </body>
</html>