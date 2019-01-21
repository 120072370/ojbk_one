﻿<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$sub = 6;

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "agent_reg.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr class="tic">
                <td>会员账号</td>
                <td>真实姓名</td>
                <td>注册时间(美东/北京)</td>
                <td>最近登录(美东/北京)</td>
                <td>当前余额</td>
				<td>下级总计</td>
                <td>在线</td>
                <td>状态</td>
				<td>推广链接</td>
				<td><strong>操作</strong></td>
            </tr>
            <?php

			/******************** 删除 ********************/
			$did	=	0;
			if($_GET['did'] > 0){
				$did	=	$_GET['did'];
			}
			if ($_GET["action"] == "del" && $did > 0) {
				$sql		=	"delete from k_user where uid=$did";
				$mysqli->query($sql);
			}
			/******************** 启用/停用 ********************/
			if ($_GET["action"] == "stop" && $did > 0) {
				$sql		=	"update k_user set is_stop='{$_GET['isstop']}' where uid=$did";
				$mysqli->query($sql);
			}
			/******************** 删除 ********************/

            $sql	=	"select uid from k_user where top_uid=$uid and is_daili=1";
			
			if(isset($_GET["stop"])){
				$sql	.=	" and `is_stop`=".$_GET["stop"];
			}
			if(isset($_GET['username'])){
				$sql	.=	" and username like ('%".$_GET['username']."%')";
			}

			$sql	.=	" order by uid desc";

            $query	=	$mysqli->query($sql);
            $sum	=	$mysqli->affected_rows; //总页数
            $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
            }
            $page		=	new newPage();
            $perpage	= 	15;
            $thisPage	=	$page->check_Page($thisPage,$sum,$perpage);
            $id		=	'';
            $i		=	1; //记录 uid 数
            $start	=	($thisPage-1)*$perpage+1;
            $end	=	$thisPage*$perpage;
            while($row = $query->fetch_array()){
                if($i >= $start && $i <= $end){
                    $id .=	$row['uid'].',';
                }
                if($i > $end) break;
                $i++;
            }
            if($id) {
                $id		=	rtrim($id,',');
                $sql	=	"select u.*,l.is_login from k_user u left outer join k_user_login l on u.uid=l.uid where u.uid in($id) order by u.uid desc";
                $query	=	$mysqli->query($sql);
                $sum_money	=	0;
                $sum_sxf	=	0;
                while($rows = $query->fetch_array()) {
                    ?>
                    <tr class="list">
                        <td><?=$rows["username"]?></td>
                        <td><?=$rows["pay_name"]?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"])+1*12*3600)?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["login_time"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["login_time"])+1*12*3600)?></td>
                        <td><?=sprintf("%.2f",$rows["money"])?></td>
						<?php
              				$sqlnum   =   "select count(*) as nums from k_user where top_uid='{$rows['uid']}'";
							$querynum	=	$mysqli->query($sqlnum);
			  				$rowsnum  =   $querynum->fetch_array()
						 ?>
						<td><?=$rowsnum['nums']?></td>
                        <td><?=$rows["is_login"]==1?"<span class='c_red'>在线</span>":"离线"?></td>
                        <td><?=$rows["is_stop"]==0?"<span class='c_red'>启用</span>":"停用"?></td>
						<td>http://<?= $_SERVER['SERVER_NAME']?>/?f=<?=$rows["username"]?></td>
						
						<td> 
              <?
              if($rows["is_stop"]==0){
			  ?>
			  <div>
              	<div style="float:left">
              		<a onClick="return confirm('确认停用该代理？');" href="agent_daili.php?did=<?=$rows["uid"]?>&action=stop&isstop=1">停用</a></div>
              <?php
			  }
			  else{
			  ?>
           		<div style="float:left">
                	<a onClick="return confirm('确认启用该代理？');" href="agent_daili.php?did=<?=$rows["uid"]?>&action=stop&isstop=0">启用</a></div>
		   		</div>
              <? }?>
			  	
                <div style="float:left">
                	&nbsp;/&nbsp;
                </div>
                <div style="float:left">
              		<a onClick="return confirm('确定要删除该代理？');" href="agent_daili.php?did=<?=$rows["d_id"]?>&action=del">删除</a>
              	</div>
              </div></td>

                    </tr>
                    <?php
                }
            } else { ?>
                <tr align="center">
                    <td colspan="7">暂无下级代理！</td>
                </tr>
            <?php } ?>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" class="page">
            <tr>
                <td align="left">下级代理总数：<span class="c_red"><?=$sum?></span></td>
                <td align="right"><?=$page->get_htmlPage("agent_user.php?");?></td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>
