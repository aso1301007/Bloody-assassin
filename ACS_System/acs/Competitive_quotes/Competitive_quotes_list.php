<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<title>相みつ会社決定確認</title>
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
<body>
<?php
	$posid = $_POST['check1'];
	for($i=0;$i<count($posid);$i++){
		echo$posid[$i].",　　";
	}
?>
</body>
</html>