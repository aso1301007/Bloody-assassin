<?php
//----注文書承認に関する進捗-------------




//session_start();
//require_once'../DB.php';

function sintyoku_approval($flg_name,$what){

	$tm_id = $_SESSION['tm_id'];
//	echo $tm_id;
//	echo $flg_name;


if($what==1){
	//----UPDATE文  ok----------------------------
	$sql = "UPDATE shounin SET ". $flg_name ." = :atai WHERE tm_id= :tm";
	 try{
	 $stmt = $pdo->prepare($sql);
	 // 	$stmt->bindValue(':column_name', $flg_name, PDO::PARAM_STR);
	 $stmt->bindValue(':tm', $tm_id, PDO::PARAM_INT);
	 $stmt->bindValue(':atai',$what,PDO::PARAM_INT);
	 $stmt->execute();
/*	 while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
	 echo $tm_kakunin_flg;
	 }
*/
	 }catch (PDOException $e) {
	 print $e->getMessage();
	 }
}

else{
//----UPDATE文  差し戻し----------------------------
	 $sql = "UPDATE shounin SET s_sasimodosi_flg = :atai WHERE tm_id= :tm";
	 try{
	 	$stmt = $pdo->prepare($sql);
	 	// 	$stmt->bindValue(':column_name', $flg_name, PDO::PARAM_STR);
	 	$stmt->bindValue(':tm', $tm_id, PDO::PARAM_INT);
	 	$stmt->bindValue(':atai',$what,PDO::PARAM_INT);
	 	$stmt->execute();
	 	/*	 while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
	 	 echo $tm_kakunin_flg;
	 	 }
	 	 */
	 }catch (PDOException $e) {
	 	print $e->getMessage();
	 }

}
return;
}
?>
