var pubFun=(function($){
	// var navSetAction = function(){
	// 	var ac='/qpht.php'+$('#aclog').val();
	// 	// $('.acli').on('click',function(){
	// 	// 	console.log($(this).attr('data-vx'));
	// 	// })
	// 	$('.menuac').each(function(index, el) {
	// 		if (ac.toLowerCase()==$(this).attr('href')) {
	// 			 setTimeout(function($(this)){console.log($(this))},1000);
	// 			//setTimeout(function(){$('.sr-only').click();},1000);
	// 		}
	// 	});

	// }
	var dataobj={
				bgtime:null,
				entime:null,
				gameid:1,
				playid:null,
				ordertype:null,
				orderfield:null,
				phone:null,
				playertype:null,
				module:null,
				page:1
			};
	var fynum=20;
	var getexcel=function(){
		$('#getexclbtn').on('click',function(){
			$.ajax({
			    type: "post",
			    data: dataobj,
			    url: "/qpht.php/gamemanage/getexcel",
			    beforeSend: function () {
			        // 禁用按钮防止重复提交，发送前响应
			        pubFun.showloading();
			    },
			    success: function (data) {
			        	//console.log(data);
			            pubFun.hideloading();
			            var $eleForm = $("<form method='get'></form>");
			            $eleForm.attr("action",data.url);
			            $(document.body).append($eleForm);
			            $eleForm.submit(); 
			    },
			    complete: function () {//完成响应
			         
			    },
			    error: function (data) {
			        console.info("error: " + data.responseText);
			    }
			});
		})
	}
	var initLoading = function(){
	    $("body").append("<!-- loading -->" +
	            "<div class='modal fade' id='loading' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' data-backdrop='static'>" +
	            "<div class='modal-dialog' role='document'>" +
	            "<div class='modal-content'>" +
	            "<div class='modal-header'>" +
	            "<h4 class='modal-title' id='myModalLabel'>提示</h4>" +
	            "</div>" +
	            "<div id='loadingText' class='modal-body'>" +
	            "<span class='glyphicon glyphicon-refresh' aria-hidden='true'>1</span>" +
	            "处理中，请稍候。。。" +
	            "</div>" +
	            "</div>" +
	            "</div>" +
	            "</div>"
	    );
	}

	var showloading=function (text){
	    $("#loadingText").html(text);
	    $("#loading").modal("show");
	}

	var hideloading=function (){
	    $("#loading").modal("hide");
	}
	var getgamename = function(i){
		switch(i)
		{
			case '1':
			    return "血流麻将";
			case '2':
				return "三人斗地主";
			default:
				console.log('c');
		}
	}
	var formreset = function(){
		$('#addmenu')[0].reset();
		$("#actiontype").val(1);
		$('#menuid').val('');
		$('#ismenu').hide();
		$('#menurl').hide();
	}
	var pubaction = function(){
		$('#addbtn').on('click',function(){
			formreset();
		});
		$('#editbtn').on('click',function(){
			formreset();
		});
	}

	var messagewarn =function(state){
		if(state==1){
			alert('操作成功');
		}else{
			alert('操作失败');
		}
		location.reload();
	}
	var formoption = function(){
		$('#menutype1').on('click',function(){
			 $('#ismenu').hide();
			 $('#menurl').hide();
            });
		$('#menutype2').on('click',function(){
			 $('#ismenu').show();
			 $('#menurl').show();
            });
	}
	var menuadd = function(){
		$('#menuaddbtn').on('click',function(argument) {
		  var formid=$(this).attr('formid');
		  var dataobj=$('#'+formid).serialize();
		  $.post("/qpht.php/index/menuChangAction",dataobj,function(data,status){
		  		messagewarn(data.state);
		  });
		  $('#'+formid).modal('hide');
		})
	}

	var getElNum = function(){
		var selelem=new Array();
		$('.selcheck').each(function(index, el) {
			if($(this).prop('checked')){
				selelem.push($(this).val());
			}
		});
		return selelem;
	}
	var removepub = function(){
		$('#removebtn').on('click',  function(event) {
			event.preventDefault();
			/* Act on the event */
			formreset();
			var el=getElNum();
			if(el.length<1){
				alert('请至少选择一条数据');
			}else{
				$('#rementer').modal('show');
			}

		});
		$('#removeenterbtn').on('click',function(argument){
			var laytype=$('#removebtn').attr('laytype');
			var el=getElNum();
			$.post('/qpht.php/'+laytype, {ids: el}, function(data, textStatus, xhr) {
				messagewarn(data.state);
			})
			$('#rementer').modal('hide');
		})
	}
	var editpub =function(){
		$('#editbtn').on('click',function(argument){
			var laytype=$(this).attr('laytype');
			var el=getElNum();
			if(el.length!=1){
				alert('请选择一个进行操作');
			}else{
				if(laytype==='layrole'){
					roledit(el[0]);
				}else if(laytype==='laymeun'){
					menuedit(el[0]);
				}else if(laytype==='layaccount'){
					accfun.accountEdit(el[0]);
				}
			}
	})
}
	var menuedit = function(menuid){
				$.post('/qpht.php/index/getonemenuInfo', {menuid: menuid}, function(data, textStatus, xhr) {
			  		$('#myModalLabel').text('编辑菜单');
			  		$('#menuid').val(data.id);
			  		$('#m_name').val(data.menuname);
			  		$('#menutype2').prop('checked','checked');
			  		$("#m_module option").each(function(index, el) {
			  			if($(this).val()==data.moduleid){
			  				$(this).attr("selected","selected");
			  			}
			  		});
			  		$("#menurl").val(data.menurl);
			  		$("#m_sortnum").val(data.sortnum);
			  		$("#m_des").val(data.describe);
			  		$("#actiontype").val(2);
			  		$('#ismenu').show();
			 		$('#menurl').show();
			 		$('#myModal').modal('show');
				});		
	}

	var roledit = function(roleid){
		$.post('/qpht.php/user/getonerole', {roleid: roleid}, function(data, textStatus, xhr) {
			  		//console.log(JSON.stringify(data));
			  	 	$('#myModalLabel').text('编辑角色');
			  	 	$('#roleid').val(data.id);
			  	 	$('#r_name').val(data.solename);
			  	 	$jurarr=data.jurisdiction.split(",");
			  	 	$("#addmenu input[type=checkbox]").each(function(index, el) {
			  	 		$(this).prop("checked", false);
			  	 		if($.inArray($(this).val(), $jurarr)>=0){
			  	 			$(this).prop("checked", true);
			  	 		};
			  	 	});
			  	 	$("#r_des").val(data.roledescribe);
			  	 	$("#actiontype").val(2);
			 	    $('#myModal').modal('show');
				});
	}
	var roleadd = function(){
		$('#roleaddbtn').on('click',function(){
			  var formid=$(this).attr('formid');
			  $('#menuidss').val($(('#'+formid)+' input[type=checkbox]:checked').map(function(){return this.value}).get().join(','));
			  var dataobj=$('#'+formid).serialize();
			  console.log(dataobj);
			  $.post("/qpht.php/user/roleAction",dataobj,function(data,status){
			  		messagewarn(data.state);
			  });
			  $('#'+formid).modal('hide');
		})
	}
	var outsystem=function(){
		$('#outsystem').on('click',function(){
			$.post('/qpht.php/publics/systemout', {data:0}, function(data, textStatus, xhr) {
					alert('退出成功');
				    window.location.href="/qpht.php/Publics/loginShow"; 
			});
		})
	}
	//js时间格式化函数
	editpub();
	menuadd();
	formoption();
	roleadd();
	removepub();
	pubaction();
	outsystem();
	initLoading();
	getexcel();
	// navSetAction();
	return {
		messagewarn:messagewarn,
		fynum:fynum,
		getgamename:getgamename,
		dataobj:dataobj,
		showloading:showloading,
		hideloading:hideloading,
	}
})($);
