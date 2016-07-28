<?php

session_start();
//require '../DB.php';
$user_name=$_SESSION['user_name'];

//ログインしていないorセッションが切れた場合------------
	if($user_name==null){
		header("Location:http://localhost/ACS_System/Login/login.html");
	}


?>
<div id="header">
			<input type="button" name="top" value="TOP" onclick="window.href='http://localhost/ACS_System/Shcool/School_Home.php'">
			<div id="login_name"><?php echo $user_name;?> さん</div>
</div>

<div id="select_menu">

	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Login/Logout.php" target="_self">ログアウト</a></li>
			</ul>
		</li>
		<li>注文機能
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/New_purchase_order/Entry.php" target="_self">新規注文書</a></li>
				<li><a href="http://localhost/ACS_System/Shcool/Purchase_order_selection/Selection.php" target="_self">注文書選択</a></li>
			</ul>
		</li>
		<li>書類
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/Document_Browsing/Image_selection.php" target="_self">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/Progress_management/Purchase_order_selection.php" target="_self">進捗管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<div id="main">
<div id="border"></div>
