
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>新規会員登録</title>

<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){


	$("#menu li").hover(function() {
	$(this).children('ul').show();
}, function() {
	$(this).children('ul').hide();
});


});

//window.alert('キャンセルされました');
</script>
</head>
<body>

<?php //session_start();
require_once "../../DB.php";
include '../acs_header.php';
?>
<div id="title">注文者追加</div>
<?php
$_SESSION["school"]=$_POST["school"];
$school_id =$_POST["school"];
// クエリを送信する
$sql = "SELECT school_name FROM school WHERE school_id =?";
$data = $pdo->prepare($sql);
$data->execute(array($school_id));
?>
<h3 style="margin-top:50px; text-align:center;">以下の内容でよろしいですか？</h3>
  <form action="t_user_touroku_kanryou.php" method="post">
  <table align="center" border="1" style="margin-bottom:10px;">
  	<tr>
  		<td align="center">氏名</td>
  		<td>  <?php  if(isset($_POST["name"]))
								  $_SESSION["name"]=$_POST["name"];
								  echo $_SESSION["name"];?></td>
  	</tr>
	<tr>
		<td align="center">学校</td>
		<td>  <?php if(isset($_POST["school"]))
					  while($row = $data ->fetch(PDO::FETCH_ASSOC)){
					  	echo $row['school_name'];}  ?>
		</td>
	</tr>
	<tr>
		<td align="center">部署</td>
		<td>  <?php  if(isset($_POST["busho"]))
						  $_SESSION["busho"]=$_POST["busho"];
							echo $_SESSION["busho"];  ?>
		</td>
	</tr>
	<tr>
		<td align="center">メールアドレス</td>
		<td><?php  if(isset($_POST["mail"]))
					  $_SESSION["mail"]=$_POST["mail"];
					  echo $_SESSION["mail"];?>
		</td>
	</tr>
	<tr>
		<td align="center">パスワード</td>
		<td>  <?php  if(isset($_POST["pass"]))
						  $_SESSION["pass"]=$_POST["pass"];  ?>
					    【表示されません】
		</td>
	</tr>
	<tr>
		<td align="center">電話番号</td>
		<td>  <?php  if(isset($_POST["tel"]))
					  $_SESSION["tel"]=$_POST["tel"];
					  echo $_SESSION["tel"];?>
		</td>
	</tr>
  </table>
  <div style="margin:10px 0px 10px 0px; float:left; position: relative; left: 28em; top: 0px;"/>
<input type="submit" value="注文者を追加"/></div>
</form>
<div style="margin-bottom:10px;">
	<input type="button" value="入力をやり直す" onclick="location.href='t_user_henkou.php'" style="width:8em; position:relative; left:18em; top:-4px;"/>
</div>

</body>
</html>
