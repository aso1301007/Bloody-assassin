<?php

session_start();
//require '../DB.php';
$user_name=$_SESSION['user_name'];

//ログインしていないorセッションが切れた場合------------
	if($user_name==null){
		header("Location: ../Login/login.html");
	}


?>
<div id="header">
			<input type="button" name="top" value="TOP" onclick="location.href='http://localhost/ACS_System/acs/acs_Home.php'"style="position: absolute; left: 13em; top: 10px"/>

			<div id="login_name"><?php echo $user_name;?> さん</div>
</div>

<div id="select_menu" style="clear:left;">
		<ul id="menu">
			<li>ログアウト
				<ul style="list-style:none;">
					<li><a href="http://localhost/ACS_System/Login/Logout.php" target="_self">ログアウト</a></li>
				</ul>
			</li>
			<li>書類閲覧
				<ul style="list-style:none;">
					<li><a href="http://localhost/ACS_System/acs/Document_Browsing/Image_selection.php" target="_self">発注書一覧</a></li>
					<li><a href="#">制作物結果報告書</a></li>
				</ul>
			</li>
			<li>進捗管理
				<ul style="list-style:none;">
					<li><a href="http://localhost/ACS_System/acs/Progress_management/Purchase_order_selection.php" target="_self">進捗管理</a></li>
				</ul>
			</li>
			<li>DB管理
				<ul style="list-style:none;">
					<li><a href="http://localhost/ACS_System/acs/acs_db/function_selection.php" target="_self">注文者マスタ追加</a></li>
					<li><a href="#">制作会社マスタ追加</a></li>
				</ul>
			</li>
		</ul>
	</div>

	<div id="main">
	<div id="border"></div>

