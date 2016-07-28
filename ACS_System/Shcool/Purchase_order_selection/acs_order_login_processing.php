<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head>
</head>
<body>
<?php

$MAIL=$_POST['MAIL'];
$PASS=$_POST['PASS'];
$id=$_POST['t_id'];


//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
require "../../DB.php";


$sql = "SELECT * FROM user WHERE user_mail = ?";
$data = $pdo->prepare($sql);
$data->execute(array($MAIL));//要らないかも？


//----繰り返しでSERECTでとってきた値を表示----------
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$D_id = $row['user_id'];
	$D_mail=$row['user_mail'];
	$D_pass=$row['user_pass'];
	$D_kubun=$row['user_kubun'];
}
$true_url = "Order_Form_view.php?id=".$id;
$false_url = "acs_order_login.php?id=".$id;
//メールアドレスとパスワードで認証
if($MAIL == $D_mail){
	if($PASS == $D_pass){
		echo $D_kubun;
		if($D_kubun === 'ACS社員'){
			$_SESSION['user_id']=$D_id;
			require '../../user_name.php';
				header('location: '. $true_url);
				exit();
		}
		else{
			header('location: '. $false_url);
			exit();
		}
	}
	else{
		echo "5";
		header('location: '. $false_url);
	}
		exit();
}
else header('location: '. $false_url);
	exit();

?>
</body>
</html>