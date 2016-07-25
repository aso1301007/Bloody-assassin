<?php
require_once "DB.php";

if(isset($_POST["id"])){
	$user_id=$_POST["id"];
	echo $user_id;
}
try {
	$stmt = $pdo -> prepare("UPDATE user SET user_yuukou_flg = 0 WHERE :user_id = user_id");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
	}catch (PDOException $e) {
		print "Exception2";
		print $e->getMessage();
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>注文者削除</title>
</head>
<body>

  <p>ユーザー削除が完了しました</p>
  <p><a href="../">メインメニューに戻る</a></p>
</body>
</html>
