<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css.css"></link>

<title>学校ホームページ</title>
<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
<script src="../js/jquery.focused.min.js"></script>
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
		//DB接続を行うPHPファイルを読み込み。同一フォルダにDB.phpを保存しておく
		require_once "../DB.php";
		//セッションデータ取得
		$user_id = $_SESSION['user_id'];	//ユーザ表.ユーザid
 		$user_name = $_SESSION['user_name'];//ログイン者名

	?>
	<?php
		class page{
			//プロパティを定義
			public $True_Flg;
			public $False_Flg;
			public $User_Id;
			public $pdo;


			//メソッドを定義
			function __construct($pdo){
				$this->pdo = $pdo;
			}
			function Count(){
				// MySQL 問い合わせ(件数)
				$sql_count = "SELECT *
								FROM tyuumon_master TM inner join user US on TM.user_id = US.user_id
								WHERE ". $this->True_Flg. " = true and ". $this->False_Flg. " = false
									and TM.tm_sakujo_flg = false and TM.user_id =".$this->User_Id;
				if (!($result_count = $this->pdo->prepare($sql_count))) {
					echo "クエリ失敗(count)";
					die;
				}
				//レコード数を調べる
				$result_count->execute();
				$result_set = $result_count->fetchAll();
				$count = count($result_set);

				return $count;
			}

			function Date(){
				//MySQL 問い合わせ(更新降順の注文書)
				$sql_tyuumon = "SELECT TY.t_date, TY.t_naiyou, HI.hin_janru
								FROM ((tyuumon TY inner join hinmei HI on TY.hin_id = HI.hin_id)
									inner join tyuumon_master TM on TY.tm_id = TM.tm_id)
									inner join user USER on TM.user_id = USER.user_id
								WHERE ". $this->True_Flg. " = true and ". $this->False_Flg. " = false
									and TM.tm_sakujo_flg = false and TM.user_id =".$this->User_Id
								." ORDER BY TY.t_date DESC LIMIT 10";
				if (!($result_tyuumon = $this->pdo->prepare($sql_tyuumon))) {
					echo "クエリ失敗(tyuumon)";
					die;
				}

				$result_tyuumon->execute();
				return $result_tyuumon;
			}
		}
	?>
	<div id="header">
		<div id="title">
			<input type="button" name="top" value="TOP" onclick="location.href='School_Home.php'" />
		</div>
		<div id="login_name"><?php echo $user_name;?>さん</div>
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
		<table border="1" width="500" align="center">
			<tr><th><?php echo $user_name;?>さんの進捗状況</th></tr>
		<?php
			//START_折りたたみページ1(発注済み)
				//クラスオブジェクト作成
				$PAGE01 = new page($pdo);

				//プロパティに値を代入
				$PAGE01->True_Flg = "TM.tm_hattyu_flg";
				$PAGE01->False_Flg = "TM.tm_kakunin_flg";
				$PAGE01->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count01 = $PAGE01->Count();	//件数取得
				$tyuumon01 = $PAGE01->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ1
			//START_折りたたみページ2(確認済み)
				//クラスオブジェクト作成
				$PAGE02 = new page($pdo);

				//プロパティに値を代入
				$PAGE02->True_Flg = "TM.tm_kakunin_flg";
				$PAGE02->False_Flg = "TM.tm_mitumorityuu_flg";
				$PAGE02->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count02 = $PAGE02->Count();	//件数取得
				$tyuumon02 = $PAGE02->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ2
			//START_折りたたみページ3(見積もり中)
				//クラスオブジェクト作成
				$PAGE03 = new page($pdo);

				//プロパティに値を代入
				$PAGE03->True_Flg = "TM.tm_mitumorityuu_flg";
				$PAGE03->False_Flg = "TM.tm_mitumorizumi_flg";
				$PAGE03->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count03 = $PAGE03->Count();	//件数取得
				$tyuumon03 = $PAGE03->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ3
			//START_折りたたみページ4(見積もり済み)
				//クラスオブジェクト作成
				$PAGE04 = new page($pdo);

				//プロパティに値を代入
				$PAGE04->True_Flg = "TM.tm_mitumorizumi_flg";
				$PAGE04->False_Flg = "TM.tm_nouhin_flg";
				$PAGE04->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count04 = $PAGE04->Count();	//件数取得
				$tyuumon04 = $PAGE04->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ4
			//START_折りたたみページ5(納品)
				//クラスオブジェクト作成
				$PAGE05 = new page($pdo);

				//プロパティに値を代入
				$PAGE05->True_Flg = "TM.tm_nouhin_flg";
				$PAGE05->False_Flg = "TM.tm_touroku_flg";
				$PAGE05->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count05 = $PAGE05->Count();	//件数取得
				$tyuumon05 = $PAGE05->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ5
			//START_折りたたみページ6(登録済み)
				//クラスオブジェクト作成
				$PAGE06 = new page($pdo);

				//プロパティに値を代入
				$PAGE06->True_Flg = "TM.tm_touroku_flg";
				$PAGE06->False_Flg = "TM.tm_houkokusho_flg";
				$PAGE06->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count06 = $PAGE06->Count();	//件数取得
				$tyuumon06 = $PAGE06->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ6
			//START_折りたたみページ7(報告書入力済み)
				//クラスオブジェクト作成
				$PAGE07 = new page($pdo);

				//プロパティに値を代入
				$PAGE07->True_Flg = "TM.tm_houkokusho_flg";
				$PAGE07->False_Flg = "TM.tm_sakujo_flg";
				$PAGE07->User_Id = $user_id;

				//メソッドを実行して結果を取得
				$count07 = $PAGE07->Count();	//件数取得
				$tyuumon07 = $PAGE07->Date();	//案件を更新日時降順10件取得
			//FIN_折りたたみページ6

		?>

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ1  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open01').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼発注済み：<?php echo "$count01"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open01" style="display:none;clear:both;">
				<?php
					while($sql01 = $tyuumon01->fetch(PDO::FETCH_ASSOC)){
						echo $sql01['t_date'], "　・　", $sql01['hin_janru'], "　・　", $sql01['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ1  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ2  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open02').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼確認済み：<?php echo "$count02"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open02" style="display:none;clear:both;">
				<?php
					while($sql02 = $tyuumon02->fetch(PDO::FETCH_ASSOC)){
						echo $sql02['t_date'], "　・　", $sql02['hin_janru'], "　・　", $sql02['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ2  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ3  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open03').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼見積もり中：<?php echo "$count03"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open03" style="display:none;clear:both;">
				<?php
					while($sql03 = $tyuumon03->fetch(PDO::FETCH_ASSOC)){
						echo $sql03['t_date'], "　・　", $sql03['hin_janru'], "　・　", $sql03['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ3  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ4  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open04').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼見積もり済み：<?php echo "$count04"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open04" style="display:none;clear:both;">
				<?php
					while($sql04 = $tyuumon04->fetch(PDO::FETCH_ASSOC)){
						echo $sql04['t_date'], "　・　", $sql04['hin_janru'], "　・　", $sql04['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ4  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ5  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open05').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼納品：<?php echo "$count05"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open05" style="display:none;clear:both;">
				<?php
					while($sql05 = $tyuumon05->fetch(PDO::FETCH_ASSOC)){
						echo $sql05['t_date'], "　・　", $sql05['hin_janru'], "　・　", $sql05['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->

		</td></tr><!-- //折りたたみページ5  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ6  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open06').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼登録済み：<?php echo "$count06"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open06" style="display:none;clear:both;">
				<?php
					while($sql06 = $tyuumon06->fetch(PDO::FETCH_ASSOC)){
						echo $sql06['t_date'], "　・　", $sql06['hin_janru'], "　・　", $sql06['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ6  -->

		<tr><td style="background-color:#FFCACA;"><!-- 折りたたみページ7  -->
			<!-- 折り畳み展開ポインタ -->
			<div onclick="obj=document.getElementById('open07').style; obj.display=(obj.display=='none')?'block':'none';">
				<a style="cursor:pointer;">▼報告書入力済み：<?php echo "$count07"; ?>件</a>
			</div>
			<!--// 折り畳み展開ポインタ -->

			<!-- 折り畳まれ部分 -->

			<div id="open07" style="display:none;clear:both;">
				<?php
					while($sql07 = $tyuumon07->fetch(PDO::FETCH_ASSOC)){
						echo $sql07['t_date'], "　・　", $sql07['hin_janru'], "　・　", $sql07['t_naiyou'], "<br />";
					}
				?>
			</div>
			<!--// 折り畳まれ部分 -->
		</td></tr><!-- //折りたたみページ7  -->

		</table>
		<?php
     		// MySQL 切断
     		$pdo = null;
    	?>
	</div>
</body>
</html>