﻿// JavaScript Document
var dbs	 = null;
var data = null;
var window_hight	=	0; //窗口高度
var window_lsm		=	0; //窗口联赛名
function loaded(league,thispage,p){
	var league = encodeURI(league);
	$.getJSON("ft_gunqiu_data.php?leaguename="+league+"&CurrPage="+thispage+"&callback=?",function(json){
		
var pagecount = json.fy.p_page;
		var page = json.fy.page;
		var fenye = "";
		window_hight	=	json.dh;
		window_lsm		=	json.lsm;
        var dbwidth = $(parent.window).width()-10;
		
		if(dbs !=null)
        {
			if(thispage==0 && p!='p')
			{	
				data = dbs;
				dbs  = json.db;  
			}else{
				dbs  = json.db;  
				data = dbs;
			}
		}else{
			dbs  = json.db;
			data = dbs;
		}	

		if(pagecount == 0){
			$("#datashow").html('<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间/比分<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF"><img src="/images/loading.gif" border="0" />暂无任何赛事</td></tr></tbody></table>');
		}else{
			var htmls='<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间/比分<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody>';
			var lsm = "";
			for(var i=0; i<dbs.length; i++){
				lsm = dbs[i]["Match_Name"];
                htmls+="<tr>";
                htmls+="<td><a href=\"javascript:void(0)\" title='选择 >> "+lsm+"' onclick=\"javascript:check_one('"+lsm+"');\" >"+lsm+"</a></td>";
     			//htmls+="<div onmouseover=\"this.className='d_over'\" onmouseout=\"this.className='d_out'\">";
				
                var home_let_point = (dbs[i]["Match_Ho"]!="@"?dbs[i]["Match_Ho"]:"0");
                if(home_let_point.length ==3){
                    home_let_point = home_let_point + "0";
                }
                if (home_let_point.length == 1){
                    home_let_point = home_let_point + ".00";
                }
				
                var home_dxp_point = (dbs[i]["Match_DxDpl"]!="@"?dbs[i]["Match_DxDpl"]:"0");
                if (home_dxp_point.length == 3){
                    home_dxp_point = home_dxp_point + "0";
                }
                if (home_dxp_point.length == 1){
                    home_dxp_point = home_dxp_point + ".00";
                }
				
                var sbc_home_let_point = (dbs[i]["Match_BHo"]!="@"?dbs[i]["Match_BHo"]:"0");
                if (sbc_home_let_point.length == 3){
                    sbc_home_let_point = sbc_home_let_point + "0";
                }
                if (sbc_home_let_point.length == 1){
                    sbc_home_let_point = sbc_home_let_point + ".00";
                }
				
                var sbc_home_dxp_point = (dbs[i]["Match_Bdpl"]!="@"?dbs[i]["Match_Bdpl"]:"0");
                if (sbc_home_dxp_point.length == 3){
                    sbc_home_dxp_point = sbc_home_dxp_point + "0";
                }
                if (sbc_home_dxp_point.length == 1){
                    sbc_home_dxp_point = sbc_home_dxp_point + ".00";
                }
				
                var guest_let_point = (dbs[i]["Match_Ao"]!="@"?dbs[i]["Match_Ao"]:"0");
                if (guest_let_point.length == 3){
                    guest_let_point = guest_let_point + "0";
                }
                if (guest_let_point.length == 1){
                    guest_let_point = guest_let_point + ".00";
                }
				
                var guest_dxp_point =(dbs[i]["Match_DxXpl"]!="0"?dbs[i]["Match_DxXpl"]:"0");
                if (guest_dxp_point.length == 3){
                    guest_dxp_point = guest_dxp_point + "0";
                }
                if (guest_dxp_point.length == 1){
                    guest_dxp_point = guest_dxp_point + ".00";
                }

                var sbc_guest_let_point = (dbs[i]["Match_BAo"]!="@"?dbs[i]["Match_BAo"]:"0");
                if (sbc_guest_let_point.length == 3){
                    sbc_guest_let_point = sbc_guest_let_point + "0";
                }
                if (sbc_guest_let_point.length == 1){
                    sbc_guest_let_point = sbc_guest_let_point + ".00";
                }
               
                var sbc_guest_dxp_point =(dbs[i]["Match_Bxpl"]!="@"?dbs[i]["Match_Bxpl"]:"0");
                if (sbc_guest_dxp_point.length == 3){
                    sbc_guest_dxp_point = sbc_guest_dxp_point + "0";
                }
                if (sbc_guest_dxp_point.length == 1){
                    sbc_guest_dxp_point = sbc_guest_dxp_point + ".00";
                }
				
                var fwin = (dbs[i]["Match_BzM"]);
                if (fwin.length == 3){
                    fwin = fwin + "0";
                }
                if (fwin.length == 1){
                    fwin = fwin + ".00";
                }
				
                var flose = (dbs[i]["Match_BzG"]!="@"?dbs[i]["Match_BzG"]:"0");
                if (flose.length == 3){
                    flose = flose + "0";
                }
                if (flose.length == 1){
                    flose = flose + ".00";
                }
				
                var fdraw = (dbs[i]["Match_BzH"]!="@"?dbs[i]["Match_BzH"]:"0");
                if (fdraw.length == 3){
                    fdraw = fdraw + "0";
                }
                if (fdraw.length == 1){
                    fdraw = fdraw + ".00";
                }
                
                var Hwin = (dbs[i]["Match_Bmdy"]!="@"?dbs[i]["Match_Bmdy"]:"0");
                if (Hwin.length == 3){
                    Hwin = Hwin + "0";
                }
                if (Hwin.length == 1){
                    Hwin = Hwin + ".00";
                }
				
                var Hlose = (dbs[i]["Match_Bgdy"]!="@"?dbs[i]["Match_Bgdy"]:"0");
                if (Hlose.length == 3){
                    Hlose = Hlose + "0";
                }
                if (Hlose.length == 1){
                    Hlose = Hlose + ".00";
                }
				
                var Hdraw = (dbs[i]["Match_Bhdy"]!="@"?dbs[i]["Match_Bhdy"]:"0");
                if (Hdraw.length == 3){
                    Hdraw = Hdraw + "0";
                }
                if (Hdraw.length == 1){
                    Hdraw = Hdraw + ".00";
                }
                if((dbs[i]["Match_Time"].indexOf("font")==-1 && (dbs[i]["Match_Time"].indexOf("a") !=-1 || dbs[i]["Match_Time"].indexOf("p") !=-1) && (dbs[i]["Match_RGG"] !=null?dbs[i]["Match_RGG"]==0:false) && (dbs[i]["Match_DxGG"] !=null?dbs[i]["Match_DxGG"]=="O2.5":false)) ||(dbs[i]["Match_DxGG"] =="O0" || dbs[i]["Match_Bdxpk"] =="O0")){
					    var temphrgl="";
                 		var tempgrgl="";
                   		var temprsgl="";
                }else{
					
                var temphrgl="<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_Ho','1','1','"+ dbs[i]["Match_Master"] + "');\"  style='"+(dbs[i]["Match_Ho"]!=data[i]["Match_Ho"]&& data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (home_let_point!="0.00"?home_let_point:"") +  "</a>";
                var tempgrgl="<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_RGG"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_Ao','1','1','"+dbs[i]["Match_Guest"]+"');\" style='"+(dbs[i]["Match_Ao"]!=data[i]["Match_Ao"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (guest_let_point !="0.00"?guest_let_point:"") + "</a>";
                var temprsgl=dbs[i]["Match_RGG"];
                if(dbs[i]["Match_RGG"] !=null && dbs[i]["Match_Time"] !=null)
                {
                   if(dbs[i]["Match_RGG"]=="0" && (dbs[i]["Match_Time"]=="00" || dbs[i]["Match_Time"] =="01"))
                   {
                   var temphrgl="";
                   var tempgrgl="";
                   var temprsgl="";
                   }
                }
                var tempshrgl="<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','上半场让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Master"] + "','" + dbs[i]["Match_ID"] + "','Match_BHo','1','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BHo"]!=data[i]["Match_BHo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (sbc_home_let_point!="0.00"?sbc_home_let_point:"") + "</a>";
                var tempsgrgl="<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','上半场让球-"+(dbs[i]["Match_ShowType"] =="H"?"主让":"客让")+dbs[i]["Match_BRpk"]+"-"+dbs[i]["Match_Guest"] + "','" + dbs[i]["Match_ID"] + "','Match_BAo','1','1','"+dbs[i]["Match_Guest"]+"');\"  style='"+(dbs[i]["Match_BAo"]!=data[i]["Match_BAo"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (sbc_guest_let_point !="0.00"?sbc_guest_let_point:"") + "</a>";
                var tempsrsgl=dbs[i]["Match_BRpk"];
                if(dbs[i]["Match_BRpk"] !=null && dbs[i]["Match_Time"] !=null)
                {
                if(dbs[i]["Match_BRpk"]=="0" && (dbs[i]["Match_Time"]=="00" || dbs[i]["Match_Time"] =="01"))
                   {
                   var tempshrgl="";
                   var tempsgrgl="";
                   var tempsrsgl="";
                   }
                }
                var tempfwin="<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzM','0','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (fwin!="0.00"?fwin:"") + "</a>";
                var tempflose="<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_BzG','0','1','"+ dbs[i]["Match_Guest"] + "');\"  style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (flose !="0.00"?flose:"") + "</a>";
                var tempfdraw="<a class=\"btn btn-lg btn-warning\" href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球滚球','标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_BzH','0','1','和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (fdraw !="0.00"?fdraw:"") + "</a>";
                var temphwin="<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Master"]+"\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-"+ dbs[i]["Match_Master"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bmdy','0','1','"+ dbs[i]["Match_Master"] + "');\" style='"+(dbs[i]["Match_BzM"]!=data[i]["Match_BzM"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (Hwin!="0.00"?Hwin:"") + "</a>";
                var temphlose="<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\""+dbs[i]["Match_Guest"]+"\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-"+ dbs[i]["Match_Guest"] +"-独赢','" + dbs[i]["Match_ID"] + "','Match_Bgdy','0','1','"+ dbs[i]["Match_Guest"] + "');\"  style='"+(dbs[i]["Match_BzG"]!=data[i]["Match_BzG"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (Hlose !="0.00"?Hlose:"") + "</a>";
                var temphdraw="<a class=\"btn btn-lg btn-warning\" href=\"javascript:void(0)\" title=\"和局\" onclick=\"javascript:setbet('足球滚球','上半场标准盘-和局','" + dbs[i]["Match_ID"] + "','Match_Bhdy','0','1','和局');\" style='"+(dbs[i]["Match_BzH"]!=data[i]["Match_BzH"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (Hdraw !="0.00"?Hdraw:"") + "</a>";
                
				var bf = dbs[i]["Match_Time"]; //比分
				if(bf == "45.5") bf = "中场";
               
				htmls+="<td><span class=\"red\">" + bf + "</span> / <span class=\"pink\">" + dbs[i]["Match_NowScore"] + "</span><br><span class='zhu'>" + dbs[i]["Match_Master"]+ "</span>&nbsp;"+ (dbs[i]["Match_HRedCard"] !="0"?"<img src='../images/" + dbs[i]["Match_HRedCard"] + ".gif' width='12' height='13' border='0'/>":"") + "-<span class='ke'>" + dbs[i]["Match_Guest"] + "</span>&nbsp;" + (dbs[i]["Match_GRedCard"] !="0"?"<img src='../images/" + dbs[i]["Match_GRedCard"] + ".gif' width='12' height='13' border='0' />":"")+ "-<span class='he'>和局</span></td>";
				htmls+="<td><div class='btn-group'>"+tempfwin+tempflose+tempfdraw+"</div></td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(data[i]["Match_Ho"] !=null?temphrgl:"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_ShowType"]=="H" && dbs[i]["Match_Ho"] !="0"?temprsgl:"") + "</a></span><br><span class='odds'>"+(dbs[i]["Match_Ao"] !=null?tempgrgl:"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_ShowType"]=="C" && dbs[i]["Match_Ho"] !="0"?temprsgl:"") + "</a></span><br>&nbsp;</td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_DxDpl"] !=null?"<a class=\"btn btn-lg btn-success\" href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球滚球','大小-"+dbs[i]["Match_DxGG"]+"','" + dbs[i]["Match_ID"] + "','Match_DxDpl','1','1','"+dbs[i]["Match_DxGG"]+"');\"  style='"+(dbs[i]["Match_DxDpl"]!=data[i]["Match_DxDpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (home_dxp_point!="0.00"?home_dxp_point:"") + "</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_DxGG"]!="O"?dbs[i]["Match_DxGG"]:"") + "</a></span><br><span class='odds'>"+(dbs[i]["Match_DxXpl"] !=null?"<a class=\"btn btn-lg btn-info\" href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球滚球','大小-"+dbs[i]["Match_DxGG1"]+"','" + dbs[i]["Match_ID"] + "','Match_DxXpl','1','1','"+dbs[i]["Match_DxGG1"]+"');\" style='"+(dbs[i]["Match_DxXpl"]!=data[i]["Match_DxXpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (guest_dxp_point !="0.00"?guest_dxp_point:"") + "</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" +(dbs[i]["Match_DxGG1"]!="U"?dbs[i]["Match_DxGG1"]:"") + "</a></span><br>&nbsp;</td>";
				htmls+="<td><div class='btn-group'>"+temphwin+temphlose+temphdraw+"</div></td>";
				htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_BHo"]!=null?tempshrgl:"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" +(dbs[i]["Match_Hr_ShowType"]=="H" && dbs[i]["Match_BAo"] !="0"?tempsrsgl:"") + "</a></span><br><span class='odds'>"+(dbs[i]["Match_BAo"] !=null?tempsgrgl:"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_Hr_ShowType"]=="C" && dbs[i]["Match_BAo"] !="0"?tempsrsgl:"")+ "</a></span><br>&nbsp;</td>";
                htmls+="    <td><div class='rangqiu_odds'><span class='odds'>"+(dbs[i]["Match_Bdpl"] !=null?"<a href=\"javascript:void(0)\" title=\"大\" onclick=\"javascript:setbet('足球滚球','上半场大小-"+dbs[i]["Match_Bdxpk"]+"','" + dbs[i]["Match_ID"] + "','Match_Bdpl','1','1','"+dbs[i]["Match_Bdxpk"]+"');\" style='"+(dbs[i]["Match_Bdpl"]!=data[i]["Match_Bdpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (sbc_home_dxp_point!="0.00"?sbc_home_dxp_point:"") + "</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_Bdxpk"]!="O"?dbs[i]["Match_Bdxpk"]:"") + "</a></span><br><span class='odds'>"+(dbs[i]["Match_Bxpl"] !=null ?"<a href=\"javascript:void(0)\" title=\"小\" onclick=\"javascript:setbet('足球滚球','上半场大小-"+dbs[i]["Match_Bdxpk2"]+"','" + dbs[i]["Match_ID"] + "','Match_Bxpl','1','1','"+dbs[i]["Match_Bdxpk2"]+"');\" style='"+(dbs[i]["Match_Bxpl"]!=data[i]["Match_Bxpl"] && data[i]["Match_ID"]==dbs[i]["Match_ID"]?"background:#d9534f":"")+"'>" + (sbc_guest_dxp_point!="0.00"?sbc_guest_dxp_point:"") + "</a>":"")+"</span><span class='pankou'><a href=\"javascript:;\" class=\"btn btn-lg\">" + (dbs[i]["Match_Bdxpk2"]!="U"?dbs[i]["Match_Bdxpk2"]:"")+ "</a></span><br>&nbsp;</td>";
				htmls+=" </tr>"; 
                }	
			}

			htmls+="</tbody></table>";
			if(htmls == '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间/比分<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody></tbody></table>'){
				htmls = '<table class="table table-bordered table-hover"><thead><tr class="success"><th data-toggle="true">赛程<br>点击每行展开</th><th>时间/比分<br>主队 / 客队</th><th data-hide="phone,tablet">全场[1X2]</th><th data-hide="phone,tablet">全场[让球]</th><th data-hide="phone,tablet">全场[大小]</th><th data-hide="phone,tablet">上半场[1X2]</th><th data-hide="phone,tablet">上半场[让球]</th><th data-hide="phone,tablet">上半场[大小]</th></tr></thead><tbody><tr><td height="100" colspan="8" align="center" bgcolor="#FFFFFF"><img src="/images/loading.gif" border="0" />暂无任何赛事</td></tr></tbody></table>';
			}
			$("#datashow").html(htmls);
            //$(".panel").width(dbwidth);
            $('.table').footable();
            $("#datashow a").each(function(i, e) {
                var t=$(this).html();
                if(t==''||t=='&nbsp;'){
                    $(this).remove();
                }
            });
		}
	})
}

$(document).ready(function(){
	$("#xzls").click(function(){ //选择联赛
		JqueryDialog.Open('足球滚球', 'dialog.php?lsm='+window_lsm, 300, window_hight);
	});
});