<form action="" method="POST">
<div class="well well-sm">
    <h4 style="display:inline">新建项目</h4>
</div>
<div class="well well-sm">
	  <h3>基本信息</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>名称</label>
		    <input name="info[pname]" type="text" class="form-control" placeholder="名称">
		    <label>优先级</label>
		    <select name="info[priority]" class="chosen_select" >
		    	<option value="A">A</option>
		    	<option value="B">B</option>
		    	<option value="C">C</option>
		    </select>
		  </div>
        </div>
        <div class="col-md-3">
          <label>计划开始</label>
          <div class="input-group">
            <input name="info[plan_start]" id="begin_time" class="form-control" type="text" placeholder="开始" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
          <label>计划结束</label>
          <div class="input-group">
            <input name="info[plan_end]" id="begin_time" class="form-control" type="text" placeholder="结束" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
		    <label>项目简介</label>
		    <textarea name="info[describ]" class="form-control" rows="4"></textarea>
		  </div>
        </div>
      </div>
      <hr/>
      <h3>人员信息</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>项目负责人</label>
		    <input pubtype="people" name="info[manager]" type="text" class="form-control" placeholder="项目负责人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>敏捷负责人</label>
		    <input pubtype="people" name="info[scrummaster]" type="text" class="form-control" placeholder="敏捷负责人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>需求接口人</label>
		    <input pubtype="people" name="info[demander]" type="text" class="form-control" placeholder="需求接口人">
		  </div>
        </div>
      </div>
      <br/>
      <div class="row">
       
        <div class="col-md-4">
          <div class="form-group">
		    <label>测试接口人</label>
		    <input pubtype="people" name="info[tester]" type="text" class="form-control" placeholder="测试接口人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>评分人</label>
		    <input pubtype="people"  name="info[pointer]" type="text" class="form-control" placeholder="评分人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>开发人员</label>
		    <input pubtype="people" type="text"  name="info[developer][]"  multiple class="form-control" placeholder="开发人员">
		  </div>
        </div>
      </div>
      <hr/>
      <h3>项目信息</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>立项</label>
		    
		    <select class="chosen_select" name="info[tools_setup]">
		    	<option value="" selected>不挂接</option>
		    	<?php foreach($setup as $sp){
		    		echo "<option value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>计划</label>
		    
		    <select class="chosen_select" name="info[tools_plan]">
		    	<option value="" selected>不挂接</option>
		    	<?php foreach($plan as $sp){
		    		echo "<option value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>任务</label>
		    <select class="chosen_select" multiple name="info[tools_tasks][]" >
		    	<?php foreach($tasks as $sp){
		    		echo "<option value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>文档</label>
		    <select class="chosen_select" name="info[tools_docs]">
		    	<option value="">不挂接</option>
		    	<?php foreach($docs as $sp){
		    		echo "<option value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>会议</label>
		    <select class="chosen_select" name="info[tools_meeting]">
		    	<option value="">不挂接</option>
		    	<?php foreach($meeting as $sp){
		    		echo "<option value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
      </div>
      <hr/>
      <h3>职能信息</h3>
      <table class="table">
      	<tr>
      		<th>角色</th><th>管理权限</th>
      	</tr>
      	<tr>
      		<td>项目负责人</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="setup" checked> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="plan" checked> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="tasks" checked> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="docs" checked> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="meeting" checked> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="point"> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>敏捷负责人</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="setup"> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="plan"> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="tasks" checked> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="docs"> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="meeting"> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="point"> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>需求接口</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="setup"> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="plan"> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="tasks"> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="docs" checked> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="meeting"> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="point"> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>测试接口</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="setup"> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="plan"> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="tasks"> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="docs" checked> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="meeting"> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="point"> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>评分人</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="setup"> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="plan"> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="tasks"> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="docs"> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="meeting"> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="point" checked> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>开发人员</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="setup" checked> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="plan"> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="tasks"> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="docs"> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="meeting"> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[developer][]" type="checkbox" value="point"> 评分
				</label>
			</td>
      	</tr>
      </table>
      <!-- 
      <h3>状态信息</h3>
      <div class="row">
      	<div class="col-md-6">
      	项目类型：<select name="info[ptype]" class="chosen_select" >
		    			<option value="1">计划</option>
		    			<option value="2">常规</option>
		    	  </select>
      	</div>
      	<div class="col-md-6">
      	是否公开：<select name="info[publish]" class="chosen_select" >
		    			<option value="1">内部</option>
		    			<option value="2">公开</option>
		    	  </select>
      	</div> 
		  
      </div>
       -->
      <hr/>
      
      <div style="text-align:center">
        <button type="button" class="btn btn-default btn-lg" onclick="submit()">确认资料</button>
      </div>
</div>
</form>
<script src="<?php echo base_url();?>static/datepicker/WdatePicker.js"></script>
<script>
$(function(){
	set_userlist("<?php echo base_url("index.php/pubinfo/userlist");?>");
	$(".chosen_select").chosen({width: "100%"});
});
</script>