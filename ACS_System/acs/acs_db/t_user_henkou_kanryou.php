<?php session_start();
require_once "DB.php";

if(isset($_SESSION["user_id"])){
	$user_id=$_SESSION["user_id"];
	echo $user_id;
}
$name=$_POST["user_name"];
$mail=$_POST["user_mail"];
$pass=$_POST["user_pass"];
$tel=$_POST["user_tel"];
$busho=$_POST["busho"];
echo $name,$mail,$pass,$tel,$busho;
try {
	$stmt = $pdo -> prepare("UPDATE user SET user_name =:name ,user_mail =:mail ,user_pass =:pass ,user_tel =:tel WHERE :user_id = user_id");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
	$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
	$stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
	}catch (PDOException $e) {
		print "Exception2";
		print $e->getMessage();
	}
	try {
		$stmt = $pdo -> prepare("UPDATE tyuumonsha SET tyuumonsha_busho_name =:busho WHERE user_id = :user_id");
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$stmt->bindParam(':busho', $busho, PDO::PARAM_STR);
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
<title>注文者情報変更</title>
</head>
<body>

  <p>情報の変更が完了しました</p>
  <p><a href="../">メインメニューに戻る</a></p>
</body>
</html>
