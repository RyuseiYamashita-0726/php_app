<?php
require_once('connection.php');
session_start();

function setToken()
{
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));

}

function checkToken($token)
{
    if(empty($_SESSION['token']) || ($_SESSION['token'] !== $token)){
        $_SESSION['err'] = '不正な操作です';
        redirecToPostedPage();
    }
}

function unsetError()
{
    $_SESSION['err'] = '';
}

function redirectToPostedPage()
{
    header('Location: ' . $_SERVER['http_REFERER']);
    exit;
}



function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
//関数名が長いのでeに変えている？、引数多いし。

function createData($post)
{
    createTodoData($post['content']);
}
//store.phpで使用する関数を定義。createTodoData関数はINSERT操作
//をする関数。
function getTodoList()
{
    return getALLRecords();
}

function getSelectedTodo($id)
{
    return getTodoTextById($id);
}

function savePostedData($post)
{
    checkToken($post['token']);
    $path = getRefererPath();
    switch ($path){
        case '/new.php':
            createTodoData($post['content']);
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php':
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }
}

function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}
