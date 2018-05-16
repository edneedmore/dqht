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
 * 血流麻将模块模型
 *1:血流麻将
 * @author ed <xie5296808@163.com>
 */

class AccountxlmjModel extends Model {
	// protected $connection = 'DB_CONFIG2';
	// protected $tablePrefix = 'tbl_';
	// protected $tableName = 'account'; 
	
	public function getDayInfo($gameid){
		$now=time();
		$timestr=date('Y-m-d', $now);
		$dayinfo=$this->query("select DATE_FORMAT(create_time,'%Y-%m-%d') days,count(userid),count(login_time) from tbl_account where DATE_FORMAT(create_time,'%Y-%m-%d')!='".$timestr."'  group by days DESC");
		$allplaynum=$this->query("select DATE_FORMAT(change_time,'%Y-%m-%d') days,count(user_id),count(DISTINCT user_id) from table_game_change_gold where user_id<1000 and DATE_FORMAT(change_time,'%Y-%m-%d') !='".$timestr."'group by days DESC");
		// $data=array();
		// for ($i=0; $i <count($dayinfo) ; $i++) {
		// 	$data[$i]['gameid']=1;
		// 	$data[$i]['countime']=$dayinfo[$i]['days'];
		// 	$data[$i]['newplayer']=$dayinfo[$i]['count(userid)'];
		// 	$data[$i]['oldplayer']='0';
		// 	$data[$i]['activeplayer']=$dayinfo[$i]['count(login_time)'];
		// 	$data[$i]['allplay']='';
		// 	$data[$i]['avplay']='';
		// 	for ($j=0; $j < count($allplaynum); $j++) { 
		// 		if($dayinfo[$i]['days']==$allplaynum[$j]['days']){
		// 			$data[$i]['allplay']=$allplaynum[$j]['count(user_id)'];
		// 			$data[$i]['avplay']=$allplaynum[$j]['count(distinct user_id)'];
		// 		}
		// 	 } 
		// }
		return $this->formatTableAcc($dayinfo,$allplaynum,$gameid);
	}
	protected function formatTableAcc($data1,$data2,$gameid){
		$data=array();
		for ($i=0; $i <count($data1) ; $i++) {
			$data[$i]['gameid']=$gameid;
			$data[$i]['countime']=$data1[$i]['days'];
			$data[$i]['newplayer']=$data1[$i]['count(userid)'];
			$data[$i]['oldplayer']='0';
			$data[$i]['activeplayer']=$data1[$i]['count(login_time)'];
			$data[$i]['allplay']='0';
			$data[$i]['aveplay']='0';
			for ($j=0; $j < count($data2); $j++) { 
				if($data1[$i]['days']==$data2[$j]['days']){
					$data[$i]['allplay']=$data2[$j]['count(user_id)'];
					$data[$i]['aveplay']=$data2[$j]['count(distinct user_id)'];
					$data[$i]['aveplay']=ceil($data[$i]['allplay']/$data[$i]['aveplay']);
				}
			 } 
		}
		return $data;
	}
	public function upDataSome($daydata,$gameid){
		$daycondition=dayConditionFormat($daydata);
		$dayinfo=$this->query("select DATE_FORMAT(create_time,'%Y-%m-%d') days,count(userid),count(login_time) from tbl_account where create_time BETWEEN '".$daycondition[1]."' AND '".$daycondition[0]."' group by days DESC");
		$allplaynum=$this->query("select DATE_FORMAT(change_time,'%Y-%m-%d') days,count(user_id),count(DISTINCT user_id) from table_game_change_gold where user_id<1000 and change_time BETWEEN '".$daycondition[1]."' AND '".$daycondition[0]."' group by days DESC");
		return $this->formatTableAcc($dayinfo,$allplaynum,$gameid);
	}
}
