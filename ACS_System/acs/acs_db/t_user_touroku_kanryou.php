<?php session_start();
require_once "DB.php";

$name =$_SESSION["name"];
$mail =$_SESSION["mail"];
$pass =$_SESSION["pass"];
$tel =$_SESSION["tel"];
$kubun = "注文者";

$school =$_SESSION["school"];
$busho =$_SESSION["busho"];

try {
$stmt = $pdo -> prepare("INSERT INTO user (user_mail,user_pass,user_name,user_kubun,user_tel,user_yuukou_flg,user_admin_flg)
		VALUES (:mail,:pass,:name,:kubun,:tel,:yuukou,:admin)");
$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);//変数を入力するときはこっち:bindParam
$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':kubun', $kubun, PDO::PARAM_STR);
$stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':yuukou', 1, PDO::PARAM_INT);//変数ではなく値を直接入力する場合はこっち:bindValue
$stmt->bindValue(':admin', 0, PDO::PARAM_INT);
$stmt->execute();//SQL文実行
}catch (PDOException $e) {
    print "Exception2";
    print $e->getMessage();
}
try {
	$stmt = $pdo -> prepare("SELECT * FROM user WHERE user_mail=:mail ");
	$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
}catch (PDOException $e) {
	print "Exception2";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$user_id =$row['user_id'];
}
try {
	$stmt = $pdo -> prepare("INSERT INTO tyuumonsha(user_id,school_id,tyuumonsha_busho_name)
			VALUES (:user_id,:school_id,:busho_name) ");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->bindParam(':school_id', $school, PDO::PARAM_STR);
	$stmt->bindParam(':busho_name', $busho, PDO::PARAM_STR);
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
<title>新規会員登録</title>
</head>
<body>

  <p>ユーザー登録が完了しました</p>
  <p><a href="../">メインメニューに戻る</a></p>
</body>
</html>
