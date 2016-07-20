<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css.css"/>

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
<script type="text/javascript">
      $(function(){
           $("a[href^='http://']").attr("target","_blank");
           $(".open").click(function(){
                $("#slideBox").slideToggle("fast");
           });
      });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open2").click(function(){
               $("#slideBox2").slideToggle("fast");
          });
     });

      $(function(){
          $("a[href^='http://']").attr("target","_blank");
          $(".open3").click(function(){
               $("#slideBox3").slideToggle("fast");
          });
     });
 </script>

<script>//プルダウン切り替え
		$(function domReady() {
  		$('.demo').focused();
		});
</script>

</head>

<body>

<?php
/*
mysql_set_charset('utf8');

$result = mysql_query(  "select tyuumon.tm_id,tyuumon_master.seisakubutu,tyuumon.t_date,gazou.gazou_path"
						+"from  tyuumon,gazou,tyuumon_master"
						+"where tyuumon.tm_id=gazou.tm_id");

//if($result[gazou_path]==""){ }画像がないとき（空白）ならNoImage


if (!$result) {
	exit('データを登録できませんでした。');
}
*/
?>


<div id="header">
			<div id="title" >TOP</div>
			<div id="login_name">担当者さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>
			ログアウト
		</li>
		<li>書類閲覧
			<ul style="list-style:none;">
				<li><a href="Image_selection.php">発注書一覧</a></li>
				<li><a href="#">制作物結果報告書</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="#">進捗管理</a></li>
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


	<p class="open">[ 注文書▼ ]</p>
		<div id="slideBox" class="divColorGray">注文書を表示</div>

	<p class="open2">[ 報告書▼ ]</p>
		<div id="slideBox2" class="divColorGray">報告書を表示</div>

	<p class="open3">[ 画像▼ ]</p>
		<div id="slideBox3" class="divColorGray">画像を表示</div>


</div>

</body>


</html>