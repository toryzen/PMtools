  <?php $this->load->view('head');?>
  
  <div class="container" style="padding:0;;margin:10px;width:100%;">
    <h4>项目信息</h4>
    <table class="table well well-sm">
    	<tr>
    	  <th>名称</th>
    	  <th>计划开始</th>
    	  <th>计划结束</th>
    	  <th>项目介绍</th>
    	</tr>
	   <tr>
	   	  <td><?php echo $project['pname'] ;?></td>
		  <td><?php echo $project['plan_start'] ;?></td>
		  <td><?php echo $project['plan_end'] ;?></td>
		  <td><?php echo $project['describ'] ;?></td>
	   </tr>
    </table>
    <table class="table well well-sm">
    	<tr>
    	  <th>类型</th>
    	  <th>状态</th>
    	  <th>公开</th>
    	</tr>
	   <tr>
		  <td><?php echo ($project['ptype']==1)?"<span class='label label-default'>计划</span>":"<span class='label label-success'>常规</span>";?></td>
		  <td><?php echo ($project['status']==1)?"<span class='label label-success'>正常</span>":"<span class='label label-danger'>冻结</span>";?></td>
		  <td><?php echo ($project['publish']==1)?"<span class='label label-default'>内部</span>":"<span class='label label-success'>公开</span>";?></td>
	   </tr>
    </table>
            <hr/>
            <h4>人员相关</h4>
            <table class="table well well-sm">
            	<tr>
	            	<th>角色</th>
					<th>人员</th>
					<th>管理</th>
            	</tr>
	            <tr>
	            	<td>负责人</td>
					<td><?php echo $project['manager']; ?></td>
					<td><?php $list = "";foreach(json_decode($duty['manager'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            <tr>
	            	<td>敏捷负责人</td>
	            	<td><?php echo $project['scrummaster']; ?></td>
					<td><?php $list = "";foreach(json_decode($duty['scrummaster'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            <tr>
	            	<td>开发人员</td>
					<td><?php echo $project['developer']; ?></td>
					<td><?php $list = "";foreach(json_decode($duty['developer'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            <tr>
	            <td>需求接口人</td>
	            	<td><?php echo $project['demander']; ?></td>
					<td><?php $list = "";foreach(json_decode($duty['demander'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            <tr>
	            	<td>测试接口人</td>
	            	<td><?php echo $project['tester']; ?></td>
					<td><?php $list = "";foreach(json_decode($duty['tester'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            <tr>
	            	<td>评分人</td>
	            	<td><?php echo $project['pointer']; ?></td>
	            	<td><?php $list = "";foreach(json_decode($duty['pointer'],TRUE) as $vo){$list.=$vo."/";}echo substr($list,0,-1);?></td>
	            </tr>
	            
            </table>
            <hr/>
            <h4>操作日志</h4>
            <div style="height:200px;overflow-y:scroll">
	            <table class="table  well well-sm">
            	<tr>
	            	<th>人员</th>
					<th>IP</th>
					<th>操作</th>
					<th>时间</th>
            	</tr>
            </table>
            </div>
  		</div>
	</div>
  </div> <!-- /container -->
  
  </body>
</html>