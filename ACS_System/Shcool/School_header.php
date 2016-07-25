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
			<input type="button" name="top" value="TOP" margin-left: 20px;margin-top: 15px;
			onclick="location.href='http://localhost/ACS_System/School/School_Home.php'">
			<div id="login_name"><?php echo $user_name;?> さん</div>
</div>

<div id="select_menu" style="clear:left;">

	<ul id="menu">
		<li>ログアウト
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Login/Logout.php">ログアウト</a></li>
			</ul>
		</li>
		<li>注文機能
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/New_purchase_order/Entry.php">新規注文書</a></li>
				<li><a href="http://localhost/ACS_System/Shcool/Purchase_order_selection/Selection.php">注文書選択</a></li>
			</ul>
		</li>
		<li>書類
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/Document_Browsing/Image_selection.php">書類閲覧</a></li>
				<li><a href="#">製作物画像登録</a></li>
			</ul>
		</li>
		<li>進捗管理
			<ul style="list-style:none;">
				<li><a href="http://localhost/ACS_System/Shcool/Progress_management/Purchase_order_selection.php">進捗管理</a></li>
			</ul>
		</li>
	</ul>

</div>
<div id="main">
<div id="border"></div>
