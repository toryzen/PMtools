//设置成员
function set_userlist(url){
	$.ajax({
		type: 'GET',
        url: url,
        success: function(data) {
        	var option_list = "";
        	userlist = eval(data);
        	for(var i=0,l=userlist.length;i<l;i++){  
     		   for(var key in userlist[i]){  
     		       option_list +="<option value='"+userlist[i][key]+"'>"+userlist[i][key]+"</option>";
     		   }
        	}
        	$('input[pubtype=people]').each(function(a,b){
        		option_list = "";
        		var value = $(b).val().split(",");
        		//人员
        		var select = "";
        		for(var i=0,l=userlist.length;i<l;i++){  
          		   for(var key in userlist[i]){
          			   if($.inArray(userlist[i][key],value) >= 0) {
          				 select = "selected";
	          			}else{
	          				select = " ";
	          			}
          		       option_list +="<option value='"+userlist[i][key]+"' "+select+">"+userlist[i][key]+"</option>";
          		   }
             	}
        		//alert(value);
                var name = $(b).attr("name");
                var cclass  = $(b).attr("class");
                var multiple = $(b).attr('multiple')=="multiple"?"multiple":"";
                $(b).replaceWith("<select class="+cclass+" name="+name+" id='pubpeo_"+name.replace("[","_").replace("]","_").replace("[]","_mut")+"' "+multiple+" data-placeholder='请选择' >"+option_list+"</select>");
                $("#"+"pubpeo_"+name.replace("[","_").replace("]","_").replace("[]","_mut")).chosen({width: "100%"}); 
                
        	})
        }
	});
}
//隐藏NAV
$(function(){
	if(self.frameElement && self.frameElement.tagName=="IFRAME"){
		$("#tools_nav").remove();
		$(".container").css("padding","0px");
		$(".container").css("width","98%");
		$(".container").css("margin","-70px 0 10px 10px");
	}
});

//双击隐藏左侧导航
function leftmenutoggle(){
	if($(".ms_nav").hasClass('hide')){
		$(".ms_nav").removeClass('hide');
		$(".ms_content").removeClass('col-sm-12');
		$(".ms_content").addClass('col-sm-10');
	}else{
		$(".ms_nav").addClass('hide');
		$(".ms_content").removeClass('col-sm-10');
		$(".ms_content").addClass('col-sm-12');
	}
}

document.ondblclick=leftmenutoggle;