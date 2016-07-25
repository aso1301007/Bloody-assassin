<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel=Stylesheet href=stylesheet.css type="text/css">
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<style >
<!--table
{mso-displayed-decimal-separator:"\.";
mso-displayed-thousand-separator:"\,";}
@page
{margin:.75in .7in .75in .7in;
mso-header-margin:.3in;
mso-footer-margin:.3in;}
-->
</style>


<title>書類閲覧</title>


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
<script type="text/javascript">
      $(function(){
           $("a[href^='http://']").attr("target","_blank");
           $(".open").click(function(){
                $("#slideBox").slideToggle("fast");
           });
      });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open2").click(function(){
               $("#slideBox2").slideToggle("fast");
          });
     });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open3").click(function(){
               $("#slideBox3").slideToggle("fast");
          });
     });
 </script>

<script>//プルダウン切り替え
		$(function domReady() {
  		$('.demo').focused();
		});
</script>

</head>

<body>

<?php

session_start();
require '../../DB.php';
require '../../user_name.php';

// $user_name=$_SESSION['user_name'];   //ユーザー名取得
// $tm_id=$_POST['eturan_tm_id'];     //選んだ注文書id
$user_name="福田崇";
$tm_id="1";

//ログインしていないorセッションが切れた場合------------
if($user_name==null){
	header("Location: ../../Login/login.html");
}
//-------------------------------------------------------
echo "tm_id:".$tm_id;

//-----注文書内容をDBから受け取る-----------------------


$tm_id="1";
$sql = "SELECT * FROM ((((((tyuumon TY
		INNER JOIN school SC ON TY.school_id = SC.school_id)
		INNER JOIN tyuumon_master TM ON TY.tm_id=TM.tm_id)
		INNER JOIN tyuumonsha TS ON TM.user_id=TS.user_id)
		INNER JOIN user U ON TM.user_id=U.user_id)
		INNER JOIN gakubu GK ON TY.school_id=GK.school_id)
		LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)
		WHERE TY.tm_id =:tm_id";
$data = $pdo->prepare($sql);
$data->bindParam(':tm_id', $tm_id, PDO::PARAM_STR);
$data->execute();
?>
<body>

<div id="header">
			<input type = "button" name = "top" value = "TOP" onclick = "location.href='../Select_Report/School_Home.psp'">
			<div id="login_name">担当者さん</div>
</div>

<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログアウト
				<ul style="list-style:none;">
					<li><a href="../../Login/Logout.php">ログアウト</a></li>
				</ul>
			</li>
			<li>注文書
				<ul style="list-style:none;">
					<li><a href="#">新規注文書</a></li>
					<li><a href="#">注文書選択</a></li>
				</ul>
			</li>
			<li>書類
				<ul style="list-style:none;">
					<li><a href="Image_selection.php">書類閲覧</a></li>
					<li><a href="#">製作物画像登録</a></li>
				</ul>
			</li>
			<li>進捗管理
				<ul style="list-style:none;">
					<li><a href="../progress/Purchase_order_selection.php">進捗管理</a></li>
				</ul>
			</li>
		</ul>
</div>


<div id="main">
<div id = "border"></div>
<p></p>
<h1><center>以下の内容で保存してよろしいですか？</center></h1>
<table align = center>
<tr>
<td>
<form action="Save_success.php" method="post" name = "form1">
<input type="submit" value="保存" class ="nine">
</form>
</td>
<td>
<form action="newfile1.php" method="post" name = "form2">
<input type="submit" value="戻る" class ="nine">
</form>
</td>
</tr>
</table>

<?php
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$user_name=$row['user_name'];
	$user_tel=$row['user_tel'];
	$t_user_id=$row['user_id'];    //注文マスターテーブルを主にする為の取得
	$t_date = $row['t_date'];
	$t_naiyou = $row['t_naiyou'];     //見積りor発注
	$school_name=$row['school_name']; //学校名
	$gakubu=$row['t_gakubu'];
	$hin_name = $row['t_hin_name'];      //品名
	$tyuumonsha_busho_name=$row['tyuumonsha_busho_name'];  //利用する学部名
	echo $tyuumonsha_busho_name;
	$bikou = $row['t_bikou'];
	$mokuteki = $row['t_mokuteki'];
	$size=$row['t_size'];
	$page = $row['t_page'];
	$color = $row['t_color'];
	$men = $row['t_men'];
	$kami = $row['t_kami'];
	$orikata = $row['t_orikata'];
	$busu = $row['t_busu'];
	$kiboubi = $row['t_kiboubi'];
	$basyo = $row['t_basho'];
	$money = $row['t_money'];
	$youbou = $row['t_youbou'];
	$s_tm_id = $row['t_sakunen_tm_id'];
	$s_jisseki = $row['t_sakunen_jisseki'];
	$s_hiyou = $row['t_sakunen_hiyou'];
	$s_zei_hantei = $row['t_zei_hantei'];
	$s_busu = $row['t_sakunen_busu'];
	$s_size = $row['t_sakunen_size'];
	$s_page = $row['t_sakunen_page'];
	$s_color = $row['t_sakunen_color'];
	$s_men = $row['t_sakunen_men'];
	$s_kami = $row['t_sakunen_kami'];
	$s_orikata = $row['t_sakunen_orikata'];
	$s_basyo = $row['t_sakunen_basho'];
	$s_tantou = $row['t_sakunen_tantou'];  //昨年担当者名
	$img_path=$row['gazou_path'];     //画像
}
list($year, $month, $date) = explode('-', $t_date);  // 文字列の分解

$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" disabled = \"disabled\">見積もり</td>";
$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" disabled = \"disabled\">発注</td>";
switch ($t_naiyou){
case 'mi':
	$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" checked disabled = \"disabled\">見積もり</td>";
	break;
case 'ha':
	$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" checked disabled = \"disabled\">発注</td>";
	break;
}

switch ($school_name){
	case '1':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生情報ビジネス専門学校福岡校\" readonly>";
		break;
	case '2':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生外語観光＆製菓専門学校\" readonly>";
		break;
	case'3':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生医療福祉専門学校福岡校\" readonly>";
		break;
	case'4':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生建築＆デザイン専門学校\" readonly>";
		break;
	case'5':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生公務員専門学校福岡校\" readonly>";
		break;
	case'6':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生リハビリテーション大学校\" readonly>";
		break;
	case'7':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生工科自動車大学校\" readonly>";
		break;
	case'8':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生ビューティーカレッジ\" readonly>";
		break;
	case'9':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生情報ビジネス専門学校北九州校\" readonly>";
		break;
	case'10':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生公務員専門学校北九州校\" readonly>";
		break;
	case'11':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生医療福祉＆観光カレッジ\" readonly>";
		break;
	case'12':
		$school = "<input type=\"text\" name=\"school_name\" class = \"one\" value=\"麻生看護大学校\" readonly>";
		break;
}

switch ($hin_name){
case '1':
	$hin_janru_mei = "<input type=\"text\" name=\"t_hin_name\" class = \"one\" value=\"パンフレット\" readonly>";
	break;
case '2':
	$hin_janru_mei = "<input type=\"text\" name=\"t_hin_name\" class = \"one\" value=\"ポスター\" readonly>";
	break;
case'3':
	$hin_janru_mei = "<input type=\"text\" name=\"t_hin_name\" class = \"one\" value=\"看板\" readonly>";
	break;
case'4':
	$hin_janru_mei = "<input type=\"text\" name=\"t_hin_name\" class = \"one\" value=\"その他\" readonly>";
	break;
}

$kata = "<input type=\"radio\" name=\"t_men\" value=\"kata\" disabled = \"disabled\">片面</td>";
$ryo = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" disabled = \"disabled\">両面</td>";
switch ($men){
	case '1':
		$kata = "<input type=\"radio\" name=\"t_men\" value=\"kata\" checked disabled = \"disabled\">片面</td>";
		break;
	case '2':
		$ryo = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" checked disabled = \"disabled\">両面</td>";
		break;
}

$yes = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" disabled = \"disabled\">あり</td>";
$no = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" disabled = \"disabled\">なし</td>";
switch ($s_jisseki){
	case '1':
		$yes = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" checked disabled = \"disabled\">あり</td>";
		break;
	case '2':
		$no = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" checked disabled = \"disabled\">なし</td>";
		break;
}

$komi = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"1\" disabled = \"disabled\">(税込み)</td>";
$nuki = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"2\" disabled = \"disabled\">(税抜き)</td>";
switch ($s_zei_hantei){
	case '1':
		$komi = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"1\" checked disabled = \"disabled\">(税込み)</td>";
		break;
	case '2':
		$nuki = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"2\" checked disabled = \"disabled\">(税抜き)</td>";
		break;
}

$l_kata = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"1\" disabled = \"disabled\">片面</td>";
$l_ryo = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"2\" disabled = \"disabled\">両面</td>";
switch ($s_men){
	case '1':
		$l_kata = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"1\" checked disabled = \"disabled\">片面</td>";
		break;
	case '2':
		$l_ryo = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"2\" checked disabled = \"disabled\">両面</td>";
		break;
}
?>

<form action="newfile3.php" method="post">
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
 <?php echo $school_name; ?>
 </td>
 <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>部署名</td>
 <td colspan=6 class=xl113 style='border-right:.5pt solid black;border-left:none'>
 <input type="text" name="name" maxlength="15" class = "one" readonly value =  <?php echo $tyuumonsha_busho_name; ?>>
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
  <input type="text" name="gakubu_name" maxlength="20" class = "one" readonly value =  <?php echo $gakubu; ?>>
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
  <input type="text" name="t_size" maxlength="2" class = "three" readonly value = <?php echo $size; ?>>
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_page" maxlength="3" class = "three" readonly value = <?php echo $page; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_color" maxlength="3" class = "three" readonly value = <?php echo $color; ?>>
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
  <input type="text" name="t_kami" maxlength="10" class = "one" readonly value = <?php echo $kami; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_orikata" maxlength="10" class = "one" readonly value = <?php echo $orikata; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>部数</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_busu" maxlength="7" class = "five" readonly value = <?php echo $busu; ?>>部</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_kiboubi" maxlength="20" class = "one" readonly value = <?php echo $kiboubi; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望納品場所</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_basho" maxlength="60" class = "one" readonly value = <?php echo $basyo; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>希望金額</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_money" maxlength="8" class = "six money" readonly value = <?php echo $money; ?>>円
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>仕様の要望</td>
  <td colspan=16 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_youbou" class = "one" readonly value = <?php echo $youbou; ?>>
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
  <input type="text" name="t_sakunen_money" maxlength="8" class = "seven" readonly value = <?php echo $s_hiyou; ?>>
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
  <input type="text" name="t_sakunen_busu" class = "four" readonly value = <?php echo $s_busu; ?>>部
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
  <input type="text" name="t_sakunen_size" maxlength="2" class = "three" readonly value = <?php echo $s_size; ?>>
  </td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>ページ数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_page" maxlength="3" class = "three" readonly value = <?php echo $s_page; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>色数</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_color" maxlength="3" class = "three" readonly value = <?php echo $s_color; ?>>
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
  <input type="text" name="t_sakunen_kami" maxlength="10" class = "one" readonly value = <?php echo $s_kami; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>折り方</td>
  <td colspan=3 class=xl89 style='border-right:.5pt solid black;border-left:
  none'>
  <input type="text" name="t_sakunen_orikata" maxlength="10" class = "one" readonly value = <?php echo $s_orikata; ?>>
  </td>
  <td class=xl69>　</td>
  </tr>

  <tr height=36 style='mso-height-source:userset;height:27.0pt'>
  <td height=36 style='height:27.0pt'></td>
  <td class=xl68>　</td>
  <td colspan=4 class=xl89 style='border-right:.5pt solid black'>昨年発注先</td>
  <td colspan=8 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_basho" maxlength = "60" class = "one" readonly value = <?php echo $s_basyo; ?>>
  </td>
  <td colspan=2 class=xl89 style='border-right:.5pt solid black;border-left:none'>担当者</td>
  <td colspan=6 class=xl89 style='border-right:.5pt solid black;border-left:none'>
  <input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one" readonly value = <?php echo $s_tantou; ?>>
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