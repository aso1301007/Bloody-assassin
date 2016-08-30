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
$user_name = $_POST["user_name"];
$s_number = $_POST["s_number"];
$seisaku_name = $_POST["seisaku_name"];
$n_year = $_POST["n_year"];
$n_month = $_POST["n_month"];
$n_date = $_POST["n_date"];
$n_date3 = "$n_year"."-"."$n_month"."-"."$n_date";
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
?>
<?php
require_once "../../DB.php";
?>
<div id="title">報告書保存</div>

<?php
$stmt = $pdo -> prepare("INSERT INTO houkoku
		(tm_id,h_date,user_id,h_seisaku_id,h_nouki,h_pbm_position,h_seikou,h_sippai,h_comment,h_hin_janru,h_busu,h_size,h_page,h_color,h_men,h_kami,h_orikata,h_hiyou)
		VALUES ('1','$date3','1','1','$n_date3','$pbm_p','$s_p','$f_p','$comment','$hin_janru','$h_busu','$h_size','$h_page','$h_color','$h_men','$h_kami','$h_orikata','$h_money')");
if (!$stmt) {
	exit('データを登録できませんでした。');
}

$stmt->execute();//INSERT文実行
?>
<body>
<?php
include("../School_header.php")
?>
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
<input type="submit" value="戻る" class ="eight">
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