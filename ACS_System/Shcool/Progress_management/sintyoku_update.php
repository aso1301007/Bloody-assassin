<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>

<title>進捗管理</title>
<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../../js/jquery.focused.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#menu li").hover(function() {
			$(this).children('ul').show();
			//window.alert('キャンセルされました');
		}, function() {
			$(this).children('ul').hide();
			//window.alert('キャンセルされました');
		});
	});
</script>

</head>
<body>
<?php
	session_start();
	$user_name=$_SESSION['user_name'];
?>
	<div id="header">
			<input type="button" name="top" value="TOP" margin-left: 20px;margin-top: 15px; onclick="location.href='School_Home.php'">

		<div id="login_name"><?php echo $user_name;?>さん</div>
	</div>
	<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログアウト
				<ul style="list-style:none;">
					<li><a href="../Login/Logout.php">ログアウト</a></li>
				</ul>
			</li>
			<li>注文書
				<ul style="list-style:none;">
					<li><a href="#">新規注文書</a></li>
					<li><a href="#">注文書選択</a></li>
				</ul>
			</li>
			<li>書類
				<ul style="list-style:none;">
					<li><a href="../eturan/Img_select.php">書類閲覧</a></li>
					<li><a href="#">製作物画像登録</a></li>
				</ul>
			</li>
			<li>進捗管理
				<ul style="list-style:none;">
					<li><a href="Purchase_order_selection.php">進捗管理</a></li>
				</ul>
			</li>
		</ul>
	</div>

<div id="main">
<div id="border"></div>
<div id="title">進捗管理</div>
<div style="text-align:center; margin-top:50px;">
<font size="4"><a>更新しました</a></font><br /></div>
<div style="text-align: center; margin-top:10px; padding-bottom:50px;">
<input type="button" value="進捗管理画面へ戻る" onclick="location.href='Purchase_order_selection.php'"/>
</div>

<?php


require '../../DB.php';

	$flg_name=$_POST['flg_name'];
	$tm_id = $_SESSION['sintyoku_tm_id'];
	$what=$_POST['what'];



if($what=="1"){
//----UPDATE文  OK----------------------------
	$sql = "UPDATE tyuumon_master SET ". $flg_name ." = :atai WHERE tm_id= :tm";
	 try{
		 $stmt = $pdo->prepare($sql);
		 $stmt->bindValue(':tm', $tm_id, PDO::PARAM_INT);
		 $stmt->bindValue(':atai',1,PDO::PARAM_INT);
		 $stmt->execute();

	 }catch (PDOException $e) {
	 	print $e->getMessage();
	 }
}else{
	 //----UPDATE文  取り消し----------------------------
	 $sql = "UPDATE tyuumon_master SET ". $flg_name ." = :atai WHERE tm_id= :tm";
	 try{
		 	$stmt = $pdo->prepare($sql);
	 		$stmt->bindValue(':tm', $tm_id, PDO::PARAM_INT);
		 	$stmt->bindValue(':atai',0,PDO::PARAM_INT);
		 	$stmt->execute();

	 }catch (PDOException $e) {
	 	print $e->getMessage();
	 }

}
?>

</body>
</html>