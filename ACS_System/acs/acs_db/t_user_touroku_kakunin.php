<?php session_start();
require_once "DB.php";
$_SESSION["school"]=$_POST["school"];
$a =$_POST["school"];
// クエリを送信する
$sql = "SELECT school_name FROM school WHERE school_id =?";
$data = $pdo->prepare($sql);
$data->execute(array($a));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>入力画面確認</title>
</head>
<body>
  <form action="t_user_touroku_kanryou.php" method="post">
<dl>
<dt>氏名</dt>
  <dd>
  <?php
  if(isset($_POST["name"]))
  $_SESSION["name"]=$_POST["name"];
  echo $_SESSION["name"];
  ?>
  </dd>
  <dt>学校</dt>
  <dd>
  <?php
  if(isset($_POST["school"]))
  while($row = $data ->fetch(PDO::FETCH_ASSOC)){
  	echo $row['school_name'];
  }
  ?>
  </dd>
  <dt>部署</dt>
  <dd>
  <?php
  if(isset($_POST["busho"]))
  $_SESSION["busho"]=$_POST["busho"];
  echo $_SESSION["busho"];
  ?>
  </dd>
  <dt>メールアドレス</dt>
  <dd>
<?php
  if(isset($_POST["mail"]))
  $_SESSION["mail"]=$_POST["mail"];
  echo $_SESSION["mail"];
  ?>
  </dd>
  <dt>パスワード</dt>
  <dd>
  <?php
  if(isset($_POST["pass"]))
  $_SESSION["pass"]=$_POST["pass"];
  ?>
    【表示されません】
  </dd>
  <dt>電話番号</dt>
  <dd>
  <?php
  if(isset($_POST["tel"]))
  $_SESSION["tel"]=$_POST["tel"];
  echo $_SESSION["tel"];
  ?>
  </dd>
</dl>
<div><a href="t_user_touroku.php?action=rewrite">&laquo;&nbsp;書き直す</a>
<input type="submit" value="登録する"></div>
</form>
</body>
</html>
