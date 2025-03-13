<?php
require_once('connection.php');

function createData($post)
{
    createTodoData($post['content']);
}
//store.phpで使用する関数を定義。cureateTodoData関数はINSERT操作
//をする関数。
function getTodoList()
{
    return getALLRecords();
}

function getSelectedTodo($id)
{
    return getTodoTextById($id);
}
