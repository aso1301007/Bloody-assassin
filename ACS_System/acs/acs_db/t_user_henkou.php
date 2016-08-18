<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_注文者情報変更</title>


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
$sql ="SELECT * FROM school";

?>
<div id="title">注文者情報の変更</div>
  <h4 style="margin-top:50px; text-align:center;">変更したい注文者の所属学校を選択してください</h4>
  <form action="t_user_henkou_sentaku.php" method="get" enctype="multipart/form-data">
  <table align="center">
    <tr>
    	<td><from>
    	<select name="school">
    	<?php
		$school = "SELECT * FROM school";
		$yes_school =  $pdo->prepare($school);
		$yes_school->execute();
		while($res = $yes_school->fetch(PDO::FETCH_ASSOC)){
			echo "<option value=". $res['school_id']. ">". $res['school_name']. "</option>";
	}
?>
    	</select>
      	</from>
    	</td>
    	<td>
    		<input type="submit" value="検索" />
    	</td>
    </tr>
  </table>
    <div style="text-align:center; margin-bottom:10px;" />
</body>
</html>
