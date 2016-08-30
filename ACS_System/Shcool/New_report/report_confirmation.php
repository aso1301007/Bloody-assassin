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
include("../School_header.php")
?>
<div id="title">報告書確認</div>
<p></p>
<form action="Save_success.php" method="POST" name = "form1">
<h1><center>以下の内容で保存してよろしいですか？</center></h1>

<table align = center>
<tr>
<td>
<input type="submit" value="保存" class ="eight" >
</td>
<td>
<form action="report.php" method="POST" name = "form2">
<input type="submit" value="戻る" class ="eight">
</form>
</td>
</tr>
</table>

<?php
//入力値の取得
$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$user_name = $_POST["user_name"];
$s_number = $_POST["s_number"];
$seisaku_name = $_POST["seisaku_name"];
$n_year = $_POST["n_year"];
$n_month = $_POST["n_month"];
$n_date = $_POST["n_date"];
$pbm_p = $_POST["pbm_p"];
$s_p = $_POST["s_p"];
$f_p = $_POST["f_p"];
$comment = $_POST["comment"];
$hin_janru = $_POST["hin_janru"];
$h_busu = $_POST["h_busu"];
$h_size = $_POST["h_size"];
$h_page = $_POST["h_page"];
$h_color = $_POST["h_color"];
$h_men = $_POST["h_men"];
$h_kami = $_POST["h_kami"];
$h_orikata = $_POST["h_orikata"];
$h_money = $_POST["h_money"];

switch ($hin_janru){
	case '1':
		$hin_janru_mei = "<input type=\"text\" name=\"hin_janru_mei\" class = \"one\" value=\"パンフレット\" readonly>";
		$hin="<input type=\"hidden\" name=\"hin_janru\" value=\"1\">";
		break;
	case '2':
		$hin_janru_mei = "<input type=\"text\" name=\"hin_janru_mei\" class = \"one\" value=\"ポスター\" readonly>";
		$hin="<input type=\"hidden\" name=\"hin_janru\" value=\"2\">";
		break;
	case'3':
		$hin_janru_mei = "<input type=\"text\" name=\"hin_janru_mei\" class = \"one\" value=\"看板\" readonly>";
		$hin="<input type=\"hidden\" name=\"hin_janru\" value=\"3\">";
		break;
	case'4':
		$hin_janru_mei = "<input type=\"text\" name=\"hin_janru_mei\" class = \"one\" value=\"その他\" readonly>";
		$hin="<input type=\"hidden\" name=\"hin_janru\" value=\"4\">";
		break;
}

$kata = "<input type=\"radio\" name=\"h_men\" value=\"片面\" disabled = \"disabled\"></td>";
$ryo = "<input type=\"radio\" name=\"h_men\" value=\"両面\" disabled = \"disabled\"></td>";
switch ($h_men){
	case '1':
		$kata = "<input type=\"radio\" name=\"h_men\" value=\"片面\" checked></td>";
		break;
	case '2':
		$ryo = "<input type=\"radio\" name=\"h_men\" value=\"両面\" checked></td>";
		break;
}
?>

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
  <INPUT type="text" name="year" size = "1" maxlength = "4" readonly value =  <?php echo $year; ?>>
  </td>
  <td>年</td>
  <td>
  <INPUT type="text" name="month" size = "2" maxlength = "2" class = "one" readonly value =  <?php echo $month; ?>>
  </td>
  <td>月</td>
  <td>
   <INPUT type="text" name="date" size = "2" maxlength = "2" class = "one" readonly value =  <?php echo $date; ?>>
  </td>
  <td>日</td>
  <td class=xl74>　</td>
 </tr>

 <tr height=23 style='mso-height-source:userset;height:17.25pt'>
  <td height=23 colspan=4 style='height:17.25pt;mso-ignore:colspan'></td>
  <td class=xl73>　</td>
  <td colspan=5 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>入力担当者名</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="user_name" maxlength="15" class = "two" readonly value =  <?php echo $user_name; ?>>
  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>制作物ナンバー</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="s_number" maxlength="8" class = "two" readonly value =  <?php echo $s_number; ?>>
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
  <input type="text" name="seisaku_name" maxlength="30" class = "three" readonly value =  <?php echo $seisaku_name; ?>>
  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>納品日</td>
  <td colspan=6 rowspan=2 class=xl81 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="n_year" size="1" maxlength="4" class="five" readonly value =  <?php echo $n_year; ?>>年
  <input type="text" name="n_month" size="2" maxlength="2" class="four" readonly value =  <?php echo $n_month; ?>>月
  <input type="text" name="n_date" size="2" maxlength="2" class="four" readonly value =  <?php echo $n_date; ?>>日
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
  <textarea name="pbm_p" rows="3" wrap="soft" maxlength = "255" class = "one" readonly>
	<?php echo $pbm_p; ?>
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
  <textarea name="s_p" rows="3" wrap="soft" maxlength = "255" class = "one" readonly>
	<?php echo $s_p; ?>
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
  <textarea name="f_p" rows="3" wrap="soft" maxlength = "255" class = "one" readonly>
	<?php echo $f_p; ?>
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
  <textarea name="comment" rows="3" wrap="soft" maxlength = "255" class = "one" readonly>
	<?php echo $comment; ?>
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

  <?php echo $hin_janru_mei ?>
  <?php echo $hin ?>

  </td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>部数</td>
  <td colspan=6 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="h_busu" maxlength="6" class = "six" readonly value = <?php echo $h_busu; ?>>部
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
  <input type="text" name="h_size" maxlength="2" class = "two" readonly value = <?php echo $h_size; ?>>
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>ページ数</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_page" maxlength="3" class = "two" readonly value = <?php echo $h_page; ?>>
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>色数</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_color" maxlength="3" class = "two" readonly value = <?php echo $h_color; ?>>
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
  <?php echo $kata?>
  </td>
  <td colspan=2 rowspan=2 class=xl76 style='border-bottom:.5pt solid black'>
   片面</td>
  <td rowspan=2 class=xl76 style='border-bottom:.5pt solid black;border-top:none'>
  <?php echo $ryo?>
  <td colspan=2 rowspan=2 class=xl76 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  両面</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>紙</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_kami" maxlength="10" class = "two" readonly value = <?php echo $h_kami; ?>>
  </td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>折り方</td>
  <td colspan=3 rowspan=2 class=xl75 style='border-right:.5pt solid black;border-bottom:.5pt solid black'>
  <input type="text" name="h_orikata" maxlength="10" class = "two" readonly value = <?php echo $h_orikata; ?>>
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
  <input type="text" name="h_money" maxlength="8" class = "six money" readonly value = <?php echo $h_money; ?>>円
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
