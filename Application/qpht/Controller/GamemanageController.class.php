<?php
namespace qpht\Controller;
use Think\Controller;
class GamemanageController extends BaseController {
    public function index(){
        $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 <b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
    }

    public function getcontion($id,$ex=false){
    	$dbmod=D('Gameinfo');
    	$dbdata=$dbmod->where('id='.$id)->select();
    	if($ex){
    		$dbname=$dbdata[0]['extable'];
    	}else{
    		$dbname=$dbdata[0]['dbname'];
    	}
    	$connection = array(
			    'db_type'    =>   'mysql',
			    'db_host'    =>   $dbdata[0]['dburl'],
			    'db_user'    =>   $dbdata[0]['dbuser'],
			    'db_pwd'     =>   $dbdata[0]['dbpwd'],
			    'db_port'    =>    3306,
			    'db_name'    =>    $dbname, 
			    'db_charset' =>    'utf8',
			);
    	return $connection;
    }
    public function gameManList(){
    	$this->getmenuInfo();
    	$dbmod=D('Gameinfo');
    	$dbdata=$dbmod->where('id=1')->select();
    	$connection = array(
			    'db_type'    =>   'mysql',
			    'db_host'    =>   $dbdata[0]['dburl'],
			    'db_user'    =>   $dbdata[0]['dbuser'],
			    'db_pwd'     =>   $dbdata[0]['dbpwd'],
			    'db_port'    =>    3306,
			    'db_name'    =>    $dbdata[0]['dbname'], 
			    'db_charset' =>    'utf8',
			);
    	$playerinfo=new \qpht\Model\PlayerinfoModel('playerinfo','tbl_',$connection);
    	$day=date("Y-m-d",time());
		$yday=date("Y-m-d",strtotime($day." -1 day"));
		$tday=date("Y-m-d",strtotime($day." +1 day"));
    	$cond['bgtime']=$yday;
    	$cond['entime']=$tday;
    	$pagecon=1;
    	$data=$playerinfo->getOneDay($pagecon,$cond);
    	$page=$data[0];
    	$datalist=$data[1];
    	$gameid=$data[2];
    	$this->assign('yday',$yday);
    	$this->assign('tday',$tday);
    	$this->assign('datalist',$datalist);
    	$this->assign('page',$page);
    	$this->assign('gameid',$gameid);
    	$this->display();
    }

    public function seachdata($conds=null){
    	if(!$conds){
    		$data=I('post.');
	    	$cond['page']=$data['page'];
	    	$cond['bgtime']=$data['bgtime'];
	    	$cond['entime']=$data['entime'];
	    	$cond['playid']=$data['playid'];
	    	$cond['playertype']=$data['playertype'];
	    	$cond['ordertype']=$data['ordertype'];
	    	$cond['orderfile']=C(ORDER_LIST)[$data['orderfield']];
	    	$cond['gameid']=$data['gameid'];//根据游戏ID来选择初始化的模型
    	}else{
    		$cond['page']=$conds['page'];
	    	$cond['bgtime']=$conds['bgtime'];
	    	$cond['entime']=$conds['entime'];
	    	$cond['playid']=$conds['playid'];
	    	$cond['playertype']=$conds['playertype'];
	    	$cond['ordertype']=$conds['ordertype'];
	    	$cond['orderfile']=C(ORDER_LIST)[$conds['orderfield']];
	    	$cond['gameid']=$conds['gameid'];//根据游戏ID来选择初始化的模型
    	}
    	// $cond['bgtime']='2018-04-13';
	    // $cond['entime']='2018-05-15';
	    //$cond['page']=1;
    	$dbmod=D('Gameinfo');
    	$gameid=$cond['gameid'];
    	$dbdata=$dbmod->where('id='.$gameid)->select();
    	$connection = array(
			    'db_type'    =>   'mysql',
			    'db_host'    =>   $dbdata[0]['dburl'],
			    'db_user'    =>   $dbdata[0]['dbuser'],
			    'db_pwd'     =>   $dbdata[0]['dbpwd'],
			    'db_port'    =>    3306,
			    'db_name'    =>    $dbdata[0]['dbname'], 
			    'db_charset' =>    'utf8',
			);
    	$playerinfo=new \qpht\Model\PlayerinfoModel('playerinfo','tbl_',$connection);
		$resdata=$playerinfo->getOneDay($cond['page'],$cond);
		//var_dump($resdata);
		if($conds){
			return $resdata;
		}else{
			$this->ajaxReturn($resdata);
		}
    }

    public function playsInfo(){
    	$this->getmenuInfo();
    	$connection=$this->getcontion(1);
    	$tableGameChange=new \qpht\Model\Game_change_goldModel('game_change_gold','table_',$connection);;
    	$day=date("Y-m-d",time());
		$yday=date("Y-m-d",strtotime($day." -1 day"));
		$tday=date("Y-m-d",strtotime($day." +1 day"));
    	$cond['bgtime']=$yday;
    	$cond['entime']=$tday;
    	$cond['page']=1;
    	$data=$tableGameChange->playsInfo($cond);
    	$pages=$data[0];
    	$resdata=$data[1];
    	$gameid=$data[2];
    	$page=$data[3];
    	$this->assign('pages',$pages);
    	$this->assign('resdata',$resdata);
    	$this->assign('gameid',$gameid);
    	$this->assign('page',$page);
    	$this->assign('yday',$yday);
    	$this->assign('tday',$tday);
    	$this->display();
    }

    public function seachdata2(){
    	$data=I('post.');
    	$cond['page']=$data['page'];
    	$cond['bgtime']=$data['bgtime'];
    	$cond['entime']=$data['entime'];
    	$cond['gameid']=$data['gameid'];
    	$cond['playid']=$data['playid'];
    	$this->getmenuInfo();
    	$connection = $connection=$this->getcontion($cond['gameid']);
    	$tableGameChange=new \qpht\Model\Game_change_goldModel('game_change_gold','table_',$connection);
    	$resdata=$tableGameChange->playsInfo($cond);
    	$this->ajaxReturn($resdata);   	
    }

    public function getexcel(){
    	$alldata=array();
    	$data=I('post.');
    	$cond['page']=1;
    	$cond['bgtime']=$data['bgtime'];
    	$cond['entime']=$data['entime'];
    	$cond['playid']=$data['playid'];
    	$cond['playertype']=$data['playertype'];
    	$cond['phone']=$data['phone'];
    	$cond['module']=$data['module'];
    	$cond['ordertype']=$data['ordertype'];
    	$cond['orderfile']=C(ORDER_LIST)[$data['orderfield']];
    	$cond['gameid']=1;
    	if($cond['module']=='1'){
    		$data=$this->seachdata($cond);
	    	foreach ($data[1] as $key => $value) {
	    		$temppval=array();
	    		array_push($temppval, $value['userid']);
				array_push($temppval, $value['nickname']);
				array_push($temppval, $value['channel']);
				array_push($temppval, $value['platform']);
				array_push($temppval, $value['sex']);
				array_push($temppval, $value['create_time']);
				array_push($temppval, $value['login_time']);
				array_push($temppval, $value['gold']);
				array_push($temppval, $value['diamond']);
				array_push($temppval, $value['luck_tick']);
				array_push($temppval, $value['convert_tick']);
				array_push($temppval, '...');
				array_push($temppval, $value['rall']);
				array_push($temppval, $value['r1']);
				array_push($temppval, $value['r2']);
				array_push($temppval, $value['r3']);
	    		array_push($alldata, $temppval);
	    	}
	    	for ($i=2; $i<=$data[0] ; $i++) { 
	    		$cond['page']=$i;
	    		$tempdata=$this->seachdata($cond);
	    		foreach ($tempdata[1] as $key => $value) {
		    		$temppval=array();
		    		array_push($temppval, $value['userid']);
					array_push($temppval, $value['nickname']);
					array_push($temppval, $value['channel']);
					array_push($temppval, $value['platform']);
					array_push($temppval, $value['sex']);
					array_push($temppval, $value['create_time']);
					array_push($temppval, $value['login_time']);
					array_push($temppval, $value['gold']);
					array_push($temppval, $value['diamond']);
					array_push($temppval, $value['luck_tick']);
					array_push($temppval, $value['convert_tick']);
					array_push($temppval, '...');
					array_push($temppval, $value['rall']);
					array_push($temppval, $value['r1']);
					array_push($temppval, $value['r2']);
					array_push($temppval, $value['r3']);
		    		array_push($alldata, $temppval);
			    }
	    	}
	    	$expTitle = "用户概况查询";
		    $expCellName = array(
	            array('ID', '昵称', '登录方式', '平台','性别','创建时间','最后登录时间','金币','钻石','福卡','兑换券','在线时长','游戏局数','初级场','中级场','高级场'),
	           );
    	}elseif ($cond['module']=='2') {
    		$data=$this->seachdata3($cond);
	    	foreach ($data[1] as $key => $value) {
	    		$temppval=array();
	    		array_push($temppval, $value['user_id']);
				array_push($temppval, C(GAME_LIST)[$data[2]]);
				array_push($temppval, '...');
				array_push($temppval, $value['goods_name']);
				array_push($temppval, $value['user_phone']);
	    		array_push($alldata, $temppval);
	    	}
	    	for ($i=2; $i<=$data[0] ; $i++) { 
	    		$cond['page']=$i;
	    		$tempdata=$this->seachdata3($cond);
	    		foreach ($tempdata[1] as $key => $value) {
		    		$temppval=array();
		    		array_push($temppval, $value['user_id']);
					array_push($temppval, C(GAME_LIST)[$data[2]]);
					array_push($temppval, '...');
					array_push($temppval, $value['goods_name']);
					array_push($temppval, $value['user_phone']);
		    		array_push($alldata, $temppval);
			    }
	    	}
	    	$expTitle = "兑换相关";
		    $expCellName = array(
	            array('用户ID', '兑换游戏', '兑换时间', '兑换物品','联系方式'),
	           );
    	}elseif($cond['module']=='3'){
    		$data=$this->seachdata4($cond);
	    	foreach ($data[1] as $key => $value) {
	    		$temppval=array();
	    		array_push($temppval, $value['paytime']);
				array_push($temppval, $value['payplayers']);
				array_push($temppval, $value['paynums']);
				array_push($temppval, $value['paymoney']);
				array_push($temppval, $value['newpayplayers']);
				array_push($temppval, $value['newpaynums']);
				array_push($temppval, $value['newpaymoney']);
	    		array_push($alldata, $temppval);
	    	}
	    	for ($i=2; $i<=$data[0] ; $i++) { 
	    		$cond['page']=$i;
	    		$tempdata=$this->seachdata3($cond);
	    		foreach ($tempdata[1] as $key => $value) {
		    		$temppval=array();
		    		array_push($temppval, $value['paytime']);
					array_push($temppval, $value['payplayers']);
					array_push($temppval, $value['paynums']);
					array_push($temppval, $value['paymoney']);
					array_push($temppval, $value['newpayplayers']);
					array_push($temppval, $value['newpaynums']);
					array_push($temppval, $value['newpaymoney']);
		    		array_push($alldata, $temppval);
			    }
	    	}
	    	$expTitle = "充值模块";
		    $expCellName = array(
	            array('充值日期', '充值人数', '充值次数', '充值金额','新增充值人数','新增充值次数','新增充值金额'),
	           );
    	}
    	
	    $this->exportExcel($expTitle,$expCellName,$alldata);
    }

    //兑换相关
    public function convertGoods(){
    	$this->getmenuInfo();
    	$cond['gameid']=1;
    	$cond['page']=1;
    	$cond['user_id']=null;
    	$cond['phone']=null;
    	$connection = $connection=$this->getcontion($cond['gameid']);
    	$tableGameChange=new \qpht\Model\Convert_goodModel('convert_good','tbl_',$connection);
    	//$convertGoods=new  \qpht\Model\Convert_goodModel();
    	$data=$tableGameChange->convertGoods($cond);
    	$pages=$data[0];
    	$resdata=$data[1];
    	$gameid=$data[2];
    	$page=$data[3];
    	$this->assign('pages',$pages);
    	$this->assign('resdata',$resdata);
    	$this->assign('gameid',$gameid);
    	$this->assign('page',$page);
    	$this->display();
    }
    //兑换查询
    public function seachdata3($conds=null){
    	$data=I('post.');
    	$cond['page']=$data['page'];
    	$cond['gameid']=$data['gameid'];
    	$cond['user_id']=$data['playid'];
    	$cond['phone']=$data['phone'];
    	$cond['orderfile']=C(ORDER_LIST)[$data['orderfield']];
    	$cond['ordertype']=$data['ordertype'];
    	$connection = $connection=$this->getcontion($cond['gameid']);
    	$convertGoods=new \qpht\Model\Convert_goodModel('convert_good','tbl_',$connection);
		$resdata=$convertGoods->convertGoods($cond);
		if($conds){
			return $resdata;
		}else{
    		$this->ajaxReturn($resdata);
		}
    	
    }

    //充值模块
    public function recharge(){
    	$this->getmenuInfo();
    	$cond['page']=1;
    	$cond['gameid']=1;
    	$connection=$this->getcontion($cond['gameid'],true);
    	$rechargedb=new \qpht\Model\Pay_infoModel('pay_info','tbl_',$connection);
    	$data=$rechargedb->payInfoCount($cond);
    	$pages=$data[0];
    	$resdata=$data[1];
    	$gameid=$data[2];
    	$page=$data[3];
    	$this->assign('pages',$pages);
    	$this->assign('resdata',$resdata);
    	$this->assign('gameid',$gameid);
    	$this->assign('page',$page);
    	$this->display();
    }

    //充值查询
    public function seachdata4($conds=null){
    	$data=I('param.');
    	$cond['page']=$data['page'];
    	$cond['gameid']=$data['gameid'];
    	$connection=$this->getcontion($cond['gameid'],true);
    	$rechargedb=new \qpht\Model\Pay_infoModel('pay_info','tbl_',$connection);	
		$resdata=$rechargedb->payInfoCount($cond);
		if($conds){
			return $resdata;
		}else{
    		$this->ajaxReturn($resdata);
		}
    	
    }
}