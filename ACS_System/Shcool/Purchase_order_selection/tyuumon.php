<?php
	session_start();
	$err_message = "";

	// submit されたら遷移  
	if (isset($_POST['mode']) && $_POST['mode'] == "check") {
		$_SESSION['destination_id'] = $_POST['tyuumonsha'];
		$_SESSION['comment'] = $_POST['comment'];

		header("Location: ./shounin_kakunin.php");
		exit();
	}

	//  GETでIDを受け取り必要なデータを用意する
	if(isset($_GET['id'])){
		require_once(dirname(__FILE__). "/bin/DB_Manager.php");
		require_once(dirname(__FILE__) .'/bin/common.php');
		
		$tm_id = $_SESSION['tm_id'] = $_GET['id'];
		$user_id = 2;  // ログインしているユーザのID

		$db = new DB_Manager();
		$arr_tyumon = $db->select_tyuumon_by_id($tm_id);

		$db->set_shounin_arr($tm_id);  // 承認表関係の取得関数を使うための準備
		$arr_my_shounin = $db->get_my_shounin_by_id($user_id);  // ログイン者の承認がなければfalse
		$finished_shounin_flg = $db->check_finished_shounin();  // 最終承認がなされているか
		$created_shounin_flg = $db->check_created_shounin_by_id($user_id);  // 承認フローが作られているか

		// 承認が終わっていて、かつログインしている人が申請者だった場合
		if($created_shounin_flg && $finished_shounin_flg){
			// todo:ACSに送信するボタンを挿入する
		}
		else{
			$select_content = "";

			// if($arr_my_shounin){
				// 申請者の場合のセレクターを用意
				if($created_shounin_flg){
					$select_content = <<<HTML
						<select name="select_action" id="select_action">
							<option value="">選択してください</option>
							<option value="shounin_sinsei">承認申請</option>
						</select>
HTML;
				}
				// 承認者の場合のセレクターを用意
				else{
					$select_content = <<<HTML
						<select name="select_action" id="select_action">
							<option value="">選択してください</option>
							<option value="shounin">承認</option>
							<option value="sasimodosi">差し戻し</option>
							<option value="last_shounin">最終承認</option>
						</select>
HTML;
				}

				$select_content .= <<<HTML
					<div id='result'></div><!-- 返してきたデータを表示 -->
HTML;
			// }
		}
	}
	// GETでidがなければエラーにする
	else{
		$err_message = "不正なURLでアクセスされました";
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title></title>
</head>
<body>
		<h3>注文書</h3>
		<p><?= var_dump($arr_tyumon) ?></p>
<?php
	// エラーがなかった場合
	if($err_message == ""){
		print $select_content;
	}
	// エラーメッセージが格納されている場合、メッセージを表示
	else{
		print "<p>$err_message</p>";
	}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function() {

  //送信ボタンをクリック
  $('#select_action').change(function(){

    //POSTメソッドで送るデータを定義する
    //var data = {パラメータ : 値};
    var data = {request : $("#select_action option:selected").val()};

    //Ajax通信メソッド
    //type : HTTP通信の種類(POSTとかGETとか)
    //url  : リクエスト送信先のURL
    //data : サーバに送信する値
    $.ajax({
      type: "POST",
      url: "shounin_modeler.php",
      data: data,
      dataTyoe: "json",
      //Ajax通信が成功した場合に呼び出されるメソッド
      success: function(data, dataType){
        //デバッグ用 アラートとコンソール
        //alert(data);
        //console.log(data);

        //出力する部分
        $('#result').html(data);
      },
      //Ajax通信が失敗した場合に呼び出されるメソッド
      error: function(XMLHttpRequest, textStatus, errorThrown){
        alert('Error : ' + errorThrown);
        $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
        $("#textStatus").html("textStatus : " + textStatus);
        $("#errorThrown").html("errorThrown : " + errorThrown);
      }
    });
    return false;
  });
});

</script>
</body>
</html>