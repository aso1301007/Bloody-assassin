<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../../css.css"></link>

<title>画像選択</title>
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
//		セッションデータ取得
//			$user_id = $_SESSION['user_id'];	//ユーザ表.ユーザid
//			$user_name = $_SESSION['user_name'];//ログイン者名
	?>
	<?php
	require '../../DB.php';
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
		?>
	<div id="header">
		<div id="top">
			<input type="button" name="top" value="TOP" onclick="location.href='/acs_system/Shcool/School_Home.php'" />
		</div>
		<div id="login_name"><?php //echo $user_name;?>さん</div>
	</div>
	<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログイン</li>
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
	<div id="border"></div>
	<div id="title">画像検索</div>
		<div id="number_search" style="float:left; width:350px; height:70px; border-style: solid; border-width: 1px; margin:20px 5px 5px 20px; padding:10px;" align="left">
			<b>制作物ナンバーを入力してください。</b>
			<p>制作物ナンバー：<input type="text" style="height:20px; vertical-align: middle;" name="number_search" size="20" maxlength="8" />
			<span style="margin-right: 1em;"></span>
			<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
		</div>
		<div id="period_sort" style="float:right; width:400px; height:70px; border-style: solid; border-width: 1px; margin:20px 20px 5px 5px; padding:10px;" align="left">
			<form id="sort_period">
				<b>年と月を選択してください。</b>
			<p>年：
				<select id="period_sort01">
					<option value="1">オプション</option>
					<option value="99" selected>選択してください</option>
				</select><span style="margin-right: 1em;"></span>
			月：
			<select id="period_sort02">
				<option value="1">おぷしょん</option>
				<option value="99" selected>選択してください</option>
			</select><span style="margin-right: 1em;"></span>
			<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
			</form>
		</div>
		<div style="clear: both"></div>
		<div id="item_sort" style="border-style: solid; border-width: 1px; margin:5px 20px 10px 20px; padding:10px;" align="left">
			<form id="sort_item">
			<b>項目と条件を選択してください。</b>
			<p>項目：
				<select id="item_sort01">
					<option value="1">オプション</option>
					<option value="99" selected>選択してください</option>
				</select><span style="margin-right: 1em;"></span>
			条件：
			<select id="item_sort02">
				<option value="1">おぷしょん</option>
				<option value="99" selected>情報ビジネス　北九州校</option>
			</select><span style="margin-right: 1em;"></span>
			<input type="submit" style="height:32px; vertical-align: middle;" value="表示" /></p>
			</form>
		</div>
		<div id="syoruiitiran" style="clear:right;clear:left; border-style: solid; border-width: 1px; margin-right: 20px; margin-left: 20px; height:550px;">
		<?php
			//データ取得＆出力
			//クラスオブジェクト作成
			$PAGE01 = new page($pdo);

			//メソッドを実行して結果を取得
			$tyuumon01 = $PAGE01->Date();	//案件を更新日時降順10件取得
		?>
		<?php
			$count=0;
			while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
				$img_path=$sql01['gazou_path'];
				if($img_path==null){
					$img_path="NoImage.png";
				}//画像がないときNoImage.png;
				$tm_id =$sql01['tm_id'];
				if($count%3==0){
					echo"<br clear='left'>";
				}
				echo <<<EOT
					<div style="float:left; margin-left:6em; text-align:center;">
						<form action="Documents_detail.php" method="post">
 							<input type="image" src="$img_path" alt="画像" width="140px" height="120px"/>
							<input type="hidden" name="eturan_tm_id" value="$tm_id" />
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