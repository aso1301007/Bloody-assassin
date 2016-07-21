<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">
<head>
</head>
<body>
<?php

$MAIL=$_POST['MAIL'];
$PASS=$_POST['PASS'];


//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
require "../DB.php";
session_start();


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


//メールアドレスとパスワードで認証
if($MAIL == $D_mail){
	if($PASS == $D_pass){
		$_SESSION['user_id']=$D_id;
		require '../user_name.php';
		switch ($D_kubun){
			case "ACS":
				header('location: ../acs/ACS_Home.php');
				exit();

			case "注文者":
				header('location: ../Shcool/School_Home.php');
				exit();

			case "管理者":
				header('location:../SAdmin/SAdmin_Home.php');
				exit();
		}
	}else header('location:Logon_failure.html');
		exit();
}else header('location:Logon_failure.html');
	exit();

?>
</body>
</html>