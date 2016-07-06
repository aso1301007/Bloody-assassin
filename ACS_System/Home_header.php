<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=css.css>

<title>Insert title here</title>


<script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
<script src="js/jquery.focused.min.js"></script>

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
	require_once 'DB.php';



?>


<div id="header">
			<div id="title" >TOP</div>
			<div id="login_name">担当者さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>
			ログイン
		</li>
		<li>書類閲覧
			<ul style="list-style:none;">
				<li><a href="#">発注書一覧</a></li>
				<li><a href="#">制作物結果報告書</a></li>
			</ul>
		</li>
		<li>検索機能
			<ul style="list-style:none;">
				<li><a href="#">制作物ナンバー検索</a></li>
			</ul>
		</li>
		<li>DB管理
			<ul style="list-style:none;">
				<li><a href="#">注文者マスタ追加</a></li>
				<li><a href="#">制作会社マスタ追加</a></li>
			</ul>
		</li>
	</ul>

</div>


<div id="main">



	</div>
</div>

</body>


</html>