<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1.0">
   		<title>项目综合管理平台</title>
   		<!-- BASE CSS -->
		<link rel="stylesheet" href="<?php echo base_url();?>static/bootstrap/css/bootstrap.min.css">
		<link href="<?php echo base_url();?>static/offcanvas.css" rel="stylesheet">
		<link href="<?php echo base_url();?>static/chosen/chosen.css" rel="stylesheet">
		<!-- BASE JS -->
		<script src="<?php echo base_url();?>static/jquery.1102.min.js"></script>
		<script src="<?php echo base_url();?>static/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>static/bootstrap/js/respond.min.js"></script>
		<script src="<?php echo base_url();?>static/chosen/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>static/pub.js"></script>
    </head>
    
    <body>

 	 <div id="tools_nav" class="navbar navbar-fixed-top navbar-inverse headroom headroom--unpinned" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo base_url();?>">项目综合管理平台 </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li id="fat-menu" class="dropdown">
          	<?php if(!isset($_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["id"])):?>
              <a href="<?php echo base_url();?>" role="button" >返回首页</a>
            <?php else:?>
              <li>
		          <div>
		            <!-- Button trigger modal -->
		          	<?php if(isset($this->info)):?>
		          	    <button class="in_depot_text btn btn-primary  <?php if($this->depot) echo "hide"; ?>" data-toggle="modal" data-target="#set_depots">记录至我的仓库</button>
		          	    <button class="out_depot_text btn btn-danger  <?php if(!$this->depot) echo "hide"; ?>" data-toggle="modal" data-target="#set_depots">从我的仓库中删除</button>
		          	<?php endif;?>	            
		            <div class="btn-group  navbar-btn">
			        <button type="button" class="btn btn-info dropdown-toggle"  data-toggle="dropdown">
			        	欢迎您:<?php echo $_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["nickname"]; ?>
			        	<span class="caret"></span>
			        </button>
			        <ul class="dropdown-menu" role="menu">
			          <li><a href="<?php echo base_url()."/index.php/".$this->config->item('rbac_default_index'); ?>">管理中心</a>	</li>
                      <li><a href="<?php echo base_url();?>">功能首页</a>	</li>
			          <li><?php echo anchor("index/logout","用户退出"); ?></li>
			        </ul>
			      </div>
			      
		          </div>
	          </li>
            <?php endif;?>
          </li>
        </ul>
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    
    <?php if(isset($this->info)):?>
    <!-- set_depots hidden -->
	<div class="modal fade" id="set_depots" role="dialog">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">仓库操作</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	        	<div class="out_depot_text alert alert-danger <?php if(!$this->depot){echo "hide";}?>">确定要从您的仓库中删除？</div>
			    <div class="in_depot_text <?php if($this->depot){echo "hide";}?>">
			    	<label>仓库别名:</label>
			    	<input id="depot_name"	class="form-control"   placeholder="请输入您要记录的仓库别名！" value="<?php echo $bname; ?>" />
			    </div>
			    <input id="depot_action" atype="<?php if($this->depot){echo "del";}else{echo "add";}?>" dtype="<?php echo $this->type; ?>" ctype="<?php echo $this->info['type']; ?>"  type="hidden" value="<?php echo $this->info['value']; ?>" />
			 </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">取消操作</button>
	        <button type="button" class="btn btn-primary" onclick="depot();">确认操作</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
	function depot(adde,dtype,ctype,keys){
		var adde  = $('#depot_action').attr('atype');
		var dtype = $('#depot_action').attr('dtype');
		var ctype = $('#depot_action').attr('ctype');
		var keys  = $('#depot_action').attr('value');
		if(adde=='add')
			var dname = $('#depot_name').val();
		else
			var dname = '1';
		if(adde && dtype && ctype && keys && dname){
			$.ajax({
	    		type: 'POST',
		        url: "<?php echo base_url("index.php/member/depot/set_depot/"); ?>",
					        data: {'dname':dname,'adde':adde,'dtype':dtype,'ctype':ctype,'keys':keys},
					        success: function(data) {
					        	if(data=='add_ok'){
					        		$('#set_depots').modal('hide');
					        		$('.in_depot_text').addClass('hide');
					        		$('.out_depot_text').removeClass('hide');
					        		$('#depot_action').attr('atype','del');
						        }else if(data=='del_ok'){
						        	$('#set_depots').modal('hide');
						        	$('.in_depot_text').removeClass('hide');
					        		$('.out_depot_text').addClass('hide');
					        		$('#depot_action').attr('atype','add');
						        }else{
						        	alert(data);
								}
					        }
					    });
		}else{
			alert("数据不完整,保存至仓库出错,请重试！");
			return;
		}
		
	}
    </script>
	<?php endif;?>
    