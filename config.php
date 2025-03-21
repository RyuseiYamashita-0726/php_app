<?php

ini_set('display_errors',1);
//スクリプトの実行時にphp.ini(PHPの設定を管理する構成ファイル)
//の設定を変更する関数エラーが起きたらブラウザに表示させるために使う。

ini_set('display_startup_errors',1);
//PHPが起動する際のエラーを表示する関数。

error_reporting(E_ALL);
//どの種類のエラーを表示、またはログに記録するかを設定する関数。
//(E_ALL)だと全てのエラー、警告、注意、推奨されない機能などを
//含む全てのエラーメッセージが表示される。

set_error_handler('errorHandler');
//独自のエラーハンドリング(エラーに対して何を行うか)を設定できる関数。

function errorHandler($errNo,$errStr,$errFile,$errLine)
{
    if ($errNo === E_NOTICE || $errNo === E_WARNING) {
        $errTitle = $errNo === E_NOTICE ? 'Notice' : 'Warning';
        $escapedErrStr = htmlspecialchars($errStr);
        $escapedErrFile = htmlspecialchars($errFile);

        echo '<b>' . $errTitle . '</b>: ' . $escapedErrStr . ' in <b>' . $escapedErrFile . '</b> on line <b>' . $errLine . '</b>';
        exit;
    }
    
    return false;
}
//↑set_error_handler関数に渡す引数を定義

define('DSN', 'mysql:dbname=php_lesson;host=localhost;unix_socket=/tmp/mysql.sock');
//define関数でDSN定数を宣言し、第二引数で接続に必要な情報を渡す。
//DSNはデータソースネームの略。
//書き方が決まっている？ 
//mysql:dbname=php_lesson; → データベースの種類:dbname=任意のDB名
//host=localhost; → host=データベースサーバーのホスト名
//unix_socket=/tmp/mysql.sock → LinuxやmacOSではソケットを
//使用してMYSQLと通信する事がある。そのパスを明記。

define('DB_USER', 'root');
//define関数でDB_USER定数を定義。rootを代入する。

define('DB_PASSWORD', 'Ryusei726');
//define関数でDB_PASSWORD定数を定義。Ryusei726を代入する。



