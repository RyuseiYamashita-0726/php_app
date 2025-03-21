<?php
require_once('config.php');
//()内のファイルを一度だけ読み込む関数。

function connectPdo()
/*この関数の目的は、PDOクラスのインスタンスを返すこと。*/
{
    try{
        return new PDO(DSN,DB_USER,DB_PASSWORD);
        }//ここまでで、インスタンスを返す処理。
        catch(PDOException $e) {
        /*もし失敗した場合、catch{}内の処理を実行。PDOExceptionがthrowされるので、$eに代入してメソッドを使える状態にする。*/
        echo $e->getMessage();
        /*getMessageメソッドを呼び出す。*/
        exit();
        //処理終了。
    }
}

//PDOクラス(PHP Data Objects)はDB接続に必要な
//DB抽象化ライブラリ。異なるDB(mysql,postgresql,sqliteなど)
//に対して、共通のインタフェースで操作を行う事が出来る。

function createTodoData($todoText)
{
    $dbh = connectPdo();
     //PDOをインスタンス化、$dbhはDatabase Handleの略。
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR);
    $stmt->execute();
}

function getAllRecords()
{
    $dbh = connectPdo();

    $sql = 'select * from todos where deleted_at is null';
    //削除されていないデータを取得。
    return $dbh->query($sql)->fetchAll();
    //PDOクラスのクエリ関数を使って、DBを操作する。
    //fetchAll関数は取得した全ての行を配列として返す関数。

}

function updateTodoData($post)
{
    $dbh = connectPdo();
    $sql = 'update todos set content = :todoText where id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR);
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT);
    //bindValue()が攻撃を防げる理由は、入力される内容を「値」としてSQL文に組み込むことで
    //ユーザーが改ざんできないようにする。
    $stmt->execute();
}

function getTodoTextById($id)
{

    $dbh = connectPdo();
    $sql = 'select * from todos where deleted_at is null and id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    //var_dump($id);
    //exit;
    $stmt->execute();
    $data = $stmt->fetch();
    //fetch(PDO::FETCH_ASSOC)はPDOから受け取ったデータを連想配列として返すメソッド。

    return $data['content'];
}

function deleteTodoData($deletId)
{
    $dbh = connectPDO();
    $now = date('Y-m-d H:i:s');
    $sql = 'update todos set deleted_at = :now where id = :deletId';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':now', $now, PDO::PARAM_STR);
    $stmt->bindValue(':deletId', $deletId, PDO::PARAM_INT);
    $stmt->execute();
}

?>