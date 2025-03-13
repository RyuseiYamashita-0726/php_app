<?php
require_once('config.php');
//()内のファイルを一度だけ読み込む関数。

function connectPdo()
{
    try{
        return new PDO(DSN,DB_USER,DB_PASSWORD);
        }catch(PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}

//try catch文を使って、PDOクラスをインスタンス化したものを
//$eに代入し、getMessage関数を呼び出して、処理を終了している。

//PDOクラス(PHP Data Objects)はDB接続に必要な
//DB抽象化ライブラリ。異なるDB(mysql,postgresql,sqliteなど)
//に対して、共通のインタフェースで操作を行う事が出来る。

//try catch文を使う理由は、発生する可能性のある例外を適切に処理するため。
//そのままインスタンス化して使用するとエラーを起こしたときに、
//単純にfalseと返す。？


function createTodoData($todoText)
{
    $dbh = connectPdo();
     //PDOをインスタンス化、$dbhはDatabase Handleの略。
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    //↑ 引数$todoTextに格納されたテキストをINSERT文に結合。
    $dbh->query($sql);
    //PDOクラスのクエリ関数を使って、DBを操作する。
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
    $sql = 'update todos set cpntent = "' . $post['content'] . '"where id = ' . $post['id'];
    $dbh->query($sql);
}

function getTodoTexteById($id)
{
    $dbh = connectPdo();
    $sql = 'select * from todos where deleted_at is null and id = $id';
    $data = $dbh->query($sql)->fetch();
    return $data['content'];
}

?>