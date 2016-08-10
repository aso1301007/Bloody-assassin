<?php
define("USER_KUBUN_ORDERER", "注文者");
define("USER_KUBUN_ACS", "ACS社員");
define("USER_KUBUN_ADMINISTRATOR", "管理者");

class DB_Manager extends PDO
{
    private $shounin_arr = array();
    private $shounin_master_arr = array();

    public function __construct($file = 'my_setting.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('ファイルが読み込めませんでした：' . $file . '.');
        
        $dsn = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'] .
        ';charset=utf8';
        
        parent::__construct($dsn, $settings['database']['username'], $settings['database']['password']);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // falseにしたらinsert_add_shouninのexcuteがfalseになる
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * boolean型の変数をtrue/falseの文字列に変更する
     * @param  boolean $bool 
     * @return string        'true'もしくは'false'
     */
    // private function convertBoolToString($bool){
        // return $bool ? "true" : "false";
    // }

    /**
     * 渡したテーブル名のテーブルの値をすべて返す
     * @param  string $sql   [必須]SQL文
     * @param  array  $param [任意]where句のパラメータ
     * @return array(array(row_names => values))  行の配列が順番に入った配列
     */
    public function select_table($sql, $param = array()){
        $arr_result = array();

    	try{
    		$stmt = $this->prepare($sql);
    		$stmt->execute($param);

            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                $arr_result[] = $result;
            }
            return $arr_result;
		}
		catch(Exception $m){
			echo "例外発生：". $m->getMessage();
		}
    	
    }

    /**
     * 区分が注文者のユーザをすべて返す
     * @return array(array(row_names => values)) 行の配列が順番に入った配列
     */
    public function select_all_tyuumonsha(){
        $sql = "SELECT * FROM user, tyuumonsha";
        $sql .= " WHERE user.user_id = tyuumonsha.user_id";
        $sql .= " AND user_yuukou_flg = true";
        $sql .= " AND user_kubun = '". USER_KUBUN_ORDERER. "'";

        $arr_result = $this->select_table($sql);

        return $arr_result;
    }

    /**
     * 引数で指定されたIDの注文書を返す
     * @param  int $id 注文書のID
     * @return array(row_names => values) 行の配列     
     */
    public function select_tyuumon_by_id($id){
        $sql = "SELECT * FROM tyuumon_master, tyuumon";
        $sql .= " WHERE tyuumon_master.tm_id = tyuumon.tm_id";
        $sql .= " AND tyuumon_master.tm_id = ?";

        $param = array($id);

        $arr_result = $this->select_table($sql, $param);

        return count($arr_result) > 0 ? $arr_result[0] : null;
    }

    /**
     * 引数で指定されたIDの、区分が注文者のユーザを返す
     * @param  int $id 抽出したいID
     * @return array(row_names => values) カラム名をキーにした連想配列
     */
    public function select_tyuumonsha_by_id($id){
        $sql = "SELECT * FROM user, tyuumonsha";
        $sql .= " WHERE user.user_id = tyuumonsha.user_id";
        $sql .= " AND user_yuukou_flg = true";
        $sql .= " AND user_kubun = '". USER_KUBUN_ORDERER. "'";
        $sql .= " AND user.user_id = ?";

        $param = array($id);

        $arr_result = $this->select_table($sql, $param);

        return count($arr_result) > 0 ? $arr_result[0] : null;
    }

    /**
     * 引数で指定されたIDの、承認表と承認マスタを結合したものを降順で返す
     * 承認マスタIDをキーにセレクトするので、複数行抽出する可能性あり
     * @param  int $sm_id 抽出したい承認マスタのID
     * @return array(array(row_names => values)) カラム名をキーにした連想配列が順番に入った配列
     */
    public function select_all_shounin_by_id($sm_id){
        $sql = "SELECT * FROM shounin_master, shounin";
        $sql .= " WHERE shounin_master.sm_id = shounin.sm_id";
        $sql .= " AND shounin_master.sm_id = ?";
        $sql .= " ORDER BY s_id DESC";

        $param = array($sm_id);

        $arr_result = $this->select_table($sql, $param);

        return $arr_result;
    }

        /**
     * 承認マスタから注文IDで検索する
     * 複数行抽出する可能性があるので、承認マスタIDをキーに降順で検索して格納している
     * @param  int $tm_id 注文ID
     * @return array(array(row_names => values)) カラム名をキーにした連想配列が順番に入った配列
     */
    public function select_shounin_master_by_tm_id($tm_id){
        $sql = "SELECT * FROM shounin_master";
        $sql .= " WHERE tm_id = ?";
        $sql .= " AND sm_sakujo_flg = false";
        $sql .= " ORDER BY sm_id DESC";

        $param = array($tm_id);

        $arr_result = $this->select_table($sql, $param);

        return $arr_result;
    }

    /**
     * 引数で指定されたIDの、承認表と承認マスタを結合したものを返す
     * 承認IDをキーにセレクトするので、単数行のみ
     * @param  int $s_id 抽出したい承認表のID
     * @return array(row_names => values)|null カラム名をキーにした連想配列
     */
    public function select_shounin_by_id($s_id){
        $sql = "SELECT * FROM shounin_master, shounin";
        $sql .= " WHERE shounin_master.sm_id = shounin.sm_id";
        $sql .= " AND shounin.s_id = ?";

        $param = array($s_id);

        $arr_result = $this->select_table($sql, $param);

        return count($arr_result) > 0 ? $arr_result[0] : null;
    }


    /**
     * 承認マスタに登録後、承認表にも1行挿入する
     * @param  int          $tm_id          注文書のID
     * @param  int          $user_id        申請者のID
     * @param  int          $destination_id 送信先のID
     * @param  string       $comment        コメント
     * @throws PDOException $e
     * @see    DB_Manager::insert_add_shounin
     */
    public function insert_new_shounin($tm_id, $user_id, $destination_id, $comment){
        $sql = "INSERT INTO shounin_master(sm_id, tm_id, ";
        $sql .= "sm_sinseisha_id, sm_last_shounin_flg, sm_sakujo_flg) ";
        $sql .= "VALUES('', :tm_id, :sinseisha_id, false, false)";

        $stmt = $this->prepare($sql);

        $this->beginTransaction();
        try{

            $stmt->bindValue(':tm_id',          $tm_id,   PDO::PARAM_INT);
            $stmt->bindValue(':sinseisha_id',   $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $sm_id = $this->lastInsertId();

            $this->insert_add_shounin($sm_id, $user_id, $destination_id, $comment, false, false, false);

            $this->commit();
        }
        catch(PDOException $e){
            $this->rollBack();
            throw $e;
        }
    }

    /**
     * 承認表に、引数で与えられたデータを挿入する
     * @param  int          $sm_id          承認マスタのID
     * @param  int          $sender_id      送信者のID
     * @param  int          $destination_id 送信先のID
     * @param  string       $comment        コメント
     * @param  boolean      $shounin_flg    承認フラグ
     * @param  boolean      $sasimodosi_flg 差し戻しフラグ
     * @param  boolean      $tran_flg       [任意]トランザクションを利用するかのフラグ
     * @throws PDOException $e
     */
    public function insert_add_shounin($sm_id, $sender_id, $destination_id, $comment, $shounin_flg, $sasimodosi_flg, $tran_flg = true){
        $sql = "INSERT INTO shounin(s_id, sm_id, s_moto, s_saki, ";
        $sql .= "s_comment, s_shounin_flg, s_sasimodosi_flg) ";
        $sql .= "VALUES('', :sm_id, :sender_id, :destination_id, ";
        $sql .= ":comment, :shounin_flg, :sasimodosi_flg)";

        // boolean型の変数はtrue='1'／false=''として評価されるのでstringに変換しておく
        // $sasimodosi_flg = $this->convertBoolToString($sasimodosi_flg);
        // $shounin_flg    = $this->convertBoolToString($shounin_flg);

        $stmt = $this->prepare($sql);

        try{
            $tran_flg && $this->beginTransaction();   // フラグがtrueならトランザクションを開始する
            $stmt->bindValue(':sm_id',          $sm_id,          PDO::PARAM_INT);
            $stmt->bindValue(':sender_id',      $sender_id,      PDO::PARAM_INT);
            $stmt->bindValue(':destination_id', $destination_id, PDO::PARAM_INT);
            $stmt->bindValue(':comment',        $comment,        PDO::PARAM_STR);
            $stmt->bindValue(':shounin_flg',    $shounin_flg,    PDO::PARAM_INT);
            $stmt->bindValue(':sasimodosi_flg', $sasimodosi_flg, PDO::PARAM_INT);

            $stmt->execute();

            $tran_flg && $this->commit();

        }
        catch(PDOException $e){
            $tran_flg && $this->rollBack();
            throw $e;
        }
    }

    /**
     * 承認表の与えられたIDの行のフラグを、与えられた引数で更新する
     * @param  int     $id             変更する行のID
     * @param  boolean $shounin_flg
     * @param  boolean $sasimodosi_flg
     * @throws PDOException $e
     */
    public function update_shounin_flag($id, $shounin_flg, 
        $sasimodosi_flg){
        $sql = "UPDATE shounin SET ";
        $sql .= "s_shounin_flg = :shounin_flg, ";
        $sql .= "s_sasimodosi_flg = :sasimodosi_flg ";
        $sql .= "WHERE s_id = :id";

        $stmt = $this->prepare($sql);

        $this->beginTransaction();
        try{

            $stmt->bindValue(':shounin_flg',    $shounin_flg,    PDO::PARAM_INT);
            $stmt->bindValue(':sasimodosi_flg', $sasimodosi_flg, PDO::PARAM_INT);
            $stmt->bindValue(':id',             $id,             PDO::PARAM_INT);

            $stmt->execute();

            $this->commit();
        }
        catch(PDOException $e){
            // トランザクション取り消し
            $this->rollBack();
            throw $e;
        }
    }

    /**
     * 承認マスタの与えられたIDの行のフラグを、与えられた引数で更新する
     * @param  int     $id               変更する行のID
     * @param  boolean $last_shounin_flg
     * @param  boolean $sakujo_flg
     * @throws PDOException $e
     */
    public function update_shounin_master_flag($id, $last_shounin_flg, 
        $sakujo_flg){
        $sql = "UPDATE shounin_master SET ";
        $sql .= "sm_last_shounin_flg = :last_shounin_flg, ";
        $sql .= "sm_sakujo_flg = :sakujo_flg ";
        $sql .= "WHERE sm_id = :id";

        // $sakujo_flg       = $this->convertBoolToString($sakujo_flg);
        // $last_shounin_flg = $this->convertBoolToString($last_shounin_flg);

        $stmt = $this->prepare($sql);

        $this->beginTransaction();
        try{

            $stmt->bindValue(':last_shounin_flg', $last_shounin_flg, PDO::PARAM_INT);
            $stmt->bindValue(':sakujo_flg',       $sakujo_flg,       PDO::PARAM_INT);
            $stmt->bindValue(':id',               $id,               PDO::PARAM_INT);

            $stmt->execute();

            $this->commit();
        }
        catch(PDOException $e){
            // トランザクション取り消し
            $this->rollBack();
            throw $e;
        }
    }

    /** 
     * ユーザIDから名前を検索する
     * @param  int    $user_id 
     * @return string ユーザ名
     */
    public function get_name_by_id($user_id){
        $sql = "SELECT user_name FROM user WHERE user_id = ?";
        $param = array($user_id);

        $arr_result = $this->select_table($sql, $param);
        return $arr_result[0]['user_name'];
    }

    /**
     * 引数で指定された承認表、承認マスタをそれぞれクラス変数にセットする
     * @param int $tm_id   
     * @see   DB_Manager::select_shounin_master_by_tm_id, DB_Manager::select_all_shounin_by_id
     */
    public function set_shounin_arr($tm_id){
        $arr = $this->shounin_master_arr = $this->select_shounin_master_by_tm_id($tm_id);

        if($arr != array()){
            $this->shounin_arr = $this->select_all_shounin_by_id($arr[0]['sm_id']);
        }
    }

    /**
     * 与えられたユーザIDで指定されたユーザが承認申請を受けているかを調べる
     * 承認申請を受けていなかったり、注文IDによって行が抽出できなかったりするとfalseを返す
     * 事前に DBManager::set_shounin_arr() を実行する必要がある
     * @param  int $user_id 
     * @return array(row_names => values)|false 列名がキーの配列かfalse
     */
    public function get_my_shounin_by_id($user_id){
        if($this->shounin_master_arr != array() && $this->shounin_arr != array()){
            $latest_shounin_arr = $this->shounin_arr[0];
            $latest_s_saki = $latest_shounin_arr['s_saki'];

            if($latest_s_saki == $user_id){
                return $latest_shounin_arr;
            }
        }

        return false;
    }

    /**
     * セットされている承認マスタを返す
     * @return array(row_names => values) 列名がキーの配列
     */
    public function get_shounin_master(){
        $arr = $this->shounin_master_arr;
        if($arr != array()){
            return $arr;
        }
    }

    /**
     * 承認フローが完了しているかを確認する
     * 完了していたらtrue、それ以外はfalseを返す
     * 事前に DBManager::set_shounin_arr() を実行する必要がある
     * @return boolean true|false
     */
    public function check_finished_shounin(){
        $arr = $this->shounin_master_arr;
        if($arr != array()){
            if($arr[0]['sm_last_shounin_flg']){
                return true;
            }
        }

        return false;
    }

    /**
     * 承認フローが引数で指定されたユーザによって作られたかを確認する
     * 一致したらtrue、それ以外はfalseを返す
     * 事前に DBManager::set_shounin_arr() を実行する必要がある
     * @param  int     $user_id 
     * @return boolean true|false
     */
    public function check_created_shounin_by_id($user_id){
        $arr = $this->shounin_master_arr;
        if($arr != array()){
            if($arr[0]['sm_sinseisha_id'] == $user_id){
                return true;
            }
        }

        return false;
    }

    public function check_created_tyuumon_by_id($tm_id, $user_id){
        $arr = $this->select_tyuumon_by_id($tm_id);
        if($arr['user_id'] == $user_id){
            return true;
        }
        else{
            return false;
        }
    }

    public function check_sasimodosi_shounin_by_id($user_id){
        $arr = $this->shounin_arr;
        if($arr != array()){
            if($arr[0]['s_sasimodosi_flg']){
                return true;
            }
        }
        return false;
    }

    public function check_empty_shounin_master(){
        if($this->shounin_master_arr == array()){
            return true;
        }
        else{
            return false;
        }
    }

}
?>