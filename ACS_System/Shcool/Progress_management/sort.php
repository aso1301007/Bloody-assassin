<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=stylesheet type=text/css href=../../css.css>



<title>進捗状況</title>


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

//session_start();

//require_once '../../DB.php';
/*//-----前ページで指定された注文書のID受け取り-----
 */
$_SESSION['sintyoku_tm_id']=3;
$tm_id=$_SESSION['sintyoku_tm_id'];
//---------------------------------------


//------ユーザ名取得---------
$user_name=$_SESSION['user_name'];

//SESSIONが切れたらログインページへ
if($user_name==null){
	header("Location:../../Login.html");
}
//$user_name="高塚";

//-----------------------------


$kijun=$_POST['selectName1'];
$koumoku=$_POST['selectName2'];


echo $kijun .$koumoku;
?>
<div id="header">
<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
<div id="login_name">ゲスト さん</div>

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
<li><a href="Img_select">書類閲覧</a></li>
<li><a href="#">製作物画像登録</a></li>
</ul>
</li>
<li>進捗管理
<ul style="list-style:none;">
<li><a href="../progress/Purchase_order_selection.php">進捗管理</a></li>
</ul>
</li>
</ul>
</div>


<div id="main">
<div id="border"></div>
<div id="title">書類一覧</div>


</div>


</body>


</html>