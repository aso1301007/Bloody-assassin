<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=../../css.css>



<title>ACS_進捗状況</title>


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
<script>
function check(){
	if(window.confirm('進捗を更新してよろしいですか？')){ // 確認ダイアログを表示
		return true; // 「OK」時は送信を実行
	}else{ // 「キャンセル」時の処理
		window.alert('キャンセルされました'); // 警告ダイアログを表示
	return false; // 送信を中止
	}
}


</script>


</head>

<body>

<?php

//session_start();

require '../../DB.php';
include '../acs_header.php';

echo "<div id='title'><a>進捗状況</a></div>";
//-----前ページで指定された注文書のID受け取り-----

$_SESSION['sintyoku_tm_id']=$_GET['select_id'];
$tm_id=$_SESSION['sintyoku_tm_id'];
//---------------------------------------


//-----------日付と注文書名の取得---------------------
$sql1 = "SELECT * FROM tyuumon,hinmei where tm_id = ? and tyuumon.t_hin_name= hinmei.hin_id";
$data1 = $pdo->prepare($sql1);
$data1 ->execute(array($tm_id));//要らないかも？


while($row1 = $data1 -> fetch(PDO::FETCH_ASSOC)){
		$t_date = $row1['t_date'];
		$t_naiyou = $row1['t_naiyou'];
		$hin_janru = $row1['hin_janru'];
}
//------------------------------------------------------


//ACS側は承認表示は必要なし




//--------進捗を注文書マスター表から取得-------------------
$sql = "SELECT * FROM tyuumon_master where tm_id = ?";
$data = $pdo->prepare($sql);
$data ->execute(array($tm_id));//要らないかも？

//SELECTでとってきた値を格納
while($row = $data -> fetch(PDO::FETCH_ASSOC)){
		$hattyu = $row['tm_hattyu_flg'];
		$kakunin = $row['tm_kakunin_flg'];
		$mitumori_now = $row['tm_mitumorityuu_flg'];
		$mitumori_fin = $row['tm_mitumorizumi_flg'];
		$nouhin = $row['tm_nouhin_flg'];
		$touroku = $row['tm_touroku_flg'];
		$houkoku = $row['tm_houkokusho_flg'];
}//-------------------------------------------------------


switch($t_naiyou){
case '0':
	$naiyou = "見積もり";
	break;
case '1':
	$naiyou = "発注";
	break;
}

?>


<div id="syorui">
<?php
//注文書名を出力
echo Date('Y年m月d日', strtotime($t_date))."  ・  " .$naiyou."  ・  " .$hin_janru;
echo "</div>";

echo "<div id='img1'>";

//進捗を判定して画像貼り付け
switch ($hattyu){
	case 0: echo '<img src="img/hattyuu2.jpg"/>';
		break;
	case 1: echo '<img src="img/hattyuu.jpg"/>';
		break;
}

switch ($kakunin){
	case 0: echo '<img src="img/kakunin2.jpg"/>';
		break;
	case 1: echo '<img src="img/kakunin.jpg"/>';
		break;
}

switch ($mitumori_now){
	case 0: echo '<img src="img/mitumori_now2.jpg"/>';
		break;
	case 1: echo '<img src="img/mitumori_now.jpg"/>';
		break;
}

switch ($mitumori_fin){
	case 0: echo '<img src="img/mitumori_fin2.jpg"/>';
		break;
	case 1: echo '<img src="img/mitumori_fin.jpg"/>';
		break;
}
?>
</div>
<div id="kakunin">
	<table>
		<tr><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="取消" name="delete"/>
				<input type="hidden" name="flg_name" value="tm_kakunin_flg">
				<input type="hidden" name="what" value="0">
		</form>
			</td><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="OK" name="ok"/>
				<input type="hidden" name="flg_name" value="tm_kakunin_flg">
				<input type="hidden" name="what" value="1">
		</form>
			</td></tr>
	</table>
</div>


<div id="mitumori_now">
	<table>
		<tr><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="取消" name="delete"/>
				<input type="hidden" name="flg_name" value="tm_mitumorityuu_flg">
				<input type="hidden" name="what" value="0">
		</form>
			</td><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="OK" name="ok"/>
				<input type="hidden" name="flg_name" value="tm_mitumorityuu_flg">
				<input type="hidden" name="what" value="1">
		</form>
			</td></tr>
	</table>
</div>


<div id="mitumori_fin">
	<table>
		<tr><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="取消" name="delete"/>
				<input type="hidden" name="flg_name" value="tm_mitumorizumi_flg">
				<input type="hidden" name="what" value="0">
		</form>
			</td><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="OK" name="ok"/>
				<input type="hidden" name="flg_name" value="tm_mitumorizumi_flg">
				<input type="hidden" name="what" value="1">
		</form>
			</td></tr>
	</table>
</div>

<div id="img2">
<?php
switch ($nouhin){
	case 0: echo '<img src="img/nouhin2.jpg"/>';
		break;
	case 1: echo '<img src="img/nouhin.jpg"/>';
		break;
}

switch ($touroku){
	case 0: echo '<img src="img/touroku2.jpg"/>';
		break;
	case 1: echo '<img src="img/touroku.jpg"/>';
		break;
}

switch ($houkoku){
	case 0: echo '<img src="img/houkoku2.jpg"/>';
		break;
	case 1: echo '<img src="img/houkoku.jpg"/>';
		break;
}
?>

</div>
</body>
</html>