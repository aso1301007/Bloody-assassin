<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>報告書作成</title>
<link rel=Stylesheet href=report.css type="text/css">
<link rel=stylesheet type=text/css href=../../css.css>
<style>
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
@page
	{margin:.75in .7in .75in .7in;
	mso-header-margin:.3in;
	mso-footer-margin:.3in;}
</style>

<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($){

	$("#menu li").hover(function() {
		$(this).children('ul').show();
		//window.alert('キャンセルされました');
	}, function() {
		$(this).children('ul').hide();
		//window.alert('キャンセルされました');
	});

});
</script>

</head>

<body link=blue vlink=purple>

<?php
include("../School_header.php");
require '../../DB.php';			//DB.php呼び出し
?>
<?php
//制作会社
$undergraduate_id = 1;
$Yes_undergraduate = "SELECT * FROM seisaku_kaisya WHERE seisaku_id = ". $undergraduate_id. "";
$yes_undergraduate =  $pdo->prepare($Yes_undergraduate);
$yes_undergraduate->execute();
$No_undergraduate = "SELECT * FROM seisaku_kaisya WHERE seisaku_id <> ".$undergraduate_id."";	//選択されていない値を検索
$no_undergraduate = $pdo->prepare($No_undergraduate);
$no_undergraduate->execute();
?>

<form action="report_confirmation.php" method="POST" name = "form1">
<table align=center border=0  style='border-collapse:
 collapse;table-layout:fixed;width:522pt'>
 <col width=24 span=29 style='width:18pt'>

 <tr height=23 style='height:17.25pt'>
  <td height=23 width=24 style='height:17.25pt;width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl67>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl68>　</td>
  <td class=xl69>　</td>
 </tr>
 <tr height=42 style='mso-height-source:userset;height:31.5pt'>
  <td height=42 colspan=4 style='height:31.5pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan=6 class=xl90>報告書</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl74>　</td>
 </tr>
 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan ="2">
  <INPUT type="text" name="year" size = "1" maxlength = "4">
  </td>
  <td>年</td>
  <td>
  <INPUT type="text" name="month" size = "2" maxlength = "2" class = "one">
  </td>
  <td>月</td>
  <td>
   <INPUT type="text" name="date" size = "2" maxlength = "2" class = "one">
  </td>
  <td>日</td>
  <td class=xl74>　</td>
 </tr>

 <script language="JavaScript">
   var dt=new Date();//　日付を取得
   var dy=dt.getYear();
   var dm=dt.getMonth()+1;
   var dd=dt.getDate();
   if(dy<2000){dy+=1900;}
   document.form1.year.value=dy;//←テキストボックスに表示
   document.form1.month.value=dm;//←テキストボックスに表示
   document.form1.date.value=dd;//←テキストボックスに表示
 </script>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>入力担当者名</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="user_name" maxlength="15" class = "two">
  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>制作物ナンバー</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="s_number" maxlength="8" class = "two" readonly>
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl65 style='border-top:none'>　</td>
  <td class=xl65 style='border-top:none'>　</td>
  <td class=xl65 style='border-top:none'>　</td>
  <td class=xl65 style='border-top:none'>　</td>
  <td class=xl65 style='border-top:none'>　</td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl66></td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>制作会社</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <select name="seisaku_name" class = "three">
  <?php
	$YES_UNDERGRADUATE = $yes_undergraduate->fetch(PDO::FETCH_ASSOC);
	echo "<option value=". $YES_UNDERGRADUATE['seisaku_id']. " selected >". $YES_UNDERGRADUATE['seisaku_name']. "</option>";
		while($NO_UNDERGRADUATE = $no_undergraduate->fetch(PDO::FETCH_ASSOC)){
			echo "<option value=". $NO_UNDERGRADUATE['seisaku_id']. ">". $NO_UNDERGRADUATE['seisaku_name']. "</option>";
		}
?>
  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>納品日</td>
  <td colspan=6 rowspan=2 class=xl81 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="n_year" size="1" maxlength="4" class="five">年
  <input type="text" name="n_month" size="2" maxlength="2" class="four">月
  <input type="text" name="n_date" size="2" maxlength="2" class="four">日
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>PBM立場</td>
  <td colspan=18 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <textarea name="pbm_p" rows="3" wrap="soft" maxlength = "255" class = "one">
  </textarea>
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=3 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>成功点</td>
  <td colspan=18 rowspan=3 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <textarea name="s_p" rows="3" wrap="soft" maxlength = "255" class = "one">
  </textarea>
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=3 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>失敗点</td>
  <td colspan=18 rowspan=3 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <textarea name="f_p" rows="3" wrap="soft" maxlength = "255" class = "one">
  </textarea>
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=3 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>コメント</td>
  <td colspan=18 rowspan=3 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <textarea name="comment" rows="3" wrap="soft" maxlength = "255" class = "one">
  </textarea>
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>品名</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>

   <SELECT name="hin_janru" class = "one">
    <OPTION value="1" selected>パンフレット</OPTION>
    <OPTION value="2">ポスター</OPTION>
    <OPTION value="3">看板</OPTION>
    <OPTION value="4">その他</OPTION>
   </SELECT>

  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>部数</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="h_busu" maxlength="6" class = "six">部
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=4 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>仕様</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>サイズ</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_size" maxlength="2" class = "two">
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>ページ数</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_page" maxlength="3" class = "two">
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>色数</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_color" maxlength="3" class = "two">
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td rowspan=2 class=xl75 style='border-bottom:.5pt solid black;border-top:none'>
  <input type="radio" name="h_men" value="1" checked>
  </td>
  <td colspan=2 rowspan=2 class=xl76 style='border-bottom:.5pt solid black'>片面</td>
  <td rowspan=2 class=xl76 style='border-bottom:.5pt solid black;border-top:none'>
  <input type="radio" name="h_men" value="2">
  <td colspan=2 rowspan=2 class=xl76 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>両面</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>紙</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_kami" maxlength="10" class = "two">
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>折り方</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_orikata" maxlength="10" class = "two">
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>最終請求費用</td>
  <td colspan=18 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_money" maxlength="8" class = "six money">円
  </td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl70>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td colspan = "9" class=xl71><input type="submit" value="保存" class ="seven"></td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl72>　</td>
 </tr>

 <tr height=0 style='display:none'>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
  <td width=24 style='width:18pt'></td>
 </tr>
</table>
</form>
</body>

</html>

