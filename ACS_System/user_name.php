<?php

//DB接続を行うphpを読み込む
require_once "DB.php";
session_start();

$user_id=$_SESSION['user_id'];

//-----------ユーザー名を取り出す処理-----------------

$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$data = $pdo->prepare($sql);
$data->execute();//要らないかも？

//---ユーザー名をセッションに格納----------
while($row = $data ->fetch(PDO::FETCH_ASSOC)){
	$_SESSION['user_name']=$row['user_name'];
}

?>
