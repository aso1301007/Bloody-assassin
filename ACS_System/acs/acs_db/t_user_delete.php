<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_注文者削除</title>


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
?>
<div id="title">注文者の削除</div>
<?php
$sql ="SELECT * FROM school";

?>
  <h4 style="margin-top:50px; text-align:center;">削除したい注文者の所属学校を選択してください</h4>
  <form action="t_user_delete_sentaku.php" method="post" enctype="multipart/form-data">
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
    		<input type="submit" value="検索"/>
    	</td>
    </tr>
  </table>
  	<div style="margin-bottom:10px;">
    	<input type="button" value="戻る" onclick="location.href='function_selection.php'" style="width:5em; position:relative; left:27em; top:1px;"/>
    </div>
  </body>
</html>
