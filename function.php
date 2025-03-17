<?php
require_once('connection.php');

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