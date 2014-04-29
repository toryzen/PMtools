  <?php $this->load->view('head');?>
  
  <div class="container" >
    <div class="row">
     <div class="col-sm-2 ms_nav"  style="text-align:left">
        <div class="list-group">
        	<a  class="list-group-item active" ><?php echo $project['pname']; ?></a>
	        <a target="tools" href="<?php echo base_url("index.php/project/single/index/")."/".$project['pid'];?>"  class="list-group-item" onclick="cg_frame(this);">项目资料</a>
	        
	        <?php if(isset($MTlist['tools_setup'])): ?>
	        	<?php if(in_array('setup',$Palist)):?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/setup/pannel/?dwz=").$MTlist['tools_setup'];?>" class="list-group-item" onclick="cg_frame(this,'setup');">立项资料</a>
	        	<?php else:?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/setup/pannel/?rldwz=").$MTlist['tools_setup'];?>" class="list-group-item" onclick="cg_frame(this,'setup');">立项资料</a>
	        	<?php endif?>
	        <?php endif;?>
	        
	        <?php if(isset($MTlist['tools_plan'])): ?>
	        	<?php if(in_array('plan',$Palist)):?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/plan/pannel/?dwz=").$MTlist['tools_plan'];?>" class="list-group-item" onclick="cg_frame(this,'plan');">计划图表</a>
	        	<?php else:?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/plan/pannel/?rldwz=").$MTlist['tools_plan'];?>" class="list-group-item" onclick="cg_frame(this,'plan');">计划图表</a>
	        	<?php endif?>
	        <?php endif;?>
	        
	        <?php if(isset($MTlist['tools_tasks'])): ?>
	        	<?php if(in_array('tasks',$Palist)):?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/tasks/pannel/?dwz=").$MTlist['tools_tasks'][0];?>" class="list-group-item" onclick="cg_frame(this,'tasks');">任务列表</a>
	        	<?php else:?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/tasks/pannel/?rldwz=").$MTlist['tools_tasks'][0];?>" class="list-group-item" onclick="cg_frame(this,'tasks');">任务列表</a>
	        	<?php endif?>
	        <?php endif;?>
	        
	        <?php if(isset($MTlist['tools_docs'])): ?>
	        	<?php if(in_array('docs',$Palist)):?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/docs/pannel/?dwz=").$MTlist['tools_docs'];?>" class="list-group-item" onclick="cg_frame(this,'docs');">文档列表</a>
	        	<?php else:?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/docs/pannel/?rldwz=").$MTlist['tools_docs'];?>" class="list-group-item" onclick="cg_frame(this,'docs');">文档列表</a>
	        	<?php endif?>
	        <?php endif;?>
	        
	        <?php if(isset($MTlist['tools_meeting'])): ?>
	        	<?php if(in_array('meeting',$Palist)):?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/meeting/pannel/?dwz=").$MTlist['tools_meeting'];?>" class="list-group-item" onclick="cg_frame(this,'meeting');">会议信息</a>
	        	<?php else:?>
	        		<a target="tools" href="<?php echo base_url("index.php/tools/meeting/pannel/?rldwz=").$MTlist['tools_meeting'];?>" class="list-group-item" onclick="cg_frame(this,'meeting');">会议信息</a>
	        	<?php endif?>
	        <?php endif;?>
	        
	        <?php if(($project['publish']==2)&&$project['ptype']==2&&$project['status']==1):?>
		        <?php if(isset($MTlist['tools_tasks'])): ?>
		        	<a target="tools" href="<?php echo base_url("index.php/project/efficiency/pannel/")."/".$project['pid']."/".$MTlist['tools_tasks'][0];?>" class="list-group-item" onclick="cg_frame(this,'jx');">绩效信息</a>
		        <?php endif;?>
	        <?php endif;?>
	        
     	</div>
     	<a href="<?php echo base_url('index.php/member/manage/mylist')?>" class="btn btn-warning" style="width:100%">返回项目列表</a>
     </div>
        
     <div class="col-sm-10 ms_content">
        <div class="panel panel-success">
		  <div class="panel-heading">
		  	<span class='title'>基本信息</span>
		  	<div class='pull-right'>
		  		<div class='tools_right setup_button hidden'></div>
		  		<div class='tools_right plan_button hidden'></div>
		  		<div class='tools_right tasks_button hidden'>
		  			<div class="btn-group" style="margin-top:-6px;">
		  			  <?php foreach($MTlist['tools_tasks'] as $k=>$ttks):?>
		  			  	<?php if(in_array('tasks',$Palist)):?>
			        		<a target="tools" href="<?php echo base_url("index.php/tools/tasks/pannel/?dwz=").$ttks;?>"  class="btn btn-default btn-sm" >任务面板【<?php echo $k+1; ?>】</a>
			        	<?php else:?>
			        		<a target="tools" href="<?php echo base_url("index.php/tools/tasks/pannel/?rldwz=").$ttks;?>"  class="btn btn-default btn-sm">任务面板【<?php echo $k+1; ?>】</a>
			        	<?php endif?>
		  			  <?php endforeach;?>
					</div>
		  		</div>
		  		<div class='tools_right docs_button hidden'></div>
		  		<div class='tools_right meeting_button hidden'></div>
		  		<div class='tools_right jx_button hidden'>
		  		   <div class="btn-group" style="margin-top:-6px;">
		  			<?php foreach($MTlist['tools_tasks'] as $k=>$ttks):?>
		  			  	<?php if(in_array('tasks',$Palist)):?>
			        		<a target="tools" href="<?php echo base_url("index.php/project/efficiency/pannel/")."/".$project['pid']."/".$ttks;?>"  class="btn btn-default btn-sm" >绩效面板【<?php echo $k+1; ?>】</a>
			        	<?php else:?>
			        		<a target="tools" href="<?php echo base_url("index.php/project/efficiency/pannel/")."/".$project['pid']."/".$ttks;?>"  class="btn btn-default btn-sm">绩效面板【<?php echo $k+1; ?>】</a>
			        	<?php endif?>
		  			  <?php endforeach;?>
		  		  </div>
		  		</div>
		    </div> 
		  </div>
		  <div class="panel-body" style="padding:0;">
		    <iframe id="mainFrame" onload='IFrameReSize("mainFrame");' src="<?php echo base_url("index.php/project/single/index/")."/".$project['pid'];?>" name="tools" style="width:100%;border:0;"></iframe>
		  </div>
        </div>
     </div>
      
  	</div><!--/row-->
  	<span class="pull-right"><small>双击页面空白处隐藏左侧导航</small></span>
  	<br/><br/>
  </div><!-- /container -->
  
  <script>
  
  function cg_frame(obj,title){
	  $('.title').html($(obj).html());
	  $('.tools_right').removeClass('hidden');
	  $('.tools_right').addClass('hidden');
	  $('.'+title+'_button').removeClass('hidden');
  }
  function IFrameReSize(iframename) {
		var pTar = document.getElementById(iframename);
		if (pTar) {
			if (pTar.contentDocument && pTar.contentDocument.body.offsetHeight) {
				pTar.height = pTar.contentDocument.body.offsetHeight;
			} 
			else if (pTar.Document && pTar.Document.body.scrollHeight) {
				pTar.height = pTar.Document.body.scrollHeight;
			}
		}
	}
  function IFrameReSizeWidth(iframename) {
	  var pTar = document.getElementById(iframename);
	  if (pTar) {
	  	if (pTar.contentDocument && pTar.contentDocument.body.offsetWidth) {
	  		pTar.width = pTar.contentDocument.body.offsetWidth;
	  	}
	  	else if (pTar.Document && pTar.Document.body.scrollWidth) {
	  		pTar.width = pTar.Document.body.scrollWidth;
	  	}
	  }
	  }
  </script>
  
  </body>
</html>