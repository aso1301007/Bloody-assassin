<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=../../css.css>



<title>進捗状況</title>


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

session_start();

require_once '../../DB.php';



/*//-----前ページで指定された注文書のID受け取り-----
*/
$_SESSION['sintyoku_tm_id']=$_POST['sintyoku_tm_id'];
$tm_id=$_SESSION['sintyoku_tm_id'];
//---------------------------------------


//------ユーザ名取得---------
$user_name=$_SESSION['user_name'];
//$user_name="高塚";

//-----------------------------


//-----------日付と注文書名の取得---------------------
$sql1 = "SELECT * FROM tyuumon,hinmei where tm_id = ? and tyuumon.hin_id = hinmei.hin_id";
$data1 = $pdo->prepare($sql1);
$data1 ->execute(array($tm_id));//要らないかも？
//print $sql1;


//SELECTでとってきた値を格納
while($row1 = $data1 -> fetch(PDO::FETCH_ASSOC)){
//	print "a";
//	print_r($row1);
		$t_date = $row1['t_date'];
		$t_naiyou = $row1['t_naiyou'];
		$hin_janru = $row1['hin_janru'];
//		$hin_id=$row1['hin_id'];
}



 //進捗を注文書マスター表から取得
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
}




echo <<<EOT

<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name">$user_name さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="../../Login/Logout.php">ログアウト</a></li>
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
				<li><a href="#">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="#">進捗管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<div id="main">
<div id="border"></div>

<div id="title"><a>進捗状況</a></div>


<div id="syorui">
EOT;
//注文書名を出力
echo $t_date."  ・  " .$t_naiyou."  ・  " .$hin_janru;

echo <<<EOT
</div>


<div id="img1">
EOT;
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


echo <<<EOT

</div>
<div id="img2">
EOT;
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




<!-- 進捗状況を変更するボタン -->
<div id="nouhin_button">
	<table>
		<tr><td>
			<form action="../../sintyoku_update/sintyoku_delete.php" method="post">
					<input type="submit" value="取消">
					<input type="hidden" name="flg_name" value="tm_nouhin_flg">
			</form>
			</td><td>
			<form action="../../sintyoku_update/sintyoku_ok.php" method="post">
					<input type="submit" value="OK">
					<input type="hidden" name="flg_name" value="tm_nouhin_flg">
			</form>
			</td></tr>
	</table>
</div>
</body>
</html>