<?php session_start();
require_once "DB.php";

if(isset($_POST["id"])){
	$user_id=$_POST["id"];
	$_SESSION["user_id"] = $user_id;
}
try {
	$stmt = $pdo -> prepare("SELECT * FROM user WHERE :user_id = user_id");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
}catch (PDOException $e) {
	print "Exception2";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$name =$row['user_name'];
	$mail =$row['user_mail'];
	$pass =$row['user_pass'];
	$tel =$row['user_tel'];
}
try {
	$stmt = $pdo -> prepare("SELECT * FROM tyuumonsha WHERE :user_id = user_id");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
}catch (PDOException $e) {
	print "Exception2";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$busho =$row['tyuumonsha_busho_name'];
}
echo $name,$mail,$pass,$tel,$busho;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>新規会員登録</title>
</head>
<body>
  <p>全項目をご記入ください</p>
  <form action="t_user_henkou_kanryou.php" method="post" enctype="multipart/form-data">
  <dl>
  <dt>氏名</dt>
    <dd>
      <input type="text" name="user_name" value="<?php echo $name?>" size="15" maxlength="15">
    </dd>
    <dt>部署</dt>
    <dd>
      <input type="text" name="busho" value="<?php echo $busho?>" size="15" maxlength="20">
    </dd>
    <dt>メールアドレス</dt>
    <dd>
      <input type="text" name="user_mail" value="<?php echo $mail?>" size="35" maxlength="255">
    </dd>
    <dt>パスワード</dt>
    <dd>
      <input type="password" name="user_pass"value="<?php echo $pass?>"  size="10" maxlength="20">
    </dd>
    <dt>電話番号</dt>
    <dd>
      <input type="text" name="user_tel" value="<?php echo $tel?>" size="10" maxlength="11">
    </dd>
  </dl>
  <div><a href="t_user_henkou_sentaku.php?action=rewrite">&laquo;&nbsp;戻る</a>
</div>
  <div><input type="submit" value="情報を変更"></div>
  </form>
</body>
</html>
