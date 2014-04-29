  <?php $this->load->view('rbac_head');?>
  
 <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>

  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2  style="margin-top:-30px">新建文档夹 </h2>
        <p class="lead">确认资料后请牢记文档夹网址，这是您修改/管理文档夹的唯一条件！</p>
      </div>
	  
	  <h3>名称</h3>
      <div>
      	<span><input name="bname" value="" class="form-control" type="" errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></span><span></span>
      <hr/>

      <hr/>
      <div style="text-align:center">
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
      </div>
      
    </form>
    <br/><br/>
    </div> <!-- /container -->
<script src="<?php echo base_url();?>static/Validform/Validform_v5.3.2_min.js"></script>
<script>
$(function(){
    $(".registerform").Validform({
		//tiptype:2
	});
});
</script> 
  </body>
</html>