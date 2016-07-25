<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
<title>注文書表示</title>
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
</head>
<body>
<?php
	require '../../DB.php';			//DB.php呼び出し
?>
<div id="header">
	<div id="top">
		<input type="button" name="top" value="TOP" onclick="location.href='/acs_system/Shcool/School_Home.php'" />
	</div>
	<div id="login_name"><?php echo $_SESSION['user_name'];?>さん</div>
</div>
<div id="select_menu" style="clear:left;">
	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../Login/Logout.php">ログアウト</a></li>
			</ul>
		</li>
		<li>注文機能
			<ul style="list-style:none;">
				<li><a href="#">新規注文書</a></li>
				<li><a href="#">注文書選択</a></li>
			</ul>
		</li>
		<li>書類
			<ul style="list-style:none;">
				<li><a href="Document_Browsing/Image_selection.php">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="progress/Purchase_order_selection.php">進捗管理</a></li>
			</ul>
		</li>
	</ul>
</div>
<div id="main">
<?php	//DBから発注書の内容を検索
	$id = $_REQUEST["id"];	//Selection.phpから選択した項目の注文idを受け取る
	$sql = "SELECT *
			FROM ((tyuumon t1 inner join tyuumon_master t2 on t1.tm_id = t2.tm_id)
				inner join school s1 on t1.school_id = s1.school_id)
				inner join hinmei h1 on t1.t_hin_name = h1.hin_id
			WHERE t1.tm_id = ". $id;
	$result_sql = $pdo->prepare($sql);
	$result_sql->execute();
	if(!$result_sql) var_dump($result_sql->errorInfo());
	$SQL = $result_sql->fetch(PDO::FETCH_ASSOC);
?>

<?php //検索したデータを加工
	$year = date('Y', strtotime($SQL['t_date']));
	$month = date('m', strtotime($SQL['t_date']));
	$day = date('d', strtotime($SQL['t_date']));
	//見積もり・発注
	$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" disabled />見積もり</td>";
	$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" disabled />発注</td>";
	switch($SQL['t_naiyou']){
		case '見積もり':
			$estimate = "<input type=\"radio\" name=\"t_naiyou\" value=\"est\" checked disabled />見積もり</td>";
			break;

		case '発注':
		$order = "<input type=\"radio\" name=\"t_naiyou\" value=\"ord\" checked disabled />発注</td>";
		break;
	}
	//学校名
	$school_name = $SQL['school_name'];
	//部署名
	$department_name = $SQL['t_busho'];
	//担当者名
	$responsible_party = $SQL['t_tantousha'];
	//電話番号
	$phone_number = $SQL['t_tel'];
	//品名
	$product_name = $SQL['hin_janru'];
	//備考
	$remarks = $SQL['t_bikou'];
	//利用する学部系
	$undergraduate = $SQL['t_gakubu'];
	//利用目的
	$purpose = $SQL['t_mokuteki'];
	//仕様
	//サイズ
	$specification_size =  $SQL['t_size'];
	//ページ数
	$specification_page =  $SQL['t_page'];
	//色数
	$specification_color =  $SQL['t_color'];
	//紙
	$specification_kami =  $SQL['t_kami'];
	//折り方
	$specification_orikata =  $SQL['t_orikata'];
	//仕様(ラジオボタン)
	$k_men = "<input type=\"radio\" name=\"t_men\" value=\"kata\" disabled />片面</td>";
	$r_men = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" disabled />両面</td>";
	switch($SQL['t_men']){
		case '片面':
			$k_men = "<input type=\"radio\" name=\"t_men\" value=\"kata\" checked disabled />片面</td>";
			break;

		case '両面':
			$r_men = "<input type=\"radio\" name=\"t_men\" value=\"ryo\" checked disabled />両面</td>";
			break;
	}

	//部数
	$copies_number = $SQL['t_busu'];
	//納品希望日
	$pefeeferred_date = $SQL['t_kiboubi'];
	//希望納品場所
	$dsired_locat = $SQL['t_basho'];
	//希望金額
	$hope_amount_of_money = $SQL['t_money'];
	//仕様の要望
	$demand_of_specification = $SQL['t_youbou'];
	//昨年製作実績の有無
	$last_year_T = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" disabled />あり</td>";
	$last_year_F = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" disabled />なし</td>";
	if($SQL['t_sakunen_jisseki']){//実績あり
		$last_year_T = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"yes\" checked disabled />あり</td>";
		//昨年実績
		//昨年費用
		$last_year_actual_expenses = $SQL['t_sakunen_hiyou'];
		//税込
		$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" disabled />(税込み)</td>";
		//税抜
		$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" disabled />(税抜き)</td>";
		if($SQL['t_zei_hantei']){
			$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" checked disabled />(税込み)</td>";
		}
		else{
			$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" checked disabled />(税抜き)</td>";
		}
		//昨年部数
		$last_year_copies_number = $SQL['t_sakunen_busu'];
		//昨年仕様(サイズ)
		$last_year_specification_size = $SQL['t_sakunen_size'];
		//昨年仕様(ページ数)
		$last_year_specification_page = $SQL['t_sakunen_page'];
		//昨年仕様(色数)
		$last_year_specification_color = $SQL['t_sakunen_color'];
		//昨年仕様(紙)
		$last_year_specification_kami = $SQL['t_sakunen_kami'];
		//昨年仕様(折り方)
		$last_year_specification_orikata = $SQL['t_sakunen_orikata'];
		//仕様(ラジオボタン)
		$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" disabled />片面</td>";
		$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" disabled />両面</td>";
		switch($SQL['t_sakunen_men']){
			case '片面':
				$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" checked disabled />片面</td>";
				break;

			case '両面':
				$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" checked disabled />両面</td>";
				break;
		}
		//昨年発注先
		$last_year_ordering_destination = $SQL['t_sakunen_basho'];
		//昨年担当者
		$the_person_in_charge = $SQL['t_sakunen_tantou'];
	}
	else{
		$last_year_F = "<input type=\"radio\" name=\"t_sakunen_jisseki\" value=\"no\" checked disabled />なし</td>";
		//昨年実績
		$last_year_actual_expenses = "";		//費用
		$tax_included = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"komi\" disabled />(税込み)</td>";	//税込
		$tax_excluded = "<input type=\"radio\" name=\"t_zei_hantei\" value=\"nuki\" disabled />(税抜き)</td>";	//税抜
		$last_year_copies_number = "";			//部数
		$last_year_specification_size = "";		//仕様(サイズ)
		$last_year_specification_page = "";		//仕様(ページ数)
		$last_year_specification_color = "";	//仕様(色数)
		$last_year_specification_kami = "";		//仕様(紙)
		$last_year_specification_orikata = "";	//仕様(折り方)
		$last_year_k_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"kata\" disabled />片面</td>";	//仕様(ラジオボタン)
		$last_year_r_men = "<input type=\"radio\" name=\"t_sakunen_men\" value=\"ryo\" disabled />両面</td>";	//仕様(ラジオボタン)
		$last_year_ordering_destination = "";	//発注先
		$the_person_in_charge = "";				//担当者
	}



	//注文書承認
//	$order_approval = "";

?>
<form>
<table border="0px" width="713px" style='border-collapse: collapse;table-layout:fixed;width:529pt' align = "center">
<col width="31px" span="23px" style='width: 23pt;' />
<tr style='height: 27.0pt;'>
<td height="36px" width="31px" style='height:27.0pt;width:23pt;' />
<?php
$c = 0;
while($c < 12){
	echo "<td width=\"31px\" style='width:23pt' />";
	$c++;
}
?></tr>

<tr style='mso-height-source:userset;height:27.0pt;'>
<td height="36px" style='height:27.0pt' />
<td class="xl65">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td class=\"xl66\">　</td>";
	$c++;
}
?>
<td class="xl67">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}
echo "<td colspan=\"4\" class=\"xl115\">注文書</td>";//題名
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 4){
	echo "<td />";
	$c++;
}
echo "<td class=\"xl70\" />";
$c = 0;
while($c < 8){
	echo "<td />";
	$c++;
}?>
<td colspan ="2">
<input type="text" name="year" size = "1" maxlength = "4" value="<?php echo $year; ?>" disabled="disabled" /></td>
<td>年</td>
<td><input type="text" name="month" size = "2" maxlength = "2" class = "two" value="<?php echo $month; ?>" disabled="disabled" /></td>
<td>月</td>
<td><input type="text" name="date" size = "2" maxlength = "2" class = "two" value="<?php echo $day; ?>" disabled="disabled" /></td>
<td>日</td>
<td class="xl69" />
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>注文内容</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<?php
echo "<td class=\"xl71\" colspan=\"3\" style='mso-ignore:colspan'>";
echo $estimate;
$c = 0;
while($c < 4){
	echo "<td class=\"xl71\">　</td>";
	$c++;
}
echo "<td class=\"xl71\" colspan=\"2\" style='mso-ignore:colspan'>";
echo $order;
$c = 0;
while($c < 4){
	echo "<td class=\"xl71\">　</td>";
	$c++;
}
?>
<td class="xl72">　</td>
<td class="xl69">　</td>
</tr>

<tr>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>学校名</td>
<td colspan="8" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="school_name" maxlength="25" class = "one" value = "<?php echo $school_name;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>部署名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="name" maxlength="15" class = "one" value = "<?php echo $department_name;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr  style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>ご担当者名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_name" maxlength="15" class = "one" value = "<?php echo $responsible_party;?>" disabled="disabled" /></td>
<td colspan="4"class="xl89" style='border-right:.5pt solid black;border-left:none'>お電話番号</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_tel" maxlength="11" class = "one" value = "<?php echo $phone_number;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl114" style='border-right:.5pt solid black'>品名</td>
<td colspan="6">
<input type="text" name="product_name" class = "one" value = "<?php echo $product_name;?>" disabled="disabled" /></td>
<td colspan="3" class="xl114" style='border-right:.5pt solid black'>備考</td>
<td colspan="7" class="xl114" style='border-right:.5pt solid black;border-bottom:border-left:none'>
<textarea name="t_bikou" rows="2" wrap="soft" maxlength = "255" class = "one" disabled="disabled"><?php echo $remarks;?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>利用する学部系</td>
<td colspan="6" class="xl89" style='border-left:none'>
<input type="text" name="gakubu_name" maxlength="20" class = "one" value = "<?php echo $undergraduate;?>" disabled="disabled" /></td>
<td colspan="3" class="xl111" style='border-right:.5pt solid black'>利用目的</td>
<td colspan="7" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<textarea name="t_mokuteki" rows="2" wrap="soft" maxlength = "255" class = "one" disabled="disabled"><?php echo $purpose;?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>仕様</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>サイズ</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_size" maxlength="2" class = "three" value = "<?php echo $specification_size;?>" disabled="disabled" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_page" maxlength="3" class = "three" value = "<?php echo $specification_page;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_color" maxlength="3" class = "three" value = "<?php echo $specification_color;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
echo "<td colspan=\"3\" class=\"xl90\">";
echo $k_men;
echo "<td colspan=\"3\" class=\"xl90\" style='border-right:.5pt solid black'>";
echo $r_men;
?>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kami" maxlength="10" class = "one" value = "<?php echo $specification_kami;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_orikata" maxlength="10" class = "one" value = "<?php echo $specification_orikata;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>部数</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_busu" maxlength="7" class = "five" value = "<?php echo $copies_number;?>" disabled="disabled" />部</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kiboubi" maxlength="20" class = "one" value = "<?php echo $pefeeferred_date;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望納品場所</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_basho" maxlength="60" class = "one" value = "<?php echo $dsired_locat;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>
<tr>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望金額</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_money" maxlength="8" class = "six money" value = "<?php echo $hope_amount_of_money;?>" disabled="disabled" />円</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>仕様の要望</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_youbou" class = "one" value = "<?php echo $demand_of_specification;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl108" style='border-right:.5pt solid black'>昨年制作実績の有無</td>
<td class="xl73" style='border-top:none;border-left:none'>　</td>
<td class="xl71" style='border-top:none'>　</td>
<?php
echo "<td colspan=\"5\" class=\"xl90\">";
echo $last_year_T;
?>
<td class="xl71" style='border-top:none'>　</td>
<?php
echo "<td colspan=\"5\" class=\"xl90\">";
echo $last_year_F;
?>
<td class="xl71" style='border-top:none'>　</td>
<td class="xl71" style='border-top:none'>　</td>
<td class="xl72" style='border-top:none'>　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<?php
$c = 0;
while($c < 16){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-bottom:.5pt solid black'>昨年実績費用</td>
<td colspan="8" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="text" name="t_sakunen_money" maxlength="8" class = "six money" value = "<?php echo $last_year_actual_expenses;?>" disabled="disabled" />円</td>
<td rowspan="2" class="xl94" style='border-bottom:.5pt solid black'>　</td>
<?php
echo "<td colspan=\"3\" rowspan=\"2\" class=\"xl95\" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>";
echo $tax_included;
?>
<td rowspan="2" class="xl95" style='border-bottom:.5pt solid black'>　</td>
<?php
echo "<td colspan=\"3\" rowspan=\"2\" class=\"xl95\" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>";
echo $tax_excluded;
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>昨年部数</td>
<td colspan="10" rowspan="2" class="xl100" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="text" name="t_sakunen_busu" class = "four" value = "<?php echo $last_year_copies_number;?>" disabled="disabled" />部</td>
<td colspan="6" rowspan="2" class="xl102" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>※↑必ずどちらか解る様にしてください。</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black;border-bottom:.5pt solid black'>昨年仕様</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>サイズ</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_size" maxlength="2" class = "three" value = "<?php echo $last_year_specification_size;?>" disabled="disabled" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_page" maxlength="3" class = "three" value = "<?php echo $last_year_specification_page;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_color" maxlength="3" class = "three" value = "<?php echo $last_year_specification_color;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
echo "<td colspan=\"3\" class=\"xl90\">";
echo $last_year_k_men;
echo "<td colspan=\"3\" class=\"xl90\" style='border-right:.5pt solid black'>";
echo $last_year_r_men;
?>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_kami" maxlength="10" class = "one" value = "<?php echo $last_year_specification_kami;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_orikata" maxlength="10" class = "one" value = "<?php echo $last_year_specification_orikata;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>昨年発注先</td>
<td colspan="8" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_basho" maxlength = "60" class = "one" value = "<?php echo $last_year_ordering_destination;?>" disabled="disabled" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>担当者</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one" value = "<?php echo $the_person_in_charge;?>" disabled="disabled" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl74\" />";
	$c++;
}
?>
<td colspan="6" class="xl93">注文書承認</td>
<td class="xl74" />
<?php
$c = 0;
while($c < 7){
	echo "<td />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td class="xl75" />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl76\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>最終責任者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="saisyu" value="1" disabled="disabled" /></td>
<td class="xl76" />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79"></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl76\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>役職者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="yakusyoku" value="2" disabled="disabled" /></td>
<td class="xl76" />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79" />
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>担当者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="tanto1" value="3" disabled="disabled" /></td>
<td />
<td />
<?php
$c = 0;
while($c < 5){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl79"></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl80\" />";
	$c++;
}
?>
<td colspan="5" class="xl86" style='border-right:.5pt solid black'>担当者</td>
<td class="xl77" style='border-top:none;border-left:none'>
<input type="checkbox" name="tanto2" value="4" disabled="disabled" /></td>
<td class="xl80"></td>
<?php
$c = 0;
while($c < 6){
	echo "<td />";
	$c++;
}
?>
<td class="xl82" />
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<?php
$c = 0;
while($c < 13){
	echo "<td class=\"xl80\" />";
	$c++;
}
?>
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset; height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td />
<td colspan="3" style='mso-ignore:colspan'>電話での</td>
<td />
<td colspan="8" rowspan="2" class="xl92">092-433-8735</td>
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" style='mso-ignore:colspan'>お問い合わせは</td>
<td />
<td />
<?php
$c = 0;
while($c < 6){
	echo "<td class=\"xl78\" />";
	$c++;
}
?>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl83">　</td>
<?php
$c = 0;
while($c < 20){
	echo "<td class=\"xl84\">　</td>";
	$c++;
}
?>
<td class="xl85">　</td>
</tr>

<tr style='display:none'>
<?php
$c = 0;
while($c < 23){
	echo "<td width=\"31px\" style='width:23pt' />";
	$c++;
}
?>
</tr>
</table>
<div align="center">
<input type="button" name="can" value="戻る" onclick="location.href='../../acs/ACS_Home.php'" />
</div>
</form>
</div>
<?php
// 切断
$pdo = null;
?>
</body>
</html>