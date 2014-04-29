<form action="" method="POST">
<div class="well well-sm">
    <h4 style="display:inline">修改项目</h4>
</div>
<div class="well well-sm">
	  <h3>基本信息</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>名称</label>
		    <input value="<?php echo $project['pname']; ?>" name="info[pname]" type="text" class="form-control" placeholder="名称">
		    <label>优先级</label>
		    <select name="info[priority]" class="chosen_select" >
		    	<option value="A" <?php echo ($project['priority']=='A'?"selected":""); ?>>A</option>
		    	<option value="B" <?php echo ($project['priority']=='B'?"selected":""); ?>>B</option>
		    	<option value="C" <?php echo ($project['priority']=='C'?"selected":""); ?>>C</option>
		    </select>
		  </div>
        </div>
        <div class="col-md-3">
          <label>计划开始</label>
          <div class="input-group">
            <input value="<?php echo $project['plan_start']; ?>" name="info[plan_start]" id="begin_time" class="form-control" type="text" placeholder="开始" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
          <label>计划结束</label>
          <div class="input-group">
            <input value="<?php echo $project['plan_end']; ?>" name="info[plan_end]" id="begin_time" class="form-control" type="text" placeholder="结束" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-calendar"></span></span>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
		    <label>项目简介</label>
		    <textarea name="info[describ]" class="form-control" rows="4"> <?php echo $project['describ']; ?></textarea>
		  </div>
        </div>
      </div>
      <hr/>
      <h3>人员信息</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
		    <label>项目负责人</label>
		    <input value="<?php echo $project['manager']; ?>" pubtype="people" name="info[manager]" type="text" class="form-control" placeholder="项目负责人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>敏捷负责人</label>
		    <input value="<?php echo $project['scrummaster']; ?>" pubtype="people" name="info[scrummaster]" type="text" class="form-control" placeholder="敏捷负责人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>需求接口人</label>
		    <input value="<?php echo $project['demander']; ?>" pubtype="people" name="info[demander]" type="text" class="form-control" placeholder="需求接口人">
		  </div>
        </div>
      </div>
      <br/>
      <div class="row">
       
        <div class="col-md-4">
          <div class="form-group">
		    <label>测试接口人</label>
		    <input value="<?php echo $project['tester']; ?>" pubtype="people" name="info[tester]" type="text" class="form-control" placeholder="测试接口人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>评分人</label>
		    <input value="<?php echo $project['pointer']; ?>" pubtype="people"  name="info[pointer]" type="text" class="form-control" placeholder="评分人">
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>开发人员</label>
		    <input value="<?php echo $project['developer']; ?>" pubtype="people" type="text"  name="info[developer][]"  multiple class="form-control" placeholder="开发人员">
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
		    	<option value="">不挂接</option>
		    	<?php foreach($setup as $sp){
		    		$selected = (($sp['dwz']."|".$sp['rldwz'])==$project['tools_setup'])?'selected':'';
		    		echo "<option $selected value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>计划</label>
		    <select class="chosen_select" name="info[tools_plan]">
		    	<option value="">不挂接</option>
		    	<?php foreach($plan as $sp){
		    		$selected = (($sp['dwz']."|".$sp['rldwz'])==$project['tools_plan'])?'selected':'';
		    		echo "<option $selected value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
		    	}?>
		    </select>
		  </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
		    <label>任务</label>
		    <select class="chosen_select" multiple name="info[tools_tasks][]" >
		    	<?php 
		    	foreach($tasks as $sp){		    		
		    		$selected = strstr($project['tools_tasks'],($sp['dwz']."|".$sp['rldwz']))!==FALSE?'selected':'';
		    		echo "<option $selected  value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
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
		    		$selected = (($sp['dwz']."|".$sp['rldwz'])==$project['tools_docs'])?'selected':'';
		    		echo "<option $selected value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
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
		    		$selected = (($sp['dwz']."|".$sp['rldwz'])==$project['tools_meeting'])?'selected':'';
		    		echo "<option $selected value='".$sp['dwz']."|".$sp['rldwz']."'>".$sp['dname']."【".$sp['bname']."】"."</option>";
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
				  <input name="rpby[manager][]" type="checkbox" value="setup" <?php if(in_array('setup',$duty_char['manager']))echo 'checked'; ?>> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="plan"  <?php if(in_array('plan',$duty_char['manager']))echo 'checked'; ?>> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="tasks"  <?php if(in_array('tasks',$duty_char['manager']))echo 'checked'; ?>> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="docs"  <?php if(in_array('docs',$duty_char['manager']))echo 'checked'; ?>> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="meeting"  <?php if(in_array('meeting',$duty_char['manager']))echo 'checked'; ?>> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[manager][]" type="checkbox" value="point" <?php if(in_array('point',$duty_char['manager']))echo 'checked'; ?>> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>敏捷负责人</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="setup"  <?php if(in_array('setup',$duty_char['scrummaster']))echo 'checked'; ?>> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="plan"  <?php if(in_array('plan',$duty_char['scrummaster']))echo 'checked'; ?>> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="tasks"  <?php if(in_array('tasks',$duty_char['scrummaster']))echo 'checked'; ?>> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="docs"  <?php if(in_array('docs',$duty_char['scrummaster']))echo 'checked'; ?>> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="meeting"  <?php if(in_array('meeting',$duty_char['scrummaster']))echo 'checked'; ?>> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[scrummaster][]" type="checkbox" value="point"  <?php if(in_array('point',$duty_char['scrummaster']))echo 'checked'; ?>> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>需求接口</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="setup"  <?php if(in_array('setup',$duty_char['demander']))echo 'checked'; ?>> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="plan"  <?php if(in_array('plan',$duty_char['demander']))echo 'checked'; ?>> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="tasks"  <?php if(in_array('tasks',$duty_char['demander']))echo 'checked'; ?>> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="docs"  <?php if(in_array('docs',$duty_char['demander']))echo 'checked'; ?>> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="meeting"  <?php if(in_array('meeting',$duty_char['demander']))echo 'checked'; ?>> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[demander][]" type="checkbox" value="point"  <?php if(in_array('point',$duty_char['demander']))echo 'checked'; ?> > 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>测试接口</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="setup"  <?php if(in_array('setup',$duty_char['tester']))echo 'checked'; ?>> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="plan"  <?php if(in_array('plan',$duty_char['tester']))echo 'checked'; ?>> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="tasks"  <?php if(in_array('tasks',$duty_char['tester']))echo 'checked'; ?>> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="docs"  <?php if(in_array('docs',$duty_char['tester']))echo 'checked'; ?>> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="meeting"  <?php if(in_array('meeting',$duty_char['tester']))echo 'checked'; ?>> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[tester][]" type="checkbox" value="point"  <?php if(in_array('point',$duty_char['tester']))echo 'checked'; ?>> 评分
				</label>
			</td>
      	</tr>
      	<tr>
      		<td>评分人</td>
      		<td>
      			<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="setup"  <?php if(in_array('setup',$duty_char['pointer']))echo 'checked'; ?>> 立项
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="plan"  <?php if(in_array('plan',$duty_char['pointer']))echo 'checked'; ?>> 计划
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="tasks"  <?php if(in_array('tasks',$duty_char['pointer']))echo 'checked'; ?>> 任务
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="docs"  <?php if(in_array('docs',$duty_char['pointer']))echo 'checked'; ?>> 文档
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="meeting"  <?php if(in_array('meeting',$duty_char['pointer']))echo 'checked'; ?>> 会议
				</label>
				<label class="checkbox-inline">
				  <input name="rpby[pointer][]" type="checkbox" value="point"  <?php if(in_array('point',$duty_char['pointer']))echo 'checked'; ?>> 评分
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
      <input type="hidden" name="info[ptype]" value="<?php echo $project['ptype']; ?>" />
      <input type="hidden" name="info[publish]" value="<?php echo $project['publish']; ?>" />
      <input type="hidden" name="info[status]" value="<?php echo $project['status']; ?>" />
      <!-- 
      <h3>状态信息</h3>
      <div class="row">
      	<div class="col-md-6">
      	项目类型：<select name="info[ptype]" class="chosen_select" >
		    			<option value="1" <?php if($project['ptype']=="1")echo 'selected'; ?>>计划</option>
		    			<option value="2" <?php if($project['ptype']=="2")echo 'selected'; ?>>常规</option>
		    	  </select>
      	</div>
      	<div class="col-md-6">
      	是否公开：<select name="info[publish]" class="chosen_select" >
		    			<option value="1" <?php if($project['publish']=="1")echo 'selected'; ?>>内部</option>
		    			<option value="2" <?php if($project['publish']=="1")echo 'selected'; ?>>公开</option>
		    	  </select>
      	</div> 
		  
      </div>
       -->
      <hr/>
      <div style="text-align:center">
        <input type="hidden" name="info[pid]" value="<?php echo $project['pid']; ?>" />
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