<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head>
<link rel="stylesheet" type="text/css" href="../../css.css"></link>
<link rel="Stylesheet" href="stylesheet.css" type="text/css" />
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>承認申請完了</title>
</head>
<body>
<?php require(dirname(__FILE__) . '/../School_header.php') ?>
<?php require(dirname(__FILE__). "/bin/common.php"); ?>
<?php

$html_content = "";


/* 確認画面からの遷移かどうかをチェック */

if($_POST['mode'] == "registComplete" && isset($_SESSION['select_action'])){

    /*
       入力値により処理を切り分け
       nameがreturnの場合、登録せずに入力画面へ強制遷移
       nameがregistの場合、登録処理を実行 */

    if($_POST['regist']){
        require_once(dirname(__FILE__). "/bin/DB_Manager.php");

        $select_action = $_SESSION['select_action'];
        $db = new DB_Manager();
        $login_user_id = $_SESSION['user_id'];  // ログインしているユーザのIDを入れる

        $destination_id = isset($_SESSION['destination_id']) ? $_SESSION['destination_id'] : null;
        $comment        = isset($_SESSION['comment'])        ? $_SESSION['comment']        : null;
        $tm_id          = isset($_SESSION['tm_id'])          ? $_SESSION['tm_id']          : null;

        if($select_action == "shounin_sinsei"){
            try{
                $db->insert_new_shounin($tm_id, $login_user_id, $destination_id, $comment);

                $html_content = <<<HTML
                    <p>認証依頼を送信しました</p>
                    <p><a href="Confirmation_success.php?id=$tm_id">注文書のページに戻る</a></p>
HTML;
            }
            catch(PDOException $e){
                $html_content = "<p>エラーが発生しました<br />エラー文：". $e->getMessage(). "</p>";
            }
        }
        else{
            $db->set_shounin_arr($tm_id);

            try{
                switch($select_action){
                case "shounin":
                    $shounin_arr = $db->get_my_shounin_by_id($login_user_id);
                    $db->update_shounin_flag($shounin_arr['s_id'], true, false);
                    $db->insert_add_shounin($shounin_arr['sm_id'], $login_user_id, $destination_id, $comment, false, false);

                    $html_content = <<<HTML
                        <p>認証完了、および送信成功しました</p>
                        <p><a href="Confirmation_success.php?id=$tm_id">注文書のページに戻る</a></p>
HTML;
                    break;
                case "sasimodosi":
                    $shounin_arr = $db->get_my_shounin_by_id($login_user_id);
                    $shounin_master_arr = $db->get_shounin_master();
                    $db->update_shounin_flag($shounin_arr['s_id'], false, true);
                    $db->insert_add_shounin($shounin_master_arr['sm_id'], $login_user_id, $shounin_master_arr['sm_sinseisha_id'], $comment, false, true);

                    $html_content = <<<HTML
                        <p>差し戻しを完了しました</p>
                        <p><a href="Confirmation_success.php?id=$tm_id">注文書のページに戻る</a></p>
HTML;
                    break;
               case "last_shounin":
                    $shounin_master_arr = $db->get_shounin_master();
                    $db->update_shounin_master_flag($shounin_master_arr[0]['sm_id'], true, false);

                    $html_content = <<<HTML
                        <p>最終認証を完了しました</p>
                        <p><a href="Confirmation_success.php?id=$tm_id">注文書のページに戻る</a></p>
HTML;
                    break;
               }

            }
            catch(PDOException $e){
                $html_content = "<p>エラーが発生しました<br />エラー文：". $e->getMessage(). "</p>";
            }
        }

        reset_var_in_shounin_session();


    } elseif ($_POST['return']) {

    /* submitボタンが「もとへ戻る」だった場合、登録フォームへ移動 */

        $id = $_SESSION['tm_id'];
        header("Location: ./Confirmation_success.php?id=". $id);
        exit();
    } 

} else {

    /* hidden値が不正、もしくはsubmitボタンで渡されたname値が
    不正な場合、エラーメッセージを表示して、セッション情報削除 */

    $html_content = "<p>不正なアクセスで呼び出された可能性があります</p>";
    reset_var_in_shounin_session();

    }

?>


<div style="margin: 50px">

     <?= $html_content ?>

</div>
</body>
</html>
