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
require_once "DB.php";



$sql = "SELECT * FROM user WHERE user_mail = '$MAIL'";
$data = $pdo->prepare($sql);
$data->execute();//要らないかも？


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
		$_session['user_id']=$D_id;
		switch ($D_kubun){
			case "ACS":
				header('location:A_top.html');
				exit();

			case "注文者":
				header('location:S_top.html');
				exit();

			case "管理者":
				header('location:SAdmin_top.html');
				exit();
		}
	}else header('location:Logon_failure.html');
		exit();
}else header('location:Logon_failure.html');
	exit();

?>
</body>
</html>