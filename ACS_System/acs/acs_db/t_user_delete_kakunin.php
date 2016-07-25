<?php session_start();
require_once "DB.php";
if(isset($_POST["id"])){
	$user_id=$_POST["id"];
	echo $user_id;
}
if(isset($_SESSION["school"])){
	$school=$_SESSION["school"];
	echo $school;
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
	$user_name =$row['user_name'];
	$user_mail =$row['user_mail'];
	$user_tel =$row['user_tel'];
}
try {
	$stmt = $pdo -> prepare("SELECT * FROM school WHERE :school_id = :school_id");
	$stmt->bindParam(':school_id', $school, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
}catch (PDOException $e) {
	print "Exception2";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$school_name =$row['school_name'];
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>削除確認</title>
</head>
<body>
  <form action="t_user_delete_kanryou.php" method="post">
<dl>
<dt>氏名</dt>
  <dd>
  <?php
  echo $user_name;
  ?>
  </dd>
  <dt>学校</dt>
  <dd>
  <?php
  	echo $school_name;
  ?>
  </dd>
  <dt>部署</dt>
  <dd>
  <?php
  echo $busho;
  ?>
  </dd>
  <dt>メールアドレス</dt>
  <dd>
<?php
  echo $user_mail;
  ?>
  </dd>
  <dt>電話番号</dt>
  <dd>
 <?php
  echo $user_tel;
  ?>
  </dd>
</dl>
<div><a href="t_user_delete_sentaku.php?action=rewrite">&laquo;&nbsp;戻る</a>
<input type="submit" value="削除する"></div>
</form>
</body>
</html>
