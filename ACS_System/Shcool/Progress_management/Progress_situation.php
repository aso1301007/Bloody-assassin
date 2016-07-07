<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head></head>
<SCRIPT type="text/javascript"/>
<body>
<?php

require_once 'DB.php';


//全ページ共通ヘッダーを貼り付け


//$tyuumon_id=$_SESSION['$tyuumon_id'];
$tyuumon_id="1";

echo $tyuumon_id;


//---------進捗を注文書マスター表から取得------------
$sql = "SELECT * FROM tyuumon_master where tm_id ='.$tyuumon_id'";
$data = $pdo->prepare($sql);
$data ->execute();//要らないかも？

while($row = $data -> fetch(PDO::FETCH_ASSOC)){
		$hattyu = $row['tm_hattyu_flg'];
		$kakunin = $row['tm_kakunin_flg'];
		$mitumori_now = $row['tm_mitumorityuu_flg'];
		$mitumori_fin = $row['tm_mitumorizumi_flg'];
		$nouhin = $row['tm_nouhin_flg'];
		$touroku = $row['tm_touroku_flg'];
		$houkoku = $row['tm_houkokusho_flg'];
}
//-------------------------------------------------------




//--------注文書名を取得------------
$sql2= "SELECT * FROM tyuumon inner join hinmei on where tyuumon.hin_id=hinmei.hin_id and tm_id='.$tyuumon_id'";
$data2 = $pdo->prepare($sql2);
$data2 ->execute();//要らないかも？

while($row = $data2 -> fetch(PDO::FETCH_ASSOC)){
	$date = $row['tm_date'];
	$naiyou=$row['t_naiyou'];
//	$hin_id=$row['hin_id'];
	$hin_janru = $row['hin_janru'];
}
//--------------------------------


/*品名取得
$sql3 = "SELECT * FROM hinmei where hin_id='.$hin_id'";
$data3 = $pdo->prepare($sql3);
$data3 ->execute();//要らないかも？

//----繰り返しでSERECTでとってきた値を表示----------
while($row = $data3 -> fetch(PDO::FETCH_ASSOC)){
	$hin_janru = $row['hin_janru'];
}
*/

//------とってきた日付・注文書名を出力---------------
echo $date."　・　" .$naiyou."　・　" .$hin_janru;

//--------------------------------------------------
?>


<!-------------進捗可視化------------------!>

<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head>
<style type="text/javascript">


/*==== 本文のブロック ====*/
#img{
width: auto;
margin: 8px;
padding: 4px;
}
</style>
</head>
<body>

<!--
function showimg1(){
	document.area1.src = "画像1のURL";
	document.getElementById("area2").href = "リンク先URL";
}

function showimg2(){
	document.area1.src = "画像2のURL";
	document.getElementById("area2").href = "リンク先URL";
}

function showimg3(){
	document.area1.src = "画像3のURL";
	document.getElementById("area2").href = "リンク先URL";
}
--!>
</body>
</SCRIPT>

<a href="最初のリンク先URL" id="area2" >
<img src="最初に表示する画像のURL" name="area1">
</a>

<input type="button" onclick="showimg1()" value="画像1">
<input type="button" onclick="showimg2()" value="画像2">

</html>

