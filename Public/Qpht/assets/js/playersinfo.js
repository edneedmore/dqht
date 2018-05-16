var gameuser=(function($){
	var dataobj=pubFun.dataobj;
	var initFun=function(){
		 dataobj.bgtime=$("#timespan").attr('data-begin');
		 dataobj.entime=$("#timespan").attr('data-end');
	}
	var searchTime=function(){
		$('#seachbtn').on('click',function(){
			dataobj.bgtime=$('#begin_time').val();
			dataobj.entime=$('#end_time').val();
			dataobj.page=1;
			dataobj.ordertype=null;
			dataobj.orderfield=null;
			var btime=new Date(dataobj.bgtime);
			var etime=new Date(dataobj.entime);
			if(etime.getTime()-btime.getTime()>0){
				var cod_playerid=$('#playerid').val();
				//var cod_gametype=$('#gametype').val();
				var cod_gametype=$('#gametype').val();
				dataobj.playid=cod_playerid;
				dataobj.gameid=cod_gametype;
				expage(dataobj);
			}else{
				alert('选择正确的时间区间');
			}
		})
	}
	var changeTable=function(data,dataobj){
		var gamename=pubFun.getgamename(dataobj.gameid);
		var pageico=data[3];//当前页码
		var page=data[0];//总页数
		var data=data[1];//返回数据
		var html='';
		$('.panel-body h4').html(gamename);
		$.each(data, function(index, val) {
			temp="<tr class='odd gradeX'><td class='center'>"+((pageico-1)*pubFun.fynum+index+1)+"</td>";
			temp+="<td class='center'>"+$(this)[0].user_id+"</td>";
			temp+="<td class='center'>"+$(this)[0].nickname+"</td>";
			temp+="<td class='center'>"+$(this)[0].room_id+"</td>";
			temp+="<td class='center'>"+$(this)[0].in_gold+"</td>";
			temp+="<td class='center'>"+$(this)[0].change_gold+"</td>";
			temp+="<td class='center'>...</td>";
			temp+="<td class='center'>"+$(this)[0].last_gold+"</td>";
			temp+="<td class='center'>配置</td>";
			temp+="<td class='center'>...</td>";
			temp+="<td class='center'>...</td>"; 
			html+=temp;
		});
		$('#table_main').html(html);
		var temppage='';
		for (var i = 0; i < page; i++) {
			var x= i+1
			temppage+="<option vaule='"+x+"'>"+x+"</option>";
		}
		//console.log(dataobj);
		$('#pagenums').html(temppage);
		//pageico==1,说明重新进行了一次查询，重新绑定翻页函数
		if(pageico==1){
			$('#pagenums').unbind();
			$('#pagenums').on('change',function(){
				dataobj.page=$(this).val();
				expage(dataobj);
			})	
		}
		$('#pagenums option').each(function(index, el) {
			if($(this).val()==pageico){
				$("#pagenums").val(pageico);
			}
		});
		
	 }
	var expage=function(conds){
		$.post("/qpht.php/gamemanage/seachdata2",conds,function(data,status){
	  		changeTable(data,conds);
	  	});
	}
	//默认翻页方法
	var defaultexpage=function(){
		// var cod_playerid=null;
		$('#pagenums').on('change',function(){
				dataobj.page=$(this).val();
				console.log(dataobj);
				expage(dataobj);
			})
	}
	initFun();
	defaultexpage();
	searchTime();
})($);
