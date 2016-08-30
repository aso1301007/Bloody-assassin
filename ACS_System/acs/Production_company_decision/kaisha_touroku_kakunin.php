
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

<?php session_start();
require_once "../DB.php";
include '../acs_header.php';
?>
<div id="title">製作会社追加</div>

<h3 style="margin-top:50px; text-align:center;">以下の内容でよろしいですか？</h3>
  <form action="kaisha_touroku_kanryou.php" method="post">
  <table align="center" border="1" style="margin-bottom:10px;">
  	<tr>
  		<td align="center">会社名</td>
  		<td>  <?php  if(isset($_POST["name"]))
								  $_SESSION["name"]=$_POST["name"];
								  echo $_SESSION["name"];?></td>
  	</tr>
	<tr>
		<td align="center">メールアドレス</td>
		<td><?php  if(isset($_POST["mail"]))
					  $_SESSION["mail"]=$_POST["mail"];
					  echo $_SESSION["mail"];?>
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
