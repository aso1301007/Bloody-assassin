<?php session_start();
require_once "DB.php";
$_SESSION["school"]=$_POST["school"];
$school =$_POST["school"];
$stmt = $pdo -> prepare( "SELECT * FROM tyuumonsha INNER JOIN user ON  tyuumonsha.user_id = user.user_id WHERE tyuumonsha.school_id = :school_id ");
$stmt->bindParam(':school_id', $school, PDO::PARAM_STR);
$stmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>入力画面確認</title>
</head>
<body>
<dl>
  <dt>注文者一覧</dt>
  <dd>
<?php
  while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
  	echo $row['user_id'];
  	echo $row['user_name'];
  	?>
  	<form action="t_user_delete_kakunin.php" method="post" enctype="multipart/form-data">
  	<button type="submit" name="id" value="<?php echo $row['user_id']?>">
  	削除する
  	</button>
  	</form>
  	<?php
  }
  ?>
  </dd>
</dl>
<div><a href="t_user_delete.php?action=rewrite">&laquo;&nbsp;戻る</a>
</div>
</form>
</body>
</html>
