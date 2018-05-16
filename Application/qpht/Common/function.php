<?php
/*验证码*/
function check_verify($code, $id = ""){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 */
function think_ucenter_md5($str, $key = 'ThinkUCenter'){
	return '' === $str ? '' : md5(sha1($str) . $key);
}

function getYesterdar(){
	$now=time();
	$yesterday=getdate($now)['mday']-1;
	$year=getdate($now)['year'];
	$month=getdate($now)['mon'];
	if($yesterday<10){
		$yesterday='0'.$yesterday;
	}
	if($month<10){
		$month='0'.$month;
	}
	return $year.'-'.$month.'-'.$yesterday;
}

function formatDay1($str){
	$temp=explode('-', $str);
	if($temp[1]<10){
		$temp[1]='0'.$temp[1];
	}
	if($temp[2]<10){
		$temp[2]='0'.$temp[2];	
	}
	return $temp[0].'-'.$temp[1].'-'.$temp[2]; 
}

function dayConditionFormat($dayarr){
	$res=array();
	$res[0]=formatDay1($dayarr[0]);
	$res[1]=date("Y-m-d",strtotime($dayarr[count($dayarr)-1]." -1 day"));
	//$res[1]=$dayarr[count($dayarr)-1];
	return $res;
}


// function create_xls($data,$filename='simple.xls'){
//     ini_set('max_execution_time', '0');
//     Vendor('PHPExcel.PHPExcel');
//     $filename=str_replace('.xls', '', $filename).'.xls';
//     $phpexcel = new PHPExcel();
//     $phpexcel->getProperties()
//         ->setCreator("Maarten Balliauw")
//         ->setLastModifiedBy("Maarten Balliauw")
//         ->setTitle("Office 2007 XLSX Test Document")
//         ->setSubject("Office 2007 XLSX Test Document")
//         ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//         ->setKeywords("office 2007 openxml php")
//         ->setCategory("Test result file");
//     $phpexcel->getActiveSheet()->fromArray($data);
//     $phpexcel->getActiveSheet()->setTitle('Sheet1');
//     $phpexcel->setActiveSheetIndex(0);
//     header('Content-Type: application/vnd.ms-excel');
//     header("Content-Disposition: attachment;filename=$filename");
//     header('Cache-Control: max-age=0');
//     header('Cache-Control: max-age=1');
//     header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
//     header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
//     header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
//     header ('Pragma: public'); // HTTP/1.0
//     $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
//     $objwriter->save('php://output');
//     exit;
// }
