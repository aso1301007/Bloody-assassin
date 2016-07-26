<?php
	/**
	 * 与えられた文字列をエスケープして返す
	 * $line_flagをtrueにすれば改行コードを改行タグに変換することもできる
	 * @param  string  $str       
	 * @param  boolean $line_flag 
	 * @return string 
	 */
	function h($str, $line_flag = false){
		// 改行コードを変換して改行タグにする
		if($line_flag){
			return nl2br(htmlspecialchars($str, ENT_QUOTES, 'UTF-8'));
		}
		else{
			return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
		}
	}

	/**
	 * 承認機能に関するセッション変数を破棄する
	 */
	function reset_var_in_shounin_session(){
		unset($_SESSION['destination_id'], $_SESSION['comment'],
			$_SESSION['tm_id'], $_SESSION['select_action']);
	}
?>