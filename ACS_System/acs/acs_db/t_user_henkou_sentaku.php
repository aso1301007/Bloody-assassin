

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>ACS_学校別注文者一覧</title>


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

$_SESSION["school"]=$_GET["school"];
$school =$_GET["school"];
//echo $school;

//-------学校名取得--------------------
$S_name = "SELECT * FROM school WHERE school_id =?";
$yes_school =  $pdo->prepare($S_name);
$yes_school->execute(array($school));
while($res = $yes_school->fetch(PDO::FETCH_ASSOC)){
	$school_name=$res['school_name'];
}
//---------------------------------

//-------注文者一覧取得
$stmt = $pdo -> prepare( "SELECT * FROM tyuumonsha INNER JOIN user ON  tyuumonsha.user_id = user.user_id
							where tyuumonsha.school_id = :school_id ");
$stmt->bindParam(':school_id', $school, PDO::PARAM_STR);
$stmt->execute();
//--------------------------------------
?>

<div id="title">注文者情報の変更</div>
<h4 style="margin-top:50px; text-align:center;"><?php echo $school_name;?><br />の注文者一覧</h4>


<table  border="1" align="center" style="margin-bottom:20px;">
<tr>
	<td style="width:8em; text-align:center;">注文者名</td>
	<td style="width:8em; text-align:center;">部署名</td>
</tr>
	<?php
	  while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){
	  echo "<tr><td>";
//	  	echo $row['user_id'];
	  	echo $row['user_name'],"</td>";
	  	$user_id=$row['user_id'];

	  	echo "<td>",$row['tyuumonsha_busho_name'],"</td>";
  	?>
  	<td><form action="t_user_henkou_nyuuryoku.php" method="post" enctype="multipart/form-data">
  	<input type="submit" name="id"value="選択"/>
  	<input type="hidden" name="id" value="<?php echo $user_id;?>"/></form>
  	</td></tr>
  	<?php
  }
  ?>
</table>

<div style="text-align:center; margin-bottom:20px;">
	<input type="button" value="検索をやり直す" onclick="location.href='t_user_henkou.php'"/>
</div>
</body>
</html>
