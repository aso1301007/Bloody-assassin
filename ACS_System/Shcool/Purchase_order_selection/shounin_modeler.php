
<?php
	session_start();

	$html_content = "";

	header("Content-type: application/json; charset=UTF-8");

	//Ajaxによるリクエストかどうかの識別を行う
	//strtolower()を付けるのは、XMLHttpRequestやxmlHttpRequestで返ってくる場合があるため
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){  
	  if(isset($_POST['request'])){
	  	$select_action = $_POST['request'];

	  	// 「選択してください」を選択された場合は処理を行わない
	  	if($select_action != ""){

		require_once(dirname(__FILE__). "/bin/DB_Manager.php");
		require_once(dirname(__FILE__) .'/bin/common.php');
		
		$tm_id = $_SESSION['tm_id'];
		$user_id = $_SESSION['user_id'];  // ログインしているユーザのID

	  	$_SESSION['select_action'] = $select_action;

		$db = new DB_Manager();
		$arr_tyumon = $db->select_tyuumon_by_id($tm_id);
		$arr_tyuumonsha = $db->select_all_tyuumonsha();

		$db->set_shounin_arr($tm_id);  // 承認表関係の取得関数を使うための準備
		$arr_my_shounin = $db->get_my_shounin_by_id($user_id);  // ログイン者の承認がなければfalse
		$finished_shounin_flg = $db->check_finished_shounin();  // 最終承認がなされているか
		$created_shounin_flg = $db->check_created_shounin_by_id($user_id);  // 承認フローが作られているか

		$destination_id = "";
		$comment = "";
		if(isset($_SESSION['destination_id'])){
			$destination_id = $_SESSION['destination_id'];
		}
		if(isset($_SESSION['comment'])){
			$comment = h($_SESSION['comment']);
		}

		$html_content_destination = "";
		$html_content_comment = "";

	  	switch($select_action){
	  	case "shounin":
	  	case "shounin_sinsei":
	  		$html_content_destination = <<<HTML
				<h3>注文者一覧</h3>
				<ul>
HTML;

	  		// 送信先を選ぶためのリストを用意
			foreach ($arr_tyuumonsha as $value) {
				if($value['user_id'] == $user_id) continue;
				if(isset($destination_id) && $destination_id == $value['user_id']){	
					$html_content_destination .= <<< HTML
					<li>
						<input type="radio" name="tyuumonsha" value="{$value['user_id']}" checked="checked" />{$value['user_name']}
					</li>
HTML;
				}
				else{
					$html_content_destination .= <<< HTML
					<li>
						<input type="radio" name="tyuumonsha" value="{$value['user_id']}" />{$value['user_name']}
					</li>
HTML;
				}
			}

			$html_content_destination .= <<<HTML
				</ul>
HTML;

	  	case "sasimodosi":
	  		// 最終承認でなく、かつ自分への承認申請がある場合
			if(!$db->check_finished_shounin() && $arr_my_shounin){
				$receive_comment = h($arr_my_shounin['s_comment']);
				$receive_name = h($db->get_name_by_id($arr_my_shounin['s_moto']));
				$shounin_date = $arr_my_shounin['s_date'];

				$html_content_comment = <<<HTML
					<p>
						申請元氏名：$receive_name<br />
						コメント：$receive_comment<br />
						登録日：$shounin_date
					</p>
HTML;
			}

	  		$html_content = <<<HTML

			  <form action="tyuumon.php" method="post" accept-charset="utf-8">
			  <input type="hidden" name="mode" value="check" />	

				<h3>コメント</h3>
				$html_content_comment

				<p><textarea name="comment">$comment</textarea></p>

				$html_content_destination

				<input type="submit" value="確認" />
			  </form>
HTML;
		  	break;

	  	case "last_shounin":
	  		$html_content = <<<HTML

			  <form action="tyuumon.php" method="post" accept-charset="utf-8">
			  <input type="hidden" name="mode" value="check" />
			    <h3>最終承認</h3>
				<input type="submit" value="確認" />
			  </form>
HTML;
		  	break;

	  	}

	  }
	  else{
	  	unset($_SESSION['select_action']);  // 空白ならアンセットする
	  }

	  }else{
	    $html_content = 'The parameter of "request" is not found.';
	  }

	}else{
	  $html_content = 'This access is not valid.';  
	}

	// 呼び出し元に返す
	echo(json_encode($html_content));

?>