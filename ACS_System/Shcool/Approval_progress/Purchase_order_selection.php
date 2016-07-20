<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>進捗管理</title>


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



<script type="text/javascript">
function functionName()
{
var select1 = document.forms.sort.selectName1; //変数select1を宣言
var select2 = document.forms.sort.selectName2; //変数select2を宣言

select2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要

<?php
session_start();
require '../../DB.php';
require '../../user_name.php';

$user_name=$_SESSION['user_name'];
if($user_name==null){
	header("Location: ../../Login/login.html");
}



$pull_hin_janru = $pdo->prepare("SELECT * FROM hinmei");
$pull_hin_janru->execute();
$pull_school_name = $pdo->prepare("SELECT * FROM school");
$pull_school_name ->execute();
$count_h=0;
$count_s=0;
if (!$pull_hin_janru) {
	exit('データを登録できませんでした。');
}
if (!$pull_school_name) {
	exit('データを登録できませんでした。');
}
?>

if (select1.options[select1.selectedIndex].value == "t_naiyou")
{
select2.options[0] = new Option("見積もり","mi");
select2.options[1] = new Option("発注","ha");
}

else if (select1.options[select1.selectedIndex].value == "hin_janru")
{
<?php while ($pull_h = $pull_hin_janru -> fetch(PDO::FETCH_ASSOC))  { ?>

select2.options[<?php echo($count_h); ?>] = new Option("<?php echo($pull_h['hin_janru']); ?>","<?php echo($pull_h['hin_id']);?>");

<?php $count_h++; } ?>
}
else if (select1.options[select1.selectedIndex].value == "school_name")
{
<?php while ($pull_s = $pull_school_name -> fetch(PDO::FETCH_ASSOC))  { ?>

select2.options[<?php echo($count_s); ?>] = new Option("<?php echo($pull_s['school_name']); ?>","<?php echo($pull_s['school_id']);?>");

<?php $count_s++; } ?>
}
}

</script>

</head>

<body onload="functionName()">

<?php




$result = $pdo->prepare("SELECT TY.tm_id, TY.t_date, HI.hin_janru, G.gazou_path FROM ((tyuumon TY
				INNER JOIN hinmei HI ON TY.hin_id = HI.hin_id)
				LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id)ORDER BY TY.t_date ASC LIMIT 9");
$result->execute();



if (!$result) {
	exit('データを登録できませんでした。');
}


//検索
if(isset($_POST['search_text'])){
$search_word = $_POST['search_text'];
	$search_result= $pdo->prepare("select tyuumon.tm_id,tyuumon.t_date,hinmei.hin_janru,tyuumon_master.tm_seisakubutu,gazou.gazou_path
			from tyuumon,tyuumon_master,hinmei,gazou
			where tyuumon.tm_id=tyuumon_master.tm_id and tyuumon.hin_id=hinmei.hin_id and gazou.tm_id=tyuumon.tm_id and tm_seisakubutu
			LIKE :keyword");
	$keyword = "%".$search_word."%";
	$search_result->bindParam(':keyword', $keyword, PDO::PARAM_STR);
	$result=$search_result;
	$result->execute();
}


//ソート
if(isset($_POST['selectName1'])){
	$koumoku = $_POST['selectName1'];
	$zyouken = $_POST['selectName2'];

	//見積もりor発注
	if($koumoku=='t_naiyou'){
		$sort_result= $pdo->prepare("select * from tyuumon,gazou,hinmei
									where tyuumon.t_naiyou=:zyouken and tyuumon.tm_id=gazou.tm_id and hinmei.hin_id=tyuumon.hin_id
									order by :zyouken");
		$sort_result->bindValue(":zyouken", $zyouken);
		$result=$sort_result;
		$result->execute();
	}

	//品名ジャンル
	if($koumoku=='hin_janru'){
		$sort_result= $pdo->prepare("select * from tyuumon,hinmei,gazou
									where tyuumon.hin_id=hinmei.hin_id and tyuumon.tm_id=gazou.tm_id and hinmei.hin_id=:zyouken
									order by :zyouken");
		$sort_result->bindValue(":zyouken", $zyouken);
		$result=$sort_result;
		$result->execute();
	}

	//学校名

	if($koumoku=='school_name'){
		$sort_result= $pdo->prepare("select * from tyuumon,tyuumon_master,tyuumonsha,school,hinmei,gazou
									where tyuumon.tm_id=tyuumon_master.tm_id and tyuumon_master.user_id=tyuumonsha.user_id and
									tyuumonsha.school_id=school.school_id and tyuumon.hin_id=hinmei.hin_id and gazou.tm_id=tyuumon.tm_id and
									 school.school_id=:zyouken order by :zyouken");
		$sort_result->bindValue(":zyouken", $zyouken);
		$result=$sort_result;
		$result->execute();
	}
}

?>

<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name"><?php echo $user_name;?> さん</div>

</div>

<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログアウト
				<ul style="list-style:none;">
					<li><a href="../../Login/Logout.php">ログアウト</a></li>
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
					<li><a href="../Document_Browsing/Image_selection.php">書類閲覧</a></li>
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




<a style="float:left;margin-left:50px">ソート機能</a><a style="float:left;margin-left:345px">検索機能</a><br/>
<div id="sort" style="float:right;float:left;  border: solid 3px #ccc; margin-left:50px">

	<a style="clear:right;float:left">項目：</a>
	<form name="sort" method="post"action="">

	<select name = "selectName1" onchange="functionName()">
	<option value="t_naiyou" label="注文内容" >注文内容</option>
	<option value="hin_janru" label="品名ジャンル" >品名ジャンル</option>
	<option value="school_name" label="学校名" >学校名</option>
	</select>

	<a >条件：</a>
	<select name = "selectName2">
	</select>

	<input style="float:right;block;" type="submit" value="ソート" />
	</form>
</div>

<div id="search"  style="border: solid 3px #ccc;">
	制作物ナンバー：<form  method="post" action="Image_selection.php"style="float:right">
	<input type="text" name="search_text" /><input type="submit" value="検索" /></form>
</div>



<div id="syoruiitiran" style="clear:right;clear:left;">

<ul class="ul-list-02" >
	<?php
		$count=0;
		while ($row = $result -> fetch(PDO::FETCH_ASSOC))  {
			$img_path=$row['gazou_path'];

			if($img_path==null){   //画像がないときNoImage.png
				$img_path="NoImage.png";
			}
			$tm_id =$row['tm_id'];
			if($count%3==0){
				echo"<br clear='left'>";
			}

	//書類情報
echo <<<EOT
	<div style="float:left; margin-left:6em; text-align:center;">
								<form action="Progress_situation.php" method="post">
 									<input type="image" src="$img_path" alt="画像" width="140px" height="120px"/>
									<input type="hidden" name="sintyoku_tm_id" value="$tm_id" />
								</form>
EOT;
								echo "製作物ナンバー:",$row['tm_id'],"<br/>製作日:",$row['t_date'],"<br />品名：",$row['hin_janru'];
								echo "</div>";
								$count++;
		}
				?>

</div>

</div>
<?php
     		// MySQL 切断
     		$pdo = null;
    	?>

</body>


</html>