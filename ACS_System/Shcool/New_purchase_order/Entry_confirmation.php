<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert title here</title>
<link rel=Stylesheet href=stylesheet.css type="text/css">
<link rel=stylesheet type=text/css href=../../css.css>
<style>
<!--table
{mso-displayed-decimal-separator:"\.";
mso-displayed-thousand-separator:"\,";}
@page
{margin:.75in .7in .75in .7in;
mso-header-margin:.3in;
mso-footer-margin:.3in;}
-->
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
<body>
<?php
include("../School_header.php")
?>
<div id="title">注文書作成</div>
<p></p>
<form action="Save_success.php" method="POST" name = "form1">
<h1><center>以下の内容で保存してよろしいですか？</center></h1>
<table align = center>
<tr>
<td>
<input type="submit" value="保存" class ="nine" >
</td>
<td>
<form action="Entry.php" method="POST" name = "form2">
<input type="submit" value="戻る" class ="nine">
</form>
</td>
</tr>
</table>

<?php
//入力値の取得
$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$t_naiyou = $_POST["t_naiyou"];
$school_name = $_POST["school_name"];
$busho = $_POST["busho"];
$user_name = $_POST["user_name"];
$user_tel = $_POST["user_tel"];
$hin_janru = $_POST["hin_janru"];
$t_bikou = $_POST["t_bikou"];
$gakubu_name = $_POST["gakubu_name"];
$t_mokuteki = $_POST["t_mokuteki"];
$t_size = $_POST["t_size"];
$t_page = $_POST["t_page"];
$t_color = $_POST["t_color"];
$t_men = $_POST["t_men"];
$t_kami = $_POST["t_kami"];
$t_orikata = $_POST["t_orikata"];
$t_busu = $_POST["t_busu"];
$t_kiboubi = $_POST["t_kiboubi"];
$t_basho = $_POST["t_basho"];
$t_money = $_POST["t_money"];
$t_youbou = $_POST["t_youbou"];
$t_sakunen_jisseki = $_POST["t_sakunen_jisseki"];

$t_sakunen_money = $_POST["t_sakunen_money"];
$t_zei_hantei = $_POST["t_zei_hantei"];
$t_sakunen_busu = $_POST["t_sakunen_busu"];
$t_sakunen_size = $_POST["t_sakunen_size"];
$t_sakunen_page = $_POST["t_sakunen_page"];
$t_sakunen_color = $_POST["t_sakunen_color"];
$t_sakunen_men = $_POST["t_sakunen_men"];
$t_sakunen_kami = $_POST["t_sakunen_kami"];
$t_sakunen_orikata = $_POST["t_sakunen_orikata"];
$t_sakunen_basho = $_POST["t_sakunen_basho"];
$t_sakunen_tantou = $_POST["t_sakunen_tantou"];

$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"0\" disabled = \"disabled\">見積もり</td>";
$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"1\" disabled = \"disabled\">発注</td>";
switch ($t_naiyou){
case 'mi':
	$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"0\" checked>見積もり</td>";
	break;
case 'ha':
	$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"1\" checked>発注</td>";
	break;
}

switch ($school_name){
	case '1':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生情報ビジネス専門学校福岡校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"1\">";
		break;
	case '2':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生外語観光＆製菓専門学校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"2\">";
		break;
	case'3':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生医療福祉専門学校福岡校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"3\">";
		break;
	case'4':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生建築＆デザイン専門学校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"4\">";
		break;
	case'5':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生公務員専門学校福岡校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"5\">";
		break;
	case'6':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生リハビリテーション大学校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"6\">";
		break;
	case'7':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生工科自動車大学校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"7\">";
		break;
	case'8':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生ビューティーカレッジ\" readonly>";
		"<input type=\"hidden\" name=\"school_name\" value=\"8\">";
		break;
	case'9':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生情報ビジネス専門学校北九州校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"9\">";
		break;
	case'10':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生公務員専門学校北九州校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"10\">";
		break;
	case'11':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生医療福祉＆観光カレッジ\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"11\">";
		break;
	case'12':
		$school = "<input type=\"text\" name=\"school\" class = \"one\" value=\"麻生看護大学校\" readonly>";
		$school2="<input type=\"hidden\" name=\"school_name\" value=\"12\">";
		break;
}

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

switch ($gakubu_name){
	case '1':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"組み込みシステム科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"1\">";
		break;
	case '2':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"情報工学科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"2\">";
		break;
	case'3':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"ネットワーク・セキュリティ科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"3\">";
		break;
	case'4':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"情報システム専攻科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"4\">";
		break;
	case'5':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"情報システム科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"5\">";
		break;
	case'6':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"エアライン科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"6\">";
		break;
	case'7':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"エアポート科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"7\">";
		break;
	case'8':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"製菓パティシエ科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"8\">";
		break;
	case'9':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"医療秘書科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"9\">";
		break;
	case'10':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"医療情報科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"10\">";
		break;
	case'11':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"診療情報管理士科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"11\">";
		break;
	case'12':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"建築工学科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"12\">";
		break;
	case'13':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"建築学科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"13\">";
		break;
	case'14':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"建築士専攻科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"14\">";
		break;
	case'15':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"公務員専攻科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"15\">";
		break;
	case'16':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"公務員総合科\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"16\">";
		break;
	case'17':
		$gakubu_name = "<input type=\"text\" name=\"gakubu_name\" class = \"one\" value=\"高3コース\" readonly>";
		$gakubu_id="<input type=\"hidden\" name=\"gakubu_id\" value=\"17\">";
		break;
}

$kata = "<input type=\"radio\" name=\"t_men\" value=\"片面\" disabled = \"disabled\">片面</td>";
$ryo = "<input type=\"radio\" name=\"t_men\" value=\"両面\" disabled = \"disabled\">両面</td>";
switch ($t_men){
	case '1':
		$kata = "<input type=\"radio\" name=\"t_men\" value=\"片面\" checked>片面</td>";
		break;
	case '2':
		$ryo = "<input type=\"radio\" name=\"t_men\" value=\"両面\" checked>両面</td>";
		break;
}

$yes = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"1\" disabled = \"disabled\">あり</td>";
$no = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"0\" disabled = \"disabled\">なし</td>";
switch ($t_sakunen_jisseki){
	case '1':
		$yes = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"1\" checked>あり</td>";
		break;
	case '2':
		$no = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"0\" checked>なし</td>";
		break;
}

$komi = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"1\" disabled = \"disabled\">(税込み)</td>";
$nuki = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"0\" disabled = \"disabled\">(税抜き)</td>";
switch ($t_zei_hantei){
	case '1':
		$komi = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"1\" checked>(税込み)</td>";
		break;
	case '2':
		$nuki = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"0\" checked>(税抜き)</td>";
		break;
}

$l_kata = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"片面\" disabled = \"disabled\">片面</td>";
$l_ryo = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"両面\" disabled = \"disabled\">両面</td>";
switch ($t_sakunen_men){
	case '1':
		$l_kata = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"片面\" checked>片面</td>";
		break;
	case '2':
		$l_ryo = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"両面\" checked>両面</td>";
		break;
}
?>

<table border=0 width=713 style='border-collapse:
 collapse;table-layout:fixed;width:529pt' align = center>
 <col width=31 span=23 style='width:23pt'>
 <tr height=36 style='height:27.0pt'>
 <td height=36 width=31 style='height:27.0pt;width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 <td width=31 style='width:23pt'></td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl65>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl66>　</td>
 <td class=xl67>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan=4 class=xl115>注文書</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td class=xl70></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td colspan ="2">
 <INPUT type="text" name="year" size = "1" maxlength = "4" readonly value =  <?php echo $year; ?> >
 </td>
 <td>年</td>
 <td>
 <INPUT type="text" name="month" size = "2" maxlength = "2" class = "two" readonly value =  <?php echo $month; ?>>
 </td>
 <td>月</td>
 <td>
 <INPUT type="text" name="date" size = "2" maxlength = "2" class = "two" readonly value =  <?php echo $date; ?>>
 </td>
 <td>日</td>
 <td class=xl69></td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>注文内容</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <?php
 echo "<td class=xl71 colspan=3 style='mso-ignore:colspan'>";
 echo $estimate?>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <?php
 echo "<td class=xl71 colspan=2 style='mso-ignore:colspan'>";
 echo $order?>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl71>　</td>
 <td class=xl72>　</td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36b>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>学校名</td>
 <td colspan=8 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <?php echo $school ?>
 <?php echo $school2 ?>
 </td>
 <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>部署名</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="busho" maxlength="15" class = "one" readonly value =  <?php echo $busho; ?>>
 </td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black'>ご担当者名</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="user_name" maxlength="15" class = "one" readonly value =  <?php echo $user_name; ?>>
 </td>
 <td colspan=4 class=xl89 style='border-right:.5pt solid black;border-left:none'>お電話番号</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="number" name="user_tel" maxlength="11" class = "one" readonly value =  <?php echo $user_tel; ?>>
 </td>
 <td class=xl69>　</td>
 </tr>

 <tr height=36 style='mso-height-source:userset;height:27.0pt'>
 <td height=36 style='height:27.0pt'></td>
 <td class=xl68>　</td>
 <td colspan=4 class=xl114 style='border-right:.5pt solid black'>品名</td>
 <td colspan=6>
 <?php echo $hin_janru_mei ?>
 <?php echo $hin ?>
 </td>
 <td colspan=3 class=xl114 style='border-right:.5pt solid black'>備考</td>
 <td colspan=7 class=xl114 style='border-right:.5pt solid black;border-bottom:border-left:none'>
 <textarea name="t_bikou" rows="2" wrap="soft" maxlength = "255" class = "one" readonly>
 <?php echo $t_bikou ?>
 </textarea>
 </td>
 <td class=xl69>　</td>
 </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>利用する学部系</td>
  <td colspan=6 class=xl89 style='border-left:none'>
  <?php echo $gakubu_name; ?>
  <?php echo $gakubu_id?>
  </td>
  <td colspan=3 class=xl111 style='border-right:.5pt solid black'>利用目的</td>
  <td colspan=7 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <textarea name="t_mokuteki" rows="2" wrap="soft" maxlength = "255" class = "one" readonly>
  <?php echo $t_mokuteki; ?>
  </textarea>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>仕様</td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>サイズ</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_size" maxlength="2" class = "three" readonly value = <?php echo $t_size; ?>>
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_page" maxlength="3" class = "three" readonly value = <?php echo $t_page; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_color" maxlength="3" class = "three" readonly value = <?php echo $t_color; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=3 class=xl90>
  <?php
  echo $kata
  ?>
  </td>
  <td colspan=3 class=xl90 style='border-right:.5pt solid black'>
  <?php
  echo $ryo
  ?>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>紙</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_kami" maxlength="10" class = "one" readonly value = <?php echo $t_kami; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_orikata" maxlength="10" class = "one" readonly value = <?php echo $t_orikata; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>部数</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_busu" maxlength="7" class = "five" readonly value = <?php echo $t_busu; ?>>部</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_kiboubi" maxlength="20" class = "one" readonly value = <?php echo $t_kiboubi; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望納品場所</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_basho" maxlength="60" class = "one" readonly value = <?php echo $t_basho; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望金額</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_money" maxlength="8" class = "six money" readonly value = <?php echo $t_money; ?>>円
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>仕様の要望</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_youbou" class = "one" readonly value = <?php echo $t_youbou; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl108 style='border-right:.5pt solid black'>昨年制作実績の有無</td>
  <td class=xl73 style='border-top:none;border-left:none'>　</td>
  <td class=xl71 style='border-top:none'>　</td>
  <td colspan=5 class=xl90>
  <?php
  echo $yes
  ?>
  </td>
  <td class=xl71 style='border-top:none'>　</td>
  <td colspan=5 class=xl90>
  <?php
  echo $no
  ?>
  </td>
  <td class=xl71 style='border-top:none'>　</td>
  <td class=xl71 style='border-top:none'>　</td>
  <td class=xl72 style='border-top:none'>　</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
  <td class=xl71>　</td>
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
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-bottom:.5pt solid black'>昨年実績費用</td>
  <td colspan=8 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="t_sakunen_money" maxlength="8" class = "seven" readonly value = <?php echo $t_sakunen_money; ?>>
  </td>
  <td rowspan=2 class=xl94 style='border-bottom:.5pt solid black'>　</td>
  <td colspan=3 rowspan=2 class=xl95 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <?php
  echo $komi
  ?>
  </td>
  <td rowspan=2 class=xl95 style='border-bottom:.5pt solid black'>　</td>
  <td colspan=3 rowspan=2 class=xl95 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <?php
  echo $nuki
  ?>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>昨年部数</td>
  <td colspan=10 rowspan=2 class=xl100 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>
  <input type="text" name="t_sakunen_busu" class = "four" readonly value = <?php echo $t_sakunen_busu; ?>>部
  </td>
  <td colspan=6 rowspan=2 class=xl102 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>※↑必ずどちらか解る様にしてください。</td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td class=xl69>　</td>
  </tr>
  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 rowspan=2 class=xl94 style='border-right:.5pt solid black;
  border-bottom:.5pt solid black'>昨年仕様</td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>サイズ</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_size" maxlength="2" class = "three" readonly value = <?php echo $t_sakunen_size; ?>>
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_page" maxlength="3" class = "three" readonly value = <?php echo $t_sakunen_page; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_color" maxlength="3" class = "three" readonly value = <?php echo $t_sakunen_color; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=3 class=xl90>
  <?php
  echo $l_kata
  ?>
  </td>
  <td colspan=3 class=xl90 style='border-right:.5pt solid black'>
  <?php
  echo $l_ryo
  ?>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>紙</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_kami" maxlength="10" class = "one" readonly value = <?php echo $t_sakunen_kami; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_orikata" maxlength="10" class = "one" readonly value = <?php echo $t_sakunen_orikata; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>昨年発注先</td>
  <td colspan=8 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_basho" maxlength = "60" class = "one" readonly value = <?php echo $t_sakunen_basho; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>担当者</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one" readonly value = <?php echo $t_sakunen_tantou; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
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
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td></td>
  <td colspan=3 style='mso-ignore:colspan'>電話での</td>
  <td></td>
  <td colspan=8 rowspan=2 class=xl92>092-433-8735</td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 style='mso-ignore:colspan'>お問い合わせは</td>
  <td></td>
  <td></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl78></td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl83>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td colspan = "5" class=xl84>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl84>　</td>
  <td class=xl85>　</td>
  </tr>

  <tr height=0 style='display:none'>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td width=31 style='width:23pt'></td>
  <td  width=31 style='width:23pt'></td>
  </tr>

  </table>
  </form>
  </div>
  </body>
  </html>