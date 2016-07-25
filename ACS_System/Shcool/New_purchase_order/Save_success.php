<!DOCTYPE html>
<html>
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$year = $_POST["year"];
$month = $_POST["month"];
$date = $_POST["date"];
$date3 = "$year"."-"."$month"."-"."$date";
$t_naiyou = $_POST["t_naiyou"];
$school_name = $_POST["school_name"];
$busho = $_POST["busho"];
$user_name = $_POST["user_name"];
$user_tel = $_POST["user_tel"];
$hin_janru = $_POST["hin_janru"];
$t_bikou = $_POST["t_bikou"];
$gakubu_id = $_POST["gakubu_id"];
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
?>
<?php
require_once "../../DB.php";
?>

<?php

$sql = "SELECT MAX(tm_seisakubutu) as ts FROM tyuumon_master";
$data = $pdo->prepare($sql);
$data->execute();
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$tm_se = $row['ts']+1;
}

$stmt = $pdo -> prepare("INSERT INTO tyuumon_master
		(tm_id,user_id,tm_seisakubutu,seisaku_id,tm_hattyu_flg,tm_kakunin_flg,tm_mitumorityuu_flg,tm_mitumorizumi_flg,tm_nouhin_flg,tm_touroku_flg,tm_houkokusho_flg,tm_sakujo_flg)
		VALUES ('null','1','$tm_se','null','0','0','0','0','0','0','0','0')");
if (!$stmt) {
	exit('データを登録できませんでした。');
}

/*
concat('$year','')
*/
$stmt->execute();//INSERT文実行

$sql = "SELECT MAX(tm_id) as mx FROM tyuumon_master";
$data = $pdo->prepare($sql);
$data->execute();
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$tm_id = $row['mx'];
}
$stmt2 = $pdo -> prepare("INSERT INTO tyuumon
		(tm_id,t_date,t_naiyou,school_id,t_busho,t_gakubu,t_tantousha,t_tel,t_hin_name,t_bikou,t_mokuteki,t_size,t_page,t_color,t_men,
		t_kami,t_orikata,t_busu,t_kiboubi,t_basho,t_money,t_youbou,t_sakunen_tm_id,t_sakunen_jisseki,t_sakunen_hiyou,t_zei_hantei,t_sakunen_busu,t_sakunen_size,t_sakunen_page,t_sakunen_color,
		t_sakunen_men,t_sakunen_kami,t_sakunen_orikata,t_sakunen_basho,t_sakunen_tantou)
		VALUES ('$tm_id','$date3','$t_naiyou','$school_name','$busho','$gakubu_id','$user_name','$user_tel','$hin_janru','$t_bikou',
		'$t_mokuteki','$t_size','$t_page','$t_color','$t_men','$t_kami','$t_orikata','$t_busu','$t_kiboubi','$t_basho',
		'$t_money','$t_youbou','null','$t_sakunen_jisseki','$t_sakunen_money','$t_zei_hantei','$t_sakunen_busu','$t_sakunen_size','$t_sakunen_page',
		'$t_sakunen_color','$t_sakunen_men','$t_sakunen_kami','$t_sakunen_orikata','$t_sakunen_basho','$t_sakunen_tantou')");
if (!$stmt2) {
	exit('データを登録できませんでした。');
}

$stmt2->execute();//INSERT文実行
?>

<body>
<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name"><?php echo $user_name;?> さん</div>
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
					<li><a href="Entry.php">新規注文書</a></li>
					<li><a href="#">注文書選択</a></li>
				</ul>
			</li>
			<li>書類
				<ul style="list-style:none;">
					<li><a href="../Documents_Browsing/Image_selection.php">書類閲覧</a></li>
					<li><a href="#">製作物画像登録</a></li>
				</ul>
			</li>
			<li>進捗管理
				<ul style="list-style:none;">
					<li><a href="../progress_management/Purchase_order_selection.php">進捗管理</a></li>
				</ul>
			</li>
		</ul>
</div>


<div id="main">
<div id = "border"></div>
<p></p>
<h1><center>注文書の保存が完了しました。</center></h1>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<form action="../School_Home.php" method="POST" name = "form1">
<input type="submit" value="戻る" class ="nine">
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
</body>
</html>