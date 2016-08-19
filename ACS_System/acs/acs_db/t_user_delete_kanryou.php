<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>注文者削除_確認</title>

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
<div id="title">注文者削除</div>
<?php
if(isset($_POST["id"])){
	$user_id=$_POST["id"];
//	echo $user_id;
}
try {
	$stmt = $pdo -> prepare("UPDATE user SET user_yuukou_flg = 0 WHERE :user_id = user_id");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->execute();//SQL文実行
	}catch (PDOException $e) {
		print "Exception2";
		print $e->getMessage();
	}
?>


<div style="text-align: center; margin-top:50px; margin-bottom:10px;">
  <h4>ユーザー削除が完了しました</h4>
  <input type="button" value="削除を続ける" onclick="location.href='t_user_delete.php'"/>
</div>
</body>
</html>