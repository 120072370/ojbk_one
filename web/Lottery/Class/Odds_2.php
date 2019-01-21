<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
//开始读取赔率
$sql		= "select * from c_odds_2 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<16; $i++){
		$list['ball'][$s][$i] = $odds['h'.$i];
	}
	$s++;
}
//开始读取期数
$sql		= "select * from c_opentime_2 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
if($qs){
	$qishu		= date("Ymd",$lottery_time).BuLings($qs['qishu']);
	$fengpan	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['fengpan'])-$lottery_time;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
}else{
	$sql		= "select * from c_opentime_2 where qishu=25";
	$query		= $mysqli->query($sql);
	$qs		= $query->fetch_array();
	if($qs){
		$day=$lottery_time;
		$qishu		= date("Ymd",$day).BuLings($qs['qishu']);
		$fengpan	= $day - strtotime(date("Y-m-d",$day).' '.$qs['fengpan']);
		$kaijiang	= $day - strtotime(date("Y-m-d",$day).' '.$qs['kaijiang']);
	}else{
		$qishu		= -1;
		$fengpan	= -1;
		$kaijiang	= -1;
	}
}
$arr = array(   
    'number' => $qishu, 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,
	'oddslist' => $list,    
);  
$json_string = json_encode($arr);   
echo $json_string; 
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
/*
数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
*/
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	return $num;
}
?> 