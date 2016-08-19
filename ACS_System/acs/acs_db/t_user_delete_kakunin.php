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
	$stmt = $pdo -> prepare("SELECT U.user_name,U.user_mail,U.user_tel,T.tyuumonsha_busho_name,S.school_name,S.school_id FROM ((user U
								JOIN tyuumonsha T ON U.user_id = T.user_id)
								JOIN school S ON S.school_id = T.school_id)
							WHERE U.user_id=?");
	$stmt->execute(array($user_id));//SQL文実行
}catch (PDOException $e) {
	print "Exception";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$user_name =$row['user_name'];
	$user_mail =$row['user_mail'];
	$user_tel =$row['user_tel'];
	$school_name =$row['school_name'];
	$school_id =$row['school_id'];
	$busho =$row['tyuumonsha_busho_name'];
}

?>

<h3 style="margin-top:50px; text-align:center;">以下の注文者を削除してもよろしいですか？</h3>
  <form action="t_user_delete_kanryou.php" method="post">
  <table align="center" border="1" style="margin-bottom:10px;">
  	<tr>
  		<td align="center">氏名</td>
  		<td>  <?php   echo $user_name;?></td>
  	</tr>
	<tr>
		<td align="center">学校</td>
		<td>  <?php   echo $school_name;?></td>
	</tr>
	<tr>
		<td align="center">部署</td>
		<td>  <?php  echo $busho;  ?>
		</td>
	</tr>
	<tr>
		<td align="center">メールアドレス</td>
		<td><?php  echo $user_mail;?>
		</td>
	</tr>
	<tr>
		<td align="center">電話番号</td>
		<td>  <?php  echo $user_tel;?>
		</td>
	</tr>
</table>
<div style="margin-right:24em; float:right; margin-top:0px;">
<input type="submit" value="削除"/></div>
<input type="hidden" name="id" value="<?php echo $user_id;?>"></input>
 </form>

<div style="margin-left:24em; margin-bottom:20px; margin-top:10px;">
 <form action="t_user_delete_sentaku.php" method="post">
	<input type="submit" value="戻る"></input>
	<input type="hidden" name="school"value="<?php echo $school_id;?>"></input>
 </form>
 </div>
</body>
</html>
