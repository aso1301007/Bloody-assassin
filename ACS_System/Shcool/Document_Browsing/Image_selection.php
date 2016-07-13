<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"/>
<title>進捗確認</title>


<script type="text/javascript" src="../../js/jquery-3.0.0.min.js"></script>
<script src="../js/jquery.focused.min.js"></script>
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
function sort_pull()
{
var select1 = document.forms.sort.selectName1; //変数select1を宣言
var select2 = document.forms.sort.selectName2; //変数select2を宣言

select2.options.length = 0; // 選択肢の数がそれぞれに異なる場合、これが重要

if (select1.options[select1.selectedIndex].value == "t_naiyou")
{
select2.options[0] = new Option("見積もり","quote");
select2.options[1] = new Option("発注","order");
}

else if (select1.options[select1.selectedIndex].value == "hin_janru")
{
select2.options[0] = new Option("Flyer","1");
select2.options[1] = new Option("Poster","2");
select2.options[2] = new Option("はがき","3");
select2.options[3] = new Option("チラシ","4");
}

else if (select1.options[select1.selectedIndex].value == "school_name")
{
	select2.options[0] = new Option("情報ビジネス　福岡校","1");
	select2.options[1] = new Option("外語＆製菓","2");
	select2.options[2] = new Option("医療福祉　福岡校","3");
	select2.options[3] = new Option("建築＆デザイン","4");
	select2.options[4] = new Option("公務員　福岡校","5");
	select2.options[5] = new Option("リハビリ","6");
	select2.options[6] = new Option("工科自動車","7");
	select2.options[7] = new Option("ビューティー","8");
	select2.options[8] = new Option("情報ビジネス　北九州校","9");
	select2.options[9] = new Option("公務員　北九州校","10");
	select2.options[10] = new Option("医療福祉＆観光","11");
	select2.options[11] = new Option("看護","12");
}
}

</script>


</head>

<body onload="functionName()">
<?php

session_start();
require '../../DB.php';
require '../../user_name.php';

$user_name=$_SESSION['user_name'];
if($user_name==null){
	header("Location:../../Login.html");
}

//$user_name ="高塚万理奈";



//表示する書類の一覧を取得
class page{
	//プロパティを定義
	public $pdo;

 	function __construct($pdo){
 		$this->pdo = $pdo;
 	}

//-----------日付と注文書名の取得---------------------

	function Date(){
		$sql = "SELECT TY.tm_id,TY.t_date, TY.t_naiyou, HI.hin_janru, G.gazou_path FROM (tyuumon TY
				INNER JOIN hinmei HI ON TY.hin_id = HI.hin_id)
				LEFT OUTER JOIN gazou G ON TY.tm_id = G.tm_id ORDER BY TY.t_date ASC LIMIT 9";
//		$data = $pdo->prepare($sql);
//	$data ->execute();//要らないかも？
					if (!($result_tyuumon = $this->pdo->prepare($sql))) {
					echo "クエリ失敗(tyuumon)";
					die;
				}

				$result_tyuumon->execute();
				return $result_tyuumon;
			}

		}


	/*
//検索・ソートのpostを取得
$search_word = $_POST['search_text'];
$search_result=mysql_query("select * from tyuumon where $koumoku = $reason"+"報告書"+"製作物
							where
							")


$koumoku = $_POST['selectName1'];
$zyouken = $_POST['selectName2'];
if($koumoku=t_naiyou){
		$sort_result=mysql_query("select * from tyuumon where t_naiyou=$zyouken order by $zyouken")
					}
else if($koumoku=hin_janru){
		$sort_result=mysql_query("select * from tyuumon,hinmei "
								+"where tyuumon.tm_id=hinmei.tm_id order by $zyouken")
					}
else if($koumoku=school_name){
		$sort_result=mysql_query("select * from tyuumon,tyuumon_master,tyuumonsya,school"
								+"where tyuumon.tm_id=tyuumon_master.tm_id,tyuumon_master.user_id=tyuumonsya.user_id,tyuumonsya.school_id=school.scool_id"
								+"scool.scool_name=$zyouken order by $zyouken")
					}

*/
?>

<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='../School_Home.php'">
			<div id="login_name"><?php $user_name?> さん</div>

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
					<li><a href="Image_selection.php">書類閲覧</a></li>
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


<a style="float:left;margin-left:60px">ソート機能</a><a style="float:right;margin-right:250px">検索機能</a><br/>
<div id="sort">

	<a style="clear:right;float:left">項目：</a>
	<form name="sort" method="post"action="sort.php">

	<select name = "selectName1" onchange="sort_pull()">
	<option value="t_naiyou" label="注文内容" >注文内容</option>
	<option value="hin_janru" label="品名ジャンル" >品名ジャンル</option>
	<option value="school_name" label="学校名" >学校名</option>
	</select>

	<a >条件：</a>
	<select name = "selectName2">
	</select>
	<input style="margin-left:1em; block;" type="submit" value="ソート"/>
	</form>
</div>


<div id="search">
<table><tr><td>
制作物ナンバー：</td><td>
	<form method="post" action="検索処理.php" name="search">
	<input type="text" name="search_text" /><input type="submit" value="検索" name="search"/></form>
</td></tr>
</table>
</div>

<div id="syoruiitiran" style="clear:right;clear:left;">


<?php
//データ取得＆出力
				//クラスオブジェクト作成
				$PAGE01 = new page($pdo);

				//メソッドを実行して結果を取得
				$tyuumon01 = $PAGE01->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ1

?>

				<?php
				$count=0;

					while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
						$img_path=$sql01['gazou_path'];
						if($img_path==null){$img_path="NoImage.png";}//画像がないときNoImage.png;

						$tm_id =$sql01['tm_id'];
						if($count%3==0){
							echo"<br clear='left'>";
						}
echo <<<EOT
								<div style="float:left; margin-left:6em; text-align:center;">
								<form action="Documents_detail.php" method="post">
 									<input type="image" src="$img_path" alt="画像" width="140px" height="120px"/>
									<input type="hidden" name="sintyoku_tm_id" value="$tm_id" />
								</form>
EOT;
								echo "製作日:",$sql01['t_date'],"<br />品名：",$sql01['hin_janru'],"<br />内容:",$sql01['t_naiyou'];
								echo "</div>";
								$count++;
					}
				?>


</div>

</div>


</body>


</html>