<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>棋牌后台</title>
    <!-- Bootstrap Styles-->
    <link href="/Public/qpht/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="/Public/qpht/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="/Public/qpht/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="/Public/qpht/assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/Public/qpht/assets/js/Lightweight-Chart/cssCharts.css"> 
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <link rel="stylesheet" href="/Public/qpht/assets/css/selfstyle.css">
    <link rel="stylesheet" href="/Public/qpht/assets/css/jquery.datetimepicker.css">
    <script src="/Public/qpht/assets/js/jquery-1.10.2.js"></script>
    <script type="text/javascript">
         function loadSource(src){
            this.src = src;
            var type = src.split(".").pop();
            var s = document.createElement('script');
            s.src = this.src+"?"+Math.random();
            s.async = true;
            $('#footscript').append(s);
        }
    </script>
    <script type="text/javascript">
        Date.prototype.format = function (format) {
        var args = {
            "M+": this.getMonth() + 1,
            "d+": this.getDate(),
            "h+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
        };
        if (/(y+)/.test(format))
            format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var i in args) {
            var n = args[i];
            if (new RegExp("(" + i + ")").test(format))
                format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? n : ("00" + n).substr(("" + n).length));
        }
        return format;
    };
    </script>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" id="test44"><strong >点秦棋牌后台</strong></a>
                
        <div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> 用户信息</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> 设置</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);" id="outsystem"><i class="fa fa-sign-out fa-fw"></i> 登出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <input type="hidden" name="" id="aclog" value="/<?php echo ($actionname); ?>/<?php echo ($actionname2); ?>">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <?php if(is_array($moduleinfo1)): $i = 0; $__LIST__ = $moduleinfo1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vmodules): $mod = ($i % 2 );++$i;?><li class="acli" data-vx='<?php echo ($vmodules["modulename"]); ?>'>
                            <a href="#"><i class="fa fa-sitemap"></i> <?php echo ($vmodules["modulename"]); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <?php if(is_array($menuinfo1)): $i = 0; $__LIST__ = $menuinfo1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vmenus): $mod = ($i % 2 );++$i; if(is_array($vmenus)): $i = 0; $__LIST__ = $vmenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vmenuss): $mod = ($i % 2 );++$i; if($vmodules["id"] == $vmenuss['moduleid']): ?><li data-cc='mx'>
                                            <a href="/qpht.php<?php echo ($vmenuss["menurl"]); ?>" class="menuac"><?php echo ($vmenuss["menuname"]); ?></a>
                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>  
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
      
        <div id="page-wrapper">
          <div class="header"> 
                        <h1 class="page-header">
                          <small>欢迎 <?php echo ($username); ?></small>
                        </h1>
                        <ol class="breadcrumb">
                      <li><a href="/qpht.php/index/index">首页</a></li>
                      <li><a href="<?php echo ($actions); ?>"><?php echo ($mdname); ?></a></li>
                    </ol> 
                                    
        </div>
            <div id="page-inner">
                
    <div id="page-inner">                
            <div class="row">
            	<div class="col-md-12">
            		<button type="button" id="addbtn" class="btn btn-default" aria-label="Left Align" data-toggle="modal" data-target="#myModal">
					  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default" aria-label="Left Align" id="removebtn" laytype="user/accountRemove" data-target="#rementer">
					  <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default" aria-label="Left Align" id="editbtn" laytype="layaccount">
					  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</button>
					
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">新增账户</h4>
					        <div class=".container-fluid">
					        	<form class="form-horizontal" action="" method="post" id="addmenu" name="addmenu">
					        	  <input type="hidden" name="actiontype" id="actiontype" value="1">
					        	  <input type="hidden" name="roleidss" id="roleidss" value="">
					        	  <input type="hidden" name="accountid" id="accountid" value=""> 
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-3 control-label">账号：</label>
								    <div class="col-sm-9">
								      <input style="width: 70%" type="text" class="form-control" id="a_name" placeholder="账号" name="a_name">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-3 control-label">密码：</label>
								    <div class="col-sm-9">
								      <input style="width: 70%" type="text" class="form-control" id="a_pwd" placeholder="密码" name="a_pwd">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-3 control-label">所属角色：</label>
								    <div class="col-sm-9">
								    	<?php if(is_array($roleinfo)): foreach($roleinfo as $key=>$vo): ?><label class="checkbox-inline">
												  <input type="checkbox" class="roles" id="roleinfo" value="<?php echo ($key); ?>" name="roles"> <?php echo ($vo); ?>
											  </label><?php endforeach; endif; ?>
								    </div>
								  </div>	
								  <div class="form-group">
								  	<label for="inputEmail3" class="col-sm-3 control-label">是否为开发者：</label>
								    <label class="radio-inline">
										  <input type="radio" name="is_dev" id="isdev1" class="isdev" value="1"> 是
										</label>
										<label class="radio-inline">
										  <input checked="checked" type="radio" name="is_dev" id="isdev2" class="isdev" value="2"> 否
										</label>
								  </div>
								  <div class="form-group" id="partners" style="display: none;">
								    <label for="inputEmail3" class="col-sm-3 control-label">合作方id：</label>
								    <div class="col-sm-9">
								      <input style="width: 70%" type="text" class="form-control" id="a_partnersid" placeholder="合作方id" name="a_partnersid">
								    </div>
								  </div>
								  <div class="form-group" id="ismenu">
								  	 <label for="inputEmail3" class="col-sm-3 control-label">状态：</label>
								  	 <div class="col-sm-5">
								  	 	<select class="form-control" name="a_state" id="a_state">
								  	 	  	<option value="1">启用</option>
								  	 	  	<option value="0">禁用</option>
										</select>
								  	 </div>
								  </div>
								  <div class="form-group">
								  	<label for="inputEmail3" class="col-sm-3 control-label">备注：</label>
								  	<div class="col-sm-10 col-sm-offset-3">
								    	<textarea class="form-control" name="a_des" id="a_des" rows="3" style="width: 80%"></textarea>
									</div>
								  </div>
								</form>
					        </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal" id="modalclose">取消</button>
					        <button type="button" class="btn btn-primary" id="accountbtn" data-dismiss="modal" formid="addmenu">保存</button>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- Modal -->
            	</div>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           账户管理
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>账号</th>
                                            <th>昵称</th>
                                            <th>状态</th>
                                            <th>备注</th>
                                            <th>所属用户组</th>
                                            <th>更新时间</th>
                                    </thead>
                                    <tbody>
                                		<?php if(is_array($accountlist)): $i = 0; $__LIST__ = $accountlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$account): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
		                                            <td>
		                                            		<label>
		                                            			<input type="checkbox" class="selcheck" value="<?php echo ($account["id"]); ?>">
		                                            		</label>
		                                            		<?php echo ($account["accountname"]); ?>
		                                            </td>
		                                            <td class="center"><?php echo ($account["accountsecond"]); ?></td>
		                                            <td class="center">
															<?php if($account["state"] == 1 ): ?>启用
															    <?php else: ?> 禁用<?php endif; ?>
		                                            </td>
		                                            <td class="center"><?php echo ($account["remarks"]); ?></td>
		                                            <td class="center"><?php echo ($account["roleids"]); ?></td>
		                                            <td class="center"><?php echo ($account["uptime"]); ?></td>
		                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                                <p><?php echo ($page); ?></p>
                            </div>   
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="rementer">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		      </div>
		      <div class="modal-body">
		        <p>确定删除么？</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
		        <button type="button" class="btn btn-default" id="removeenterbtn">YES</button>
		      </div>
		    </div>
		  </div>
		</div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
     <div id="footscript"></div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
   
   <!--  <script src="/Public/qpht/assets/js/jquery.js"></script> -->
    <!-- Bootstrap Js -->
    <script src="/Public/qpht/assets/js/bootstrap.min.js"></script>
    <script src="/Public/qpht/assets/js/jquery.datetimepicker.full.js"></script>
    <!-- Metis Menu Js -->
    <script src="/Public/qpht/assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <!-- <script src="/Public/qpht/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="/Public/qpht/assets/js/morris/morris.js"></script> -->
    
    
    <script src="/Public/qpht/assets/js/easypiechart.js"></script>
    <script src="/Public/qpht/assets/js/easypiechart-data.js"></script>
    
     <script src="/Public/qpht/assets/js/Lightweight-Chart/jquery.chart.js"></script>
     <script src="/Public/qpht/assets/js/pubfunction.js"></script>
    
    <!-- Custom Js -->
    <script src="/Public/qpht/assets/js/custom-scripts.js"></script>
    
      <script>
        $('#begin_time').datetimepicker({
            lang:'ch',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d'
        }); 
        $('#end_time').datetimepicker({
            lang:'ch',
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y/m/d'
        });
        new loadSource("/Public/qpht/assets/js/accountfun.js");  
      </script>
   
</body>

</html>