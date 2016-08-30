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
<div id="title">注文者追加</div>
<?php

$name =$_SESSION["name"];
$mail =$_SESSION["mail"];
$tel =$_SESSION["tel"];


try {
$stmt = $pdo -> prepare("INSERT INTO seisaku_kaisha(seisaku_name,seisaku_tel,seisaku_mail)
		VALUES (:name,:tel,:mail)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);//変数を入力するときはこっち:bindParam
$stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
$stmt->execute();//SQL文実行
}catch (PDOException $e) {
    print "Exception2";
    print $e->getMessage();
}

?>


<div style="text-align: center; margin-top:50px; margin-bottom:10px;">
  <h4>ユーザー登録が完了しました</h4>
  <input type="button" value="注文者の追加画面へ" onclick="location.href='t_user_touroku.php'"/>
</div>
</body>
</html>
