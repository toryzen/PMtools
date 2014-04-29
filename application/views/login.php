<?php $this->load->view("rbac_head");?>

	<div class="container">
		<div class="row" style="padding-top:100px">
		
			<div class="col-sm-8">
				<?php $this->load->view("tools");?>
			</div>
		
			<div class="col-sm-4">
					<div class="panel panel-primary">
						<?php if(!isset($_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["id"])):?>
						<div class="panel-heading">用户登录</div>
						<div class="panel-body">
						
						<form class="form-horizontal" role="form"  action="" method="post">
							<div class="input-group">
							  <span class="input-group-addon">用户</span>
							  <input type="text" class="form-control" placeholder="请输入用户" name="username">
							</div>
							<br/>
							<div class="input-group">
							  <span class="input-group-addon">密码</span>
							  <input type="password" class="form-control" placeholder="请输入密码" name="password">
							</div>
							<br/>
							<div class="form-group">
								<div class="col-sm-offset-1 col-sm-5">
									<button type="submit" class="btn btn-primary btn-block">登录</button>
								</div>
								<div class="col-sm-5">
									<a class="btn btn-success btn-block" onclick="alert('暂未开放,测试用户test,密码test')">注册</a>
								</div>
							</div>
							</form>
						</div>
						<?php else: ?>
						<div class="panel-heading">欢迎您："<?php echo $_SESSION[$this->config->item('rbac_auth_key')]["INFO"]["nickname"]?>"</div>
						<div class="panel-body" style="text-align:center;padding:70px 0 70px 0">
							<a href="<?php echo base_url()."/index.php/".$this->config->item('rbac_default_index'); ?>" class="btn btn-primary btn-lg"><span class='glyphicon glyphicon-log-in'></span>  进入管理</a>
							<?php echo anchor("index/logout","<span class='glyphicon glyphicon-log-out'></span> 用户退出",array('class'=>'btn btn-danger btn-lg')); ?>
						</div>
						<?php endif;?>
					</div>
					</div>
				</div>
			</div>
			<hr/>
			
<?php $this->load->view("rbac_foot");?>