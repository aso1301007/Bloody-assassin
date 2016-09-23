<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<link rel="stylesheet" type="text/css" href="css.css"/>
<title>相みつ会社選択</title>

<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
	$("#menu li").hover(function() {
	$(this).children('ul').show();
}, function() {
	$(this).children('ul').hide();
});
});
</script>
<script type="text/javascript">
//<table>10件表示
var page = 0;	//ページ数初期値
function putId(){// テーブルの行にID名を付ける
	page = 0;//現在ページ数を初期化
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	for(i=0; i<Tr.length; i++){
		Tr[i].id='trID'+i;
	}
}
function draw(){//trを10件表示
	//現在ページ数を<span id="page">に挿入
	var elem = document.getElementById("page");
	elem.innerHTML = page + 1;
	//trを隠す
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	var total = Math.floor(Tr.length / 10);
	var elem2 = document.getElementById("total");
	elem2.innerHTML = total;
	for(i=1; i<=Tr.length-1; i++){//<tr>を全て隠す
		document.getElementById("trID"+i).style.display="none";
	}
	//trを10件表示
	var start = (page +1) *10 -9;//<tr>開始番号
	var end = start +10;//<tr>終了番号
	for(start; start<end; start++){
		document.getElementById("trID"+start).style.display = "";
	}
}
function prev(){//前の10件を表示
	if (page > 0) {
		page--;
		draw();
	}
}
function next(){//次の10件を表示
	var Tbe = document.getElementById("list");//<table>を取得
	Tr = Tbe.getElementsByTagName("tr");//<table>内の<tr>を取得
	var max = Tr.length - 1;//<th>分を引く
	if (page < max / 10 - 1) {
		page++;
		draw();
	}
}
/* ページ読み込み完了時に、処理を実行 */
window.onload=function(){putId();draw();}
</script>
<style type="text/css">/* テーブル内のスタイルを定義 */
.check{
	width:20px;
	height:20px;
	text-align: right;
}
table.type07 {
	border-collapse: collapse;
	text-align: left;
	line-height: 1.5;
	border: 1px solid #ccc;
}
table.type07 thead {
	border-right: 1px solid #ccc;
	border-left: 1px solid #ccc;
	background: #04162e;
}
table.type07 thead th {
	padding: 20px;
	font-weight: bold;
	vertical-align: top;
	color: #fff;
}
table.type07 tbody th {
	width: 20px;
	padding: 10px;
	font-weight: bold;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
	background: #efefef;
	text-align:center;
}
table.type07 td {
	width: 350px;
	padding: 10px;
	vertical-align: top;
	border-bottom: 1px solid #ccc;
}

</style>
</head>
<body>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<div id="title">相みつ会社選択</div>
<?php
//注文書内の項目を検索
$id = $_REQUEST["id"];	//Select.phpから選択した項目の注文idを受け取る
$order_sql = 'SELECT *';
$order_sql .= ' FROM tyuumon t1';
$order_sql .= ' INNER JOIN tyuumon_master t2 ON t1.tm_id = t2.tm_id';
$order_sql .= ' INNER JOIN hinmei h ON t1.t_hin_name = h.hin_id';
$order_sql .= ' INNER JOIN school s ON t1.school_id = s.school_id';
$order_sql .= ' INNER JOIN gakubu g ON t1.t_gakubu = g.gakubu_id';
$order_sql .= ' WHERE t1.tm_id = '. $id;
$result_sql = $pdo->prepare($order_sql);
$result_sql->execute();
$order = $result_sql->fetch(PDO::FETCH_ASSOC);

//検索結果の中から加工を行う
//見積もり・発注ラジオボタン
switch($order['t_naiyou']){
	case 0://見積もり
		$estimate = 'checked="checked disabled="disabled""';
		$ordering = 'disabled="disabled"';
		break;

	case 1://発注
		$estimate = 'disabled="disabled"';
		$ordering = 'checked="checked" disabled="disabled"';
		break;
}
//片面・両面ラジオボタン
switch($order['t_men']){
	case '片面':
		$other = 'checked="checked" disabled="disabled"';
		$both = 'disabled="disabled"';
		break;

	case '両面':
		$other = 'disabled="disabled"';
		$both = 'checked="checked" disabled="disabled"';
		break;
}
//昨年実績の有無ラジオボタン
if($order['t_sakunen_jisseki']){
	$track_record_Y = 'checked="checked" disabled="disabled"';
	$track_record_N = 'disabled="disabled"';
}
else{
	$track_record_Y = 'disabled="disabled"';
	$track_record_N = 'checked="checked" disabled="disabled"';
}
//昨年実績：税込・税抜ラジオボタン
if($order['t_zei_hantei']){
	$tax_included = 'checked="checked"';
	$tax_excluded = '';
}
else{
	$tax_included = '';
	$tax_excluded = 'checked="checked"';
}
//昨年実績：片面・両面
//片面・両面ラジオボタン
switch($order['t_sakunen_men']){
	case '片面':
		$last_other = 'checked="checked" disabled="disabled"';
		$last_both = 'disabled="disabled"';
		break;

	case '両面':
		$last_other = 'disabled="disabled"';
		$last_both = 'checked="checked" disabled="disabled"';
		break;

	default:
		$last_other = 'disabled="disabled"';
		$last_both = 'disabled="disabled"';
		break;
}

//制作会社を検索
$company_sql = 'SELECT seisaku_id AS id, seisaku_name AS name';
$company_sql .= ' FROM seisaku_kaisha';
$result_sql2 = $pdo->prepare($company_sql);
$result_sql2->execute();
//案件数を検索
$result_count = $pdo->prepare($company_sql);
$result_count->execute();
$result_count01 = $result_count->fetchAll();
$count = count($result_count01);
?>
<!-- 折り畳み展開ポインタ 注文書 -->
<div onclick="obj=document.getElementById('order').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;"><input type="button" value="▼ 注文書レイアウト" /></a>
</div>
<!--// 折り畳み展開ポインタ 注文書 -->

<!-- 折り畳まれ部分 注文書レイアウト -->
<div id="order" style="display:none;clear:both;">
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
<input type="text" name="year" size = "1" maxlength = "4" value="<?php echo date('Y', strtotime($order['t_date']));?>" readonly="readonly" /></td>
<td>年</td>
<td><input type="text" name="month" size = "2" maxlength = "2" class = "two" value="<?php  echo date('m', strtotime($order['t_date']));?>" readonly="readonly" /></td>
<td>月</td>
<td><input type="text" name="date" size = "2" maxlength = "2" class = "two" value="<?php  echo date('d', strtotime($order['t_date']));?>" readonly="readonly" /></td>
<td>日</td>
<td class="xl69" />
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>注文内容</td>
<td class="xl71">　</td>
<td class="xl71">　</td>
<td class="xl71" colspan="3" style='mso-ignore:colspan'>
<input type="radio" name="t_naiyou" value="0" <?php echo $estimate?> />見積もり</td>
<?php
$c = 0;
while($c < 4){
	echo "<td class=\"xl71\">　</td>";
	$c++;
}
?>
<td class="xl71" colspan="2" style='mso-ignore:colspan'>
<input type="radio" name="t_naiyou" value="1" <?php echo $ordering?> />発注</td>
<?php
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
<input type="text" name="school_name" maxlength="25" class = "one" value = "<?php echo $order['school_name']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>部署名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="name" maxlength="15" class = "one" value = "<?php echo $order['t_busho']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr  style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>ご担当者名</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_name" maxlength="15" class = "one" value = "<?php echo $order['t_tantousha']?>" readonly="readonly" /></td>
<td colspan="4"class="xl89" style='border-right:.5pt solid black;border-left:none'>お電話番号</td>
<td colspan="6" class="xl113" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="user_tel" maxlength="11" class = "one" value = "<?php echo $order['t_tel']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl114" style='border-right:.5pt solid black'>品名</td>
<td colspan="6">
<input type="text" name="product_name" class = "one" value = "<?php echo $order['hin_janru']?>" readonly="readonly" /></td>
<td colspan="3" class="xl114" style='border-right:.5pt solid black'>備考</td>
<td colspan="7" class="xl114" style='border-right:.5pt solid black;border-bottom:border-left:none'>
<textarea name="t_bikou" rows="2" style="wrap:soft; maxlength:255;" class = "one" readonly="readonly"><?php echo $order['t_bikou']?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>利用する学部系</td>
<td colspan="6" class="xl89" style='border-left:none'>
<input type="text" name="gakubu_name" maxlength="20" class = "one" value = "<?php echo $order['gakubu_name']?>" readonly="readonly" /></td>
<td colspan="3" class="xl111" style='border-right:.5pt solid black'>利用目的</td>
<td colspan="7" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<textarea name="t_mokuteki" rows="2" style="wrap:soft; maxlength:255;" class = "one" readonly="readonly"><?php echo $order['t_mokuteki']?></textarea></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" rowspan="2" class="xl94" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>仕様</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>サイズ</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_size" maxlength="2" class = "three" value = "<?php echo $order['t_size']?>" readonly="readonly" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_page" maxlength="3" class = "three" value = "<?php echo $order['t_page']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_color" maxlength="3" class = "three" value = "<?php echo $order['t_color']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="3" class="xl90">
<input type="radio" name="t_men" value="片面" <?php echo $other?> />片面</td>
<td colspan="3" class="xl90" style='border-right:.5pt solid black'>
<input type="radio" name="t_men" value="両面" <?php echo $both?> />両面</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kami" maxlength="10" class = "one" value = "<?php echo $order['t_kami']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_orikata" maxlength="10" class = "one" value = "<?php echo $order['t_orikata']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>部数</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_busu" maxlength="7" class = "five" value = "<?php echo $order['t_busu']?>" readonly="readonly" />部</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black;border-left:none'>納品希望日</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_kiboubi" maxlength="20" class = "one" value = "<?php echo $order['t_kiboubi']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望納品場所</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_basho" maxlength="60" class = "one" value = "<?php echo $order['t_basho']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>
<tr>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>希望金額</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_money" maxlength="8" class = "six money" value = "<?php echo $order['t_money']?>" readonly="readonly" />円</td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>仕様の要望</td>
<td colspan="16" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_youbou" class = "one" value = "<?php echo $order['t_youbou']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl108" style='border-right:.5pt solid black'>昨年制作実績の有無</td>
<td class="xl73" style='border-top:none;border-left:none'>　</td>
<td class="xl71" style='border-top:none'>　</td>
<td colspan="5" class="xl90">
<input type="radio" name="sakunen_jisseki" value="true" <?php echo $track_record_Y?> />あり</td>
<td class="xl71" style='border-top:none'>　</td>
<td colspan="5" class="xl90">
<input type="radio" name="sakunen_jisseki" value="false" <?php echo $track_record_N?> />なし</td>
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
<input type="text" name="t_sakunen_money" maxlength="8" class = "six money" value = "<?php echo $order['t_sakunen_hiyou']?>" readonly="readonly" />円</td>
<td rowspan="2" class="xl94" style='border-bottom:.5pt solid black'>　</td>
<td colspan="3" rowspan="2" class="xl95" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="radio" name="zei_hantei" value="komi" <?php echo $tax_included?> />(税込み)</td>
<td rowspan="2" class="xl95" style='border-bottom:.5pt solid black'>　</td>
<td colspan="3" rowspan="2" class="xl95" style='border-right:.5pt solid black; border-bottom:.5pt solid black'>
<input type="radio" name="zei_hantei" value="nuki" <?php echo $tax_excluded?> />(税抜き)</td>
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
<input type="text" name="t_sakunen_busu" class = "four" value = "<?php echo $order['t_sakunen_busu']?>" readonly="readonly" />部</td>
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
<input type="text" name="t_sakunen_size" maxlength="2" class = "three" value = "<?php echo $order['t_sakunen_size']?>" readonly="readonly" /></td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>ページ数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_page" maxlength="3" class = "three" value = "<?php echo $order['t_sakunen_page']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>色数</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_color" maxlength="3" class = "three" value = "<?php echo $order['t_sakunen_color']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="3" class="xl90">
<input type="radio" name="sakunen_men" value="片面" <?php echo $last_other?> />片面</td>
<td colspan="3" class="xl90" style='border-right:.5pt solid black'>
<input type="radio" name="sakunen_men" value="両面" <?php echo $last_both?> />両面</td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>紙</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_kami" maxlength="10" class = "one" value = "<?php echo $order['t_sakunen_kami']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left: none'>折り方</td>
<td colspan="3" class="xl89" style='border-right:.5pt solid black;border-left: none'>
<input type="text" name="t_sakunen_orikata" maxlength="10" class = "one" value = "<?php echo $order['t_sakunen_orikata']?>" readonly="readonly" /></td>
<td class="xl69">　</td>
</tr>

<tr style='mso-height-source:userset;height:27.0pt'>
<td height="36px" style='height:27.0pt' />
<td class="xl68">　</td>
<td colspan="4" class="xl89" style='border-right:.5pt solid black'>昨年発注先</td>
<td colspan="8" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_basho" maxlength = "60" class = "one" value = "<?php echo $order['t_sakunen_basho']?>" readonly="readonly" /></td>
<td colspan="2" class="xl89" style='border-right:.5pt solid black;border-left:none'>担当者</td>
<td colspan="6" class="xl89" style='border-right:.5pt solid black;border-left:none'>
<input type="text" name="t_sakunen_tantou" maxlength = "15" class = "one" value = "<?php echo $order['t_sakunen_tantou']?>" readonly="readonly" /></td>
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
<input type="checkbox" name="saisyu" value="1" readonly="readonly" /></td>
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
<input type="checkbox" name="yakusyoku" value="2" readonly="readonly" /></td>
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
<input type="checkbox" name="tanto1" value="3" readonly="readonly" /></td>
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
<input type="checkbox" name="tanto2" value="4" readonly="readonly" /></td>
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
</div>
<!--// 折り畳まれ部分 注文書レイアウト -->

<!-- 折り畳み展開ポインタ 相みつ会社 -->
<div onclick="obj=document.getElementById('company').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;"><input type="button" value="▼ 相みつ会社一覧" /></a>
</div>
<!--// 折り畳み展開ポインタ 相みつ会社 -->

<!-- 折り畳まれ部分 相みつ会社一覧 -->
<div id="company" style="display:none;clear:both;">
<form name="com" action="Competitive_quotes_list.php" method="post">
<?php //注文書idをform送信
echo "<input type='hidden' name='tm_id' value=". $id .">";
?>
<table id="list" class="type07" align="center">
<thead>
	<tr>
		<th>check</th>
		<th>制作会社</th>
	</tr>
</thead>
<tbody>
	<?php
		while($company = $result_sql2->fetch(PDO::FETCH_ASSOC)){
			echo '<tr><th><input type="checkbox" name="check1[]" class="check" value="'.$company['id'].'" /></th>';
			echo '<td>'.$company['name'].'</td></tr>';
		}
		$null = $count % 10;
		while($null < 10){
			echo '<tr><th>　</th><td>　</td></tr>';
			$null++;
		}
	?>
</tbody>
</table>
<div align="left" style="margin-left:200px;" >
	<input type="button" onclick="prev()" value="戻る" />
	<input type="button" onclick="next()" value="次へ" />
	<span id="page"></span>
	<font>/</font>
	<span id="total"></span>
	<font>ページ</font>
	<input type="submit" name="decision" style="margin-left:200px;" />
</div>
</form>
</div>
<!--// 折り畳まれ部分 相みつ会社一覧 -->
<div>
<input type="button" name="can" value="戻る" onclick="location.href='Select.php'" />
</div>
</body>
</html>