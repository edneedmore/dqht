<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: ed <xie5296808@163.com>
// +----------------------------------------------------------------------

namespace qpht\Model;
use Think\Model;

/**
 * 菜单模块模型
 * @author ed <xie5296808@163.com>
 */

class GamemainModel extends Model {
	protected $connection = 'DB_CONFIG1';
	protected $tablePrefix = 'qp_';
	public function updatadb(){
		//更新首页统计数据；qp_gamemain
		$dbmod=D('Gameinfo');
		$gamesinfo=$dbmod->select();
		foreach ($gamesinfo as $key => $value) {
			$connection = array(
			    'db_type'    =>   'mysql',
			    'db_host'    =>   $value['dburl'],
			    'db_user'    =>   $value['dbuser'],
			    'db_pwd'     =>   $value['dbpwd'],
			    'db_port'    =>    3306,
			    'db_name'    =>   $value['dbname'],
			    'db_charset' =>    'utf8'
			);
			$this->dataupdata($connection,$value['id']);
		}
	}

	protected function dataupdata($connection,$gameid){
		$accountxlmj=new \qpht\Model\AccountxlmjModel('account','tbl_',$connection);
		//$accountxlmj = new AccountxlmjModel();
		$dbupdata= new DbupdataModel();
		$now=time();
		$nowday=date('Y-m-d', $now);
		$res1=$this->where('gameid='.$gameid)->order('id')->find();
		if($res1){
			$newuptime=$dbupdata->getupnew($gameid);
			if($newuptime['uptime']!=$nowday){
				$nowdays=getdate($now)['yday'];
				$updays=getdate(strtotime($newuptime['uptime']))['yday'];
				$res=$nowdays-$updays;
				$needay=array();
				if($res>0){
					for ($i=0; $i <$res ; $i++) { 
						$contime=date("Y-m-d",strtotime($nowday."-".$i." day"));
						array_push($needay, $contime);
					}
					$data=$accountxlmj->upDataSome($needay,$gameid);
					$this->addAll($data);
					$dbupdata->dbUp($nowday,$gameid);
				}
			}
		}else{
			$data=$accountxlmj->getDayInfo($gameid);
			$this->addAll($data);
			$dbupdata->dbUp($nowday,$gameid);
		}
	}

	// public function AllOrSome($key){
	// 	$sysgameuser=D('Gameuser');
	// 	$res=$sysgameuser->order('reactime desc')->where('gameid='.$key)->find('reactime');
	// 	if($res){
	// 		//局部更新
	// 		echo "1";
	// 	}else{
	// 		//全局更新
	// 		echo "2";
	// 	}
	// }

	public function GamePlayerInfo($key){
		if($key==1){
			$gameplayinfo = new PlayerinfoModel();
			$res=$gameplayinfo->getOneDay();
		}
	}
}