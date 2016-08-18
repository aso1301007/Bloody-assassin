<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_注文者情報の変更</title>


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

<?php
require "../../DB.php";
include '../acs_header.php';



if(isset($_SESSION["user_id"])){
	$user_id=$_SESSION["user_id"];
	//echo $user_id;
}
$name=$_POST["user_name"];
$mail=$_POST["user_mail"];
$pass=$_POST["user_pass"];
$tel=$_POST["user_tel"];
$busho=$_POST["busho"];
//echo $name,$mail,$pass,$tel,$busho;
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

<h4 style="margin-top:50px; text-align:center;">情報の変更が完了しました</h4>
<table align="center" border="1" style="margin-bottom:5px;">
	<tr>
		<td align="right">名前</td>
		<td><?php echo $name;?></td>
	</tr>
	<tr>
		<td align="right">メールアドレス</td>
		<td><?php echo $mail;?></td>
	</tr>
	<tr>
		<td align="right">パスワード</td>
		<td><?php echo $pass;?></td>
	</tr>
	<tr>
		<td align="right">電話番号</td>
		<td><?php echo $tel;?></td>
	</tr>
	<tr>
		<td align="right">部署</td>
		<td><?php echo $busho;?></td>
	</tr>
</table>
<input type="button" value="学校選択画面へ" onclick="location.href='t_user_henkou.php'" style="margin-left:350px; top: 0px;margin-bottom:3em;" />
</body>
</html>
