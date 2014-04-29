  <?php $this->load->view('rbac_head');?>
  
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>static/Validform/css/style.css"/>

  <div class="container">
      <form action="" method="post" class="registerform">
      <div class="page-header">
        <h2  style="margin-top:-30px">修改文档夹 </h2>
      </div>
	  
	  <h3>名称</h3>
      <div>
      	<span><input name="bname"  class="form-control" value="<?php echo $bname; ?>"  errormsg="至少2个字符,最多50个字符！" datatype="*2-50"/></span><span></span>
      <hr/>

      <hr/>
      <div style="text-align:center">
        <input type="hidden" name="dwz" value="<?php echo $dwz; ?>"/>
        <input type="submit" value="确认资料" class="btn btn-default btn-lg"/>
      </div>
      
    </form>
    <br/><br/>
    </div> <!-- /container -->
    
    <script src="<?php echo base_url();?>static/dropzone/dropzone.min.js"></script>
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