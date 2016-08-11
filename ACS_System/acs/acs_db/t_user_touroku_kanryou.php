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


<div style="text-align: center; margin-top:50px; margin-bottom:10px;">
  <p>ユーザー登録が完了しました</p>
  <input type="button" value="注文者の追加画面へ" onclick="location.href='http://localhost/ACS_System/acs/acs_db/t_user_touroku.php'"/>
</div>
</body>
</html>
