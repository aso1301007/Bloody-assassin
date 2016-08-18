
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_変更情報入力</title>


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


if(isset($_POST["id"])){
	$user_id=$_POST["id"];
	$_SESSION["user_id"] = $user_id;
}

//echo "user_id=",$user_id;
try {
	$stmt = $pdo -> prepare("SELECT * FROM user U INNER JOIN tyuumonsha T ON U.user_id = T.user_id
								WHERE U.user_id=?");
//	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	$stmt->execute(array($user_id));//SQL文実行
}catch (PDOException $e) {
	print "Exception2";
	print $e->getMessage();
}
while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	$name =$row['user_name'];
	$mail =$row['user_mail'];
	$pass =$row['user_pass'];
	$tel =$row['user_tel'];
	$busho =$row['tyuumonsha_busho_name'];
	$school_id=$row['school_id'];
}
// try {
// 	$stmt = $pdo -> prepare("SELECT * FROM tyuumonsha WHERE :user_id = user_id");
// 	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
// 	$stmt->execute();//SQL文実行
// }catch (PDOException $e) {
// 	print "Exception2";
// 	print $e->getMessage();
// }
// while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
// 	$busho =$row['tyuumonsha_busho_name'];
// }
//echo "名前：",$name,"</br>メールアドレス：",$mail,"</br>パスワード：",$pass,"<br/>電話番号：",$tel,"<br/>部署名：",$busho;
?>


<div id="title">注文者情報の入力</div>
  <h4 style="margin-top:50px; text-align:center; text-color:#f00;">※変更される項目の内容を記入してください。<br />※変更のない項目はそのまま</h4>
  <form action="t_user_henkou_kanryou.php" method="post" enctype="multipart/form-data">
  <table align="center">
	<tr>
		<td align="right">氏名</td>
		<td><input type="text" name="user_name" value="<?php echo $name?>" size="15" maxlength="15" /></td>
	</tr>
    <tr>
    	<td align="right">部署</td>
    	<td><input type="text" name="busho" value="<?php echo $busho?>" size="15" maxlength="20" /></td>
    </tr>
	<tr>
		<td align="right">メールアドレス</td>
		<td><input type="text" name="user_mail" value="<?php echo $mail?>" size="40" maxlength="255" /></td>
	</tr>
	<tr>
		<td align="right">パスワード</td>
		<td><input type="password" name="user_pass"value="<?php echo $pass?>"  size="16" maxlength="20" /></td>
	</tr>
	<tr>
		<td align="right">電話番号</td>
		<td><input type="text" name="user_tel" value="<?php echo $tel?>" size="15" maxlength="11" /></td>
	</tr>
</table>
<div style="margin-left:22em; text-align:center; float:left; margin-top:10px;">
<input type="submit" value="情報を変更"/></div>
 </form>
<div style="margin-bottom:20px; margin-top:10px;">
 <form action="t_user_henkou_sentaku.php" method="get">
	 <input type="submit" value="戻る" ></input>
 <input type="hidden" name="school"value="<?php echo $school_id;?>"></input>
 </form>
 </div>
</body>
</html>
