<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link rel="stylesheet" type="text/css" href="../../css.css"/>
<link rel="stylesheet" type="text/css" href="css.css"/>
<title>相みつ会社選択</title>

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
</script>
</head>
<?php
require '../../DB.php';
include '../acs_header.php';
?>
<body>
<div id="title">相みつ会社選択</div>

<!-- 折り畳み展開ポインタ 注文書 -->
<div onclick="obj=document.getElementById('order').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;"><input type="button" value="▼ 注文書レイアウト" /></a>
</div>
<!--// 折り畳み展開ポインタ 注文書 -->

<!-- 折り畳まれ部分 注文書レイアウト -->
<div id="order" style="display:none;clear:both;">


</div>
<!--// 折り畳まれ部分 注文書レイアウト -->

<!-- 折り畳み展開ポインタ 相みつ会社 -->
<div onclick="obj=document.getElementById('company').style; obj.display=(obj.display=='none')?'block':'none';">
<a style="cursor:pointer;"><input type="button" value="▼ 相みつ会社一覧" /></a>
</div>
<!--// 折り畳み展開ポインタ 相みつ会社 -->

<!-- 折り畳まれ部分 相みつ会社一覧 -->
<div id="company" style="display:none;clear:both;">
adf;kldajf;aoiji;
<!--ここの部分が折りたたまれる＆展開される部分になります。
自由に記述してください。-->

</div>
<!--// 折り畳まれ部分 相みつ会社一覧 -->

</body>
</html>