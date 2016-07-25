<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=../../css.css>


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
		if(window.confirm('納品の進捗を更新してよろしいですか？')){ // 確認ダイアログを表示
			return true; // 「OK」時は送信を実行
		}else{ // 「キャンセル」時の処理
			window.alert('キャンセルされました'); // 警告ダイアログを表示
		return false; // 送信を中止
		}
	}
</script>
<title>学校_進捗状況</title>
</head>


<body>
<?php
//session_start();
require '../../DB.php';
include '../School_header.php';

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


//-----------------承認進捗を取得----------------
//その注文書承認の最新状態を示すidを取得
$approval = "SELECT S.sm_id,S.s_id AS s_id FROM shounin_master SM, shounin S
			WHERE SM.sm_id = S.sm_id
			AND SM.tm_id =?";
$app = $pdo->prepare($approval);
$app ->execute(array($tm_id));//要らないかも？
while ($app1 = $app -> fetch(PDO::FETCH_ASSOC)){
//	$s_id=$app1['s_id'];
	$sm_id=$app1['sm_id'];
}



//承認情報の取得
$approval_info="SELECT * FROM shounin S,shounin_master SM,user U
				WHERE S.sm_id=SM.sm_id AND S.sm_id=:sm_id
				AND U.user_id=SM.sm_sinseisha_id";
$app_info = $pdo->prepare($approval_info);
$app_info->bindParam(':sm_id', $sm_id, PDO::PARAM_STR);

$app_info ->execute();

//名前取得
$name="SELECT user_name AS 'saki_name'
		FROM shounin S, user U
		WHERE S.s_saki = U.user_id";
//			AND S.s_id =:s_id";
$name_info = $pdo->prepare($name);
$name_info->bindParam(':s_id', $s_id, PDO::PARAM_STR);
$name_info ->execute();







// $name="SELECT moto.user_name AS 'moto_name', saki.user_name AS 'saki_name'
// 		FROM shounin S, user moto, user saki
// 		WHERE S.s_saki = saki.user_id
// 			AND S.s_moto = moto.user_id";
// //			AND S.s_id =:s_id";
// $name_info = $pdo->prepare($name);

// $name_info ->execute();
//-------------------------------------------------------------------------




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
?>







<div id="syorui">
<?php

//注文書名を出力
echo Date('Y年m月d日', strtotime($t_date))."  ・  " .$t_naiyou."  ・  " .$hin_janru;

echo "</div><div id='shounin'>";
echo "<div style='text-align:center;'>承認の進捗状況</div><br/>";
while($app_info1 = $app_info -> fetch(PDO::FETCH_ASSOC)){
//	$moto_id=$app_info1['s_moto'];
	$saki_id=$app_info1['s_saki'];
	$shounin_flg=$app_info1['s_shounin_flg'];
	$sasimodosi=$app_info1['s_sasimodosi_flg'];
	$sinseisha_name=$app_info1['user_name'];  //申請者の名前
	$sakujo_flg=$app_info1['sm_sakujo_flg'];
	$hizuke=$app_info1['s_date'];
//	$s_id=$app_info1['s_id'];

	//名前取得
	$name="SELECT user_name AS 'saki_name'
		FROM shounin S, user U
		WHERE S.s_saki = U.user_id
			AND U.user_id =:saki_id";
	$name_info = $pdo->prepare($name);
	$name_info->bindParam(':saki_id', $saki_id, PDO::PARAM_STR);
	$name_info ->execute();

//名前取得
	while($name_info1 = $name_info -> fetch(PDO::FETCH_ASSOC)){
		$saki_name=$name_info1['saki_name'];
	}

//条件によって表示切替
echo "<div style='margin-left:1em;'>";
	if($shounin_flg==0){
		if($sasimodosi==0){ echo $hizuke,"　　",$saki_name,"さんの承認待ちです。";
	}else{ echo $hizuke,"　　",$saki_name,"さんから差し戻しされました。";
	}
}else{
	echo $hizuke,"　　",$saki_name,"さんが承認しました。";
}

if($sakujo_flg==1){
	echo "削除されました";
}
echo "<br/></div>";
}
echo "</div><div id='img1'>";

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
<?php


echo <<<EOT
<div id="nouhin_button">
	<table>
		<tr><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="取消" name="delete">
				<input type="hidden" name="flg_name" value="tm_nouhin_flg">
				<input type="hidden" name="what" value="0">
			</form>
			</td><td>
			<form action="sintyoku_update.php" method="get" onSubmit="return check()">
				<input type="submit" value="OK" name="ok"/>
				<input type="hidden" name="flg_name" value="tm_nouhin_flg">
				<input type="hidden" name="what" value="1">
		</form>
			</td></tr>
	</table>
</div>
EOT;

?>
</body>
</html>