<?php
include("../common/login_check.php");
check_quanxian("ssgl");   
include("../../include/mysqli.php");
include("../../include/pager.class.php");
include("auto_class.php");
include ("../../Lottery/include/order_info.php");
if(is_numeric($_REQUEST['type'])){
	$gameId=intval($_REQUEST['type']);
}else{
	$gameId=get_gameType_self();
}
if(!$gameId) $gameId=4;
$gameName=get_gameName($gameId);
$id	=	0;
if($_GET['id'] > 0){
	$id	=	intval($_GET['id']);
}
if($_REQUEST['page']==''){
	$_REQUEST['page']=1;
}
if($_GET["action"]=="add" && $id==0){ 
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$ball_8		=	$_POST["ball_8"];
	$ball_9		=	$_POST["ball_9"];
	$ball_10    =	$_POST["ball_10"];
	$sql		=	"insert into c_auto_$gameId(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values (".$qishu.",'".$datetime."',".$ball_1.",".$ball_2.",".$ball_3.",".$ball_4.",".$ball_5.",".$ball_6.",".$ball_7.",".$ball_8.",".$ball_9.",".$ball_10.")";
    $mysqli->query($sql);
}elseif($_GET["action"]=="edit" && $id>0){
	$qishu		=	$_POST["qishu"];
	$datetime	=	$_POST["datetime"];
	$ball_1		=	$_POST["ball_1"];
	$ball_2		=	$_POST["ball_2"];
	$ball_3		=	$_POST["ball_3"];
	$ball_4		=	$_POST["ball_4"];
	$ball_5		=	$_POST["ball_5"];
	$ball_6		=	$_POST["ball_6"];
	$ball_7		=	$_POST["ball_7"];
	$ball_8		=	$_POST["ball_8"];
	$ball_9		=	$_POST["ball_9"];
	$ball_10    =	$_POST["ball_10"];
	$sql		=	"update c_auto_$gameId set qishu=".$qishu.",datetime='".$datetime."',ball_1=".$ball_1.",ball_2=".$ball_2.",ball_3=".$ball_3.",ball_4=".$ball_4.",ball_5=".$ball_5.",ball_6=".$ball_6.",ball_7=".$ball_7.",ball_8=".$ball_8.",ball_9=".$ball_9.",ball_10=".$ball_10." where id=".$id."";
	$mysqli->query($sql);
}

$orderno=trim($_GET["orderno"]);
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" href="../images/css/admin_style_1.css" type="text/css" media="all" />
<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript">
function check_submit(){
	if($("#qishu").val()==""){
		alert("请填写开奖期数");
		$("#qishu").focus();
		return false;
	}
	if($("#datetime").val()==""){
		alert("请填写开奖时间");
		$("#datetime").focus();
		return false;
	}
	if($("#ball_1").val()==""){
		alert("请选择冠军开奖号码");
		$("#ball_1").focus();
		return false;
	}
	if($("#ball_2").val()==""){
		alert("请选择亚军开奖号码");
		$("#ball_2").focus();
		return false;
	}
	if($("#ball_3").val()==""){
		alert("请选择第三名开奖号码");
		$("#ball_3").focus();
		return false;
	}
	if($("#ball_4").val()==""){
		alert("请选择第四名开奖号码");
		$("#ball_4").focus();
		return false;
	}
	if($("#ball_5").val()==""){
		alert("请选择第五名开奖号码");
		$("#ball_5").focus();
		return false;
	}
	if($("#ball_6").val()==""){
		alert("请选择第六名开奖号码");
		$("#ball_6").focus();
		return false;
	}
	if($("#ball_7").val()==""){
		alert("请选择第七名开奖号码");
		$("#ball_7").focus();
		return false;
	}
	if($("#ball_8").val()==""){
		alert("请选择第八名开奖号码");
		$("#ball_8").focus();
		return false;
	}
	if($("#ball_9").val()==""){
		alert("请选择第九名开奖号码");
		$("#ball_9").focus();
		return false;
	}
	if($("#ball_10").val()==""){
		alert("请选择第十名开奖号码");
		$("#ball_10").focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<div id="pageMain">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top">
        <?php include_once("Menu_Auto.php"); ?>
        <form name="form1" onSubmit="return check_submit();" method="post" action="?id=<?=$id?>&type=<?=$gameId?>&action=<?=$id>0 ? 'edit' : 'add'?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">
<?php
if($id>0 && !isset($_GET['action'])){
	$sql	=	"select * from c_auto_$gameId where id=$id limit 1";
	$query	=	$mysqli->query($sql);
	$rs		=	$query->fetch_array();
}
?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">
  <tr>
    <td  align="left" bgcolor="#F0FFFF">彩票类别：</td>
    <td  align="left" bgcolor="#FFFFFF"><?=$gameName?>【<a href="Uptime_2.php?type=<?=$gameId?>" style="color:#ff0000;">点击进入盘口管理</a>】</td>
  </tr>
  <tr>
    <td width="60"  align="left" bgcolor="#F0FFFF">开奖期号：</td>
    <td  align="left" bgcolor="#FFFFFF"><input name="qishu" type="text" id="qishu" value="<?=$rs['qishu']?>" size="20" maxlength="11"/></td>
  </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖时间：</td>
    <td align="left" bgcolor="#FFFFFF"><input name="datetime" type="text" id="datetime" value="<?=$rs['datetime']?>" size="20" maxlength="19"/></td>
    </tr>
  <tr>
    <td align="left" bgcolor="#F0FFFF">开奖号码：</td>
    <td align="left" bgcolor="#FFFFFF"><select name="ball_1" id="ball_1">
        <option value="1" <?=$rs['ball_1']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_1']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_1']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_1']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_1']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_1']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_1']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_1']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_1']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_1']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_1']=='' ? 'selected' : ''?>>冠军</option>
      </select>
      <select name="ball_2" id="ball_2">
        <option value="1" <?=$rs['ball_2']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_2']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_2']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_2']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_2']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_2']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_2']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_2']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_2']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_2']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_2']=='' ? 'selected' : ''?>>亚军</option>
      </select>
      <select name="ball_3" id="ball_3">
        <option value="1" <?=$rs['ball_3']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_3']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_3']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_3']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_3']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_3']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_3']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_3']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_3']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_3']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_3']=='' ? 'selected' : ''?>>第三名</option>
      </select>
      <select name="ball_4" id="ball_4">
        <option value="1" <?=$rs['ball_4']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_4']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_4']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_4']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_4']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_4']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_4']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_4']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_4']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_4']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_4']=='' ? 'selected' : ''?>>第四名</option>
      </select>
      <select name="ball_5" id="ball_5">
        <option value="1" <?=$rs['ball_5']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_5']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_5']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_5']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_5']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_5']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_5']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_5']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_5']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_5']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_5']=='' ? 'selected' : ''?>>第五名</option>
      </select>
      <select name="ball_6" id="ball_6">
        <option value="1" <?=$rs['ball_6']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_6']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_6']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_6']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_6']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_6']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_6']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_6']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_6']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_6']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_6']=='' ? 'selected' : ''?>>第六名</option>
      </select>
      <select name="ball_7" id="ball_7">
        <option value="1" <?=$rs['ball_7']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_7']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_7']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_7']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_7']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_7']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_7']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_7']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_7']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_7']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_7']=='' ? 'selected' : ''?>>第七名</option>
      </select>
      <select name="ball_8" id="ball_8">
        <option value="1" <?=$rs['ball_8']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_8']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_8']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_8']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_8']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_8']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_8']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_8']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_8']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_8']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_8']=='' ? 'selected' : ''?>>第八名</option>
      </select>
      <select name="ball_9" id="ball_9">
        <option value="1" <?=$rs['ball_9']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_9']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_9']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_9']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_9']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_9']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_9']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_9']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_9']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_9']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_9']=='' ? 'selected' : ''?>>第九名</option>
      </select>
      <select name="ball_10" id="ball_10">
        <option value="1" <?=$rs['ball_10']==1 ? 'selected' : ''?>>1</option>
        <option value="2" <?=$rs['ball_10']==2 ? 'selected' : ''?>>2</option>
        <option value="3" <?=$rs['ball_10']==3 ? 'selected' : ''?>>3</option>
        <option value="4" <?=$rs['ball_10']==4 ? 'selected' : ''?>>4</option>
        <option value="5" <?=$rs['ball_10']==5 ? 'selected' : ''?>>5</option>
        <option value="6" <?=$rs['ball_10']==6 ? 'selected' : ''?>>6</option>
        <option value="7" <?=$rs['ball_10']==7 ? 'selected' : ''?>>7</option>
        <option value="8" <?=$rs['ball_10']==8 ? 'selected' : ''?>>8</option>
        <option value="9" <?=$rs['ball_10']==9 ? 'selected' : ''?>>9</option>
        <option value="10" <?=$rs['ball_10']==10 ? 'selected' : ''?>>10</option>
        <option value="" <?=$rs['ball_10']=='' ? 'selected' : ''?>>第十名</option>
      </select></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
    <td align="left" bgcolor="#FFFFFF"><input name="submit" type="submit" class="submit80" value="确认发布"/></td>
  </tr>
</table>  
    </form>
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="font12" bgcolor="#798EB9" style="margin-top:5px;">
     <form name="form1" method="get" action="">
      <tr>
        <td align="center" bgcolor="#FFFFFF">
			彩票期号
            <input name="orderno" type="text" id="orderno" value="<?=$orderno?>" size="22" maxlength="20"/>
			<input name="type" type="hidden" value="<?=$gameId?>"/>
            &nbsp;<input type="submit" name="Submit" value="搜索"></td>
        </tr>   
      </form>
    </table>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" class="font12" style="margin-top:5px;" bgcolor="#798EB9">   
            <tr style="background-color:#3C4D82; color:#FFF">
              <td height="25" align="center"><strong>彩票类别</strong></td>
              <td align="center"><strong>彩票期号</strong></td>
              <td align="center"><strong>开奖时间</strong></td>
              <td align="center"><strong>一</strong></td>
              <td align="center"><strong>二</strong></td>
              <td align="center"><strong>三</strong></td>
              <td align="center"><strong>四</strong></td>
              <td align="center"><strong>五</strong></td>
              <td align="center"><strong>六</strong></td>
              <td align="center"><strong>七</strong></td>
              <td align="center"><strong>八</strong></td>
              <td align="center"><strong>九</strong></td>
              <td align="center"><strong>十</strong></td>
              <td align="center"><strong>冠亚军和</strong></td>
              <td align="center"><strong>1V10</strong></td>
              <td align="center"><strong>2V9</strong></td>
              <td align="center"><strong>3V8</strong></td>
              <td align="center"><strong>4V7</strong></td>
              <td align="center"><strong>5V6</strong></td>
              <td align="center">结算</td>
              <td align="center"><strong>操作</strong></td>
            </tr>
<?php
if($orderno!=""){
	$sqlwhere	=	" where qishu='$orderno'";
}else{
	$sqlwhere	=	"";
}
$sql		=	"select id from c_auto_$gameId ".$sqlwhere." order by qishu desc";
$query		=	$mysqli->query($sql);
$sum		=	$mysqli->affected_rows; //总页数
$thisPage	=	1;
$pagenum	=	50;
if($_GET['page']){
	$thisPage	=	$_GET['page'];
}
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
$myPage=new pager($sum,intval($CurrentPage),$pagenum);
$pageStr= $myPage->GetPagerContent();

$id		=	'';
$i			=	1; //记录 uid 数
$start	=	($CurrentPage-1)*$pagenum+1;
$end	=	$CurrentPage*$pagenum;
while($row = $query->fetch_array()){
  if($i >= $start && $i <= $end){
	$id .=	$row['id'].',';
  }
  if($i > $end) break;
  $i++;
}
if($id){
	$id	=	rtrim($id,',');
	$sql	=	"select * from c_auto_$gameId where id in($id) order by qishu desc";
	$query	=	$mysqli->query($sql);
	$time	=	time();
	while($rows = $query->fetch_array()){
		$color = "#FFFFFF";
	  	$over	 = "#EBEBEB";
	 	$out	 = "#ffffff";
		$hm 		= array();
		$hm[]		= $rows['ball_1'];
		$hm[]		= $rows['ball_2'];
		$hm[]		= $rows['ball_3'];
		$hm[]		= $rows['ball_4'];
		$hm[]		= $rows['ball_5'];
		$hm[]		= $rows['ball_6'];
		$hm[]		= $rows['ball_7'];
		$hm[]		= $rows['ball_8'];
		$hm[]		= $rows['ball_9'];
		$hm[]		= $rows['ball_10'];
		if($rows['ok']==1){
			$ok = '<a href="../cj/lottery/js_'.$gameId.'.php?qi='.$rows['qishu'].'&t=1"><font color="#FF0000">已结算</font></a>';
		}else{
			$ok = '<a href="../cj/lottery/js_'.$gameId.'.php?qi='.$rows['qishu'].'&t=1"><font color="#0000FF">未结算</font></a>';
		}
?>
      <tr align="center" onMouseOver="this.style.backgroundColor='<?=$over?>'" onMouseOut="this.style.backgroundColor='<?=$out?>'" style="background-color:<?=$color?>; line-height:20px;">
        <td height="25" align="center" valign="middle"><?=$gameName?></td>
        <td align="center" valign="middle"><?=$rows['qishu']?></td>
        <td align="center" valign="middle"><?=$rows['datetime']?></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_1']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_2']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_3']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_4']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_5']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_6']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_7']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_8']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_9']?>.png"></td>
        <td align="center" valign="middle"><img src="/Lottery/Images/Ball_2/<?=$rows['ball_10']?>.png"></td>
        <td><?=Bjsc_Auto($hm,1)?> / <?=Bjsc_Auto($hm,2)?> / <?=Bjsc_Auto($hm,3)?></td>
        <td><?=Bjsc_Auto($hm,4)?></td>
        <td><?=Bjsc_Auto($hm,5)?></td>
        <td><?=Bjsc_Auto($hm,6)?></td>
        <td><?=Bjsc_Auto($hm,7)?></td>
        <td><?=Bjsc_Auto($hm,8)?></td>
        <td><?=$ok?></td>
        <td><a href="?id=<?=$rows["id"]?>&type=<?=$gameId?>&page=<?=$_REQUEST['page']?>&orderno=<?=$orderno?>">编辑</a></td>
        </tr>
<?php
	}
}
?>
	<tr style="background-color:#FFFFFF;">
        <td colspan="21" align="center" valign="middle"><?php echo $pageStr;?></td>
        </tr>
    </table></td>
    </tr>
  </table>
</div>
</body>
</html>