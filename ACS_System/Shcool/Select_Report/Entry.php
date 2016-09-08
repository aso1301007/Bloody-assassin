<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="Stylesheet" href="report.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../css.css" />
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
<title>報告書作成</title>
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
<body link="blue" vlink="purple">
<form action="report_confirmation.php" method="post" name = "form1">
<table align="center" border="0"  style="border-collapse:collapse;table-layout:fixed;width:522pt">
<col width="24" span="29" style="width:18pt" />
<tr style="height:17.25pt">
	<td width="24" style="height:17.25pt;width:18pt" />
	<td width="24" style="width:18pt" />
	<?php
	for($i=0;$i<27;$i++){
		echo '<td width="24" style="width:18pt" />';
	}
	?>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl67">　</td>
	<?php
	for($i=0;$i<23;$i++){
		echo '<td class="xl68">　</td>';
	}
	?>
	<td class="xl69">　</td>
</tr>
<tr style="mso-height-source:userset;height:31.5pt">
	<td height="42" colspan="4" style="height:31.5pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<?php
	for($i=0;$i<8;$i++){
		echo '<td />';
	}
	?>
	<td colspan="6" class="xl90">報告書</td>
	<?php
	for($i=0;$i<9;$i++){
		echo '<td />';
	}
	?>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<?php
	for($i=0;$i<16;$i++){
		echo '<td />';
	}
	?>
	<td colspan ="2">
		<input type="text" name="year" size = "1" maxlength = "4" />
	</td>
	<td>年</td>
	<td>
		<input type="text" name="month" size = "2" maxlength = "2" class = "one" />
	</td>
	<td>月</td>
	<td>
		<input type="text" name="date" size = "2" maxlength = "2" class = "one" />
	</td>
	<td>日</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">入力担当者名</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<input type="text" name="user_name" maxlength="15" class = "two" />
	</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">制作物ナンバー</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<input type="text" name="s_number" maxlength="8" class = "two" readonly="readonly" />
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl65" style="border-top:none">　</td>
	<?php
	for($i=0;$i<4;$i++){
		echo '<td class="xl65" style="border-top:none">　</td>';
	}
	for($i=0;$i<18;$i++){
		echo '<td class="xl66" />';
	}
	?>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">制作会社</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<select name="seisaku_name" class = "three" />
	</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">納品日</td>
	<td colspan="6" rowspan="2" class="xl81" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<input type="text" name="n_year" size="1" maxlength="4" class="five" />年
		<input type="text" name="n_month" size="2" maxlength="2" class="four" />月
		<input type="text" name="n_date" size="2" maxlength="2" class="four" />日
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">PBM立場</td>
	<td colspan="18" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<textarea name="pbm_p" rows="3" wrap="soft" maxlength = "255" class = "one"></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">成功点</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;border-bottom:.5pt solid black">
		<textarea name="s_p" rows="3" wrap="soft" maxlength = "255" class = "one"></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">失敗点</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<textarea name="f_p" rows="3" wrap="soft" maxlength = "255" class = "one"></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">コメント</td>
	<td colspan="18" rowspan="3" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<textarea name="comment" rows="3" wrap="soft" maxlength = "255" class = "one"></textarea>
	</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td class="xl74">　</td>
</tr>
<tr style="mso-height-source:userset;height:17.25pt">
	<td height="23" colspan="4" style="height:17.25pt;mso-ignore:colspan" />
	<td class="xl73">　</td>
	<td colspan="5" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">品名</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
		<select name="hin_janru" class = "one" />
	</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">部数</td>
	<td colspan="6" rowspan="2" class="xl75" style="border-right:.5pt solid black;
		border-bottom:.5pt solid black">
	<input type="text" name="h_busu" maxlength="6" class = "six" />部
	</td>
	<td class="xl74">　</td>
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

