<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>

<title>学校_進捗管理</title>
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

	include '../School_header.php';
	?>
<div id="title">進捗管理</div>
<?php



	session_cache_limiter('none');
//	session_start();
	$user_name=$_SESSION['user_name'];
	require '../../DB.php';

	$flg_name=$_GET['flg_name'];
	$tm_id = $_SESSION['sintyoku_tm_id'];
	$what=$_GET['what'];



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
<div style="text-align:center; margin-top:50px;">
<font size="4"><a>更新しました</a></font><br /></div>
<div style="text-align: center; margin-top:10px; padding-bottom:50px;">
<?php
echo <<<EOT
<input type="button" value="変更を確認する"  onclick="location.href='Progress_situation.php?select_id=$tm_id'"/>
EOT;
?>
</div>
</body>
</html>
