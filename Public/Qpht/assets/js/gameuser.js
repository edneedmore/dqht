var gameuser=(function($){
	var dataobj=pubFun.dataobj;
	var initFun=function(){
		 dataobj.bgtime=$("#timespan").attr('data-begin');
		 dataobj.entime=$("#timespan").attr('data-end');
		 dataobj.gameid=1;
		 dataobj.playertype=0;
		 dataobj.ordertype=null;
		 dataobj.orderfield=null;
		 dataobj.module='1';//用户概况
		 //console.log(dataobj)
	}
	var gamechange=function(){
		$('.nav-tabs li').each(function(index, el) {
			$(this).on('click',function(){
			dataobj.playid=null;
			dataobj.ordertype=null;
			dataobj.orderfield=null;
			dataobj.phone=null;
			dataobj.playertype=null;
			dataobj.module=null;
			dataobj.page=1;
			dataobj.gameid=$(this).find('a').attr('data-gameid');
			expage(dataobj);
		})
		});
	}
	var searchTime=function(){
		var myDate=new Date();
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
				var cod_playertype=$('#usertype').val();
				dataobj.playid=cod_playerid;
				dataobj.playertype=cod_playertype;
				expage(dataobj);
			}else{
				console.log('选择正确的时间区间');
			}
		})
	}
	var changeTable=function(data,dataobj){
		var pageico=data[3];//当前页码
		var page=data[0];//总页数
		var data=data[1];//返回数据
		// var stime=;//查询开始时间
		// var etime=//查询结束时间
		// console.log(data);
		// return false;
		//$('#timespan').attr('data-begin',dataobj.bgtime).attr('data-end',dataobj.entime);
		var html='';
		$.each(data, function(index, val) {
			temp="<tr class='odd gradeX'><td class='center'>"+$(this)[0].userid+"</td>";
			temp+="<td class='center'>"+$(this)[0].nickname+"</td>";
			temp+="<td class='center'>"+$(this)[0].channel+"</td>";
			temp+="<td class='center'>"+$(this)[0].platform+"</td>";
			temp+="<td class='center'>"+$(this)[0].sex+"</td>";
			temp+="<td class='center'>"+$(this)[0].create_time+"</td>";
			temp+="<td class='center'>"+$(this)[0].login_time+"</td>";
			temp+="<td class='center'>"+$(this)[0].gold+"</td>";
			temp+="<td class='center'>"+$(this)[0].diamond+"</td>";
			temp+="<td class='center'>"+$(this)[0].luck_tick+"</td>";
			temp+="<td class='center'>"+$(this)[0].convert_tick+"</td>";
			temp+="<td class='center'>"+"..."+"</td><td class='center'>"+$(this)[0].rall+"</td>";
			temp+="<td class='center'>"+$(this)[0].r1+"</td>";
			temp+="<td class='center'>"+$(this)[0].r2+"</td>";
			temp+="<td class='center'>"+$(this)[0].r3+"</td></tr>"; 
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
		$.post("/qpht.php/gamemanage/seachdata",conds,function(data,status){
	  		changeTable(data,conds);
	  	});
	}
	//默认翻页方法
	var defaultexpage=function(){
		var cod_playerid=null;
		var cod_playertype=0;
		var gameid=$('#gameid').val();
		$('#pagenums').on('change',function(){
				dataobj.page=$(this).val();
				expage(dataobj);
			})
	}

	var ordercss=function(ele){
		if($(ele).hasClass('glyphicon-triangle-bottom')){
			$(ele).removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
			$('#timespan').val('DESC');
		}else{
			$(ele).removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');	
			$('#timespan').val('ASC');
		}
	}
	//排序方法
	var orderdata=function(){
		$('.ordersign').each(function(){
			$(this).on('click', function(event) {
				ordercss($(this).children('span'));
				dataobj.page=1;
				dataobj.ordertype=$('#timespan').val();
				dataobj.orderfield=$(this).attr('field');
				expage(dataobj);
			});
		})
	}
	initFun();
	ordercss();
	orderdata();
	defaultexpage();
	searchTime();
	gamechange();
})($);
