<?php
require_once('config.php');

function connectPdo()
{
    try{
        return new PDO(DSN,DB_USER,DB_PASSWORD);
    }catch(PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}




function createTodoData($todoText)
{
    $dbh = connectPdo();

    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    
    $dbh->query($sql);
    
}

function getAllRecords()
{
    $dbh = connectPdo();

    $sql = 'select * from todos where deleted_at is null';
    
    return $dbh->query($sql)->fetchAll();
    
}

function updateTodoData($spot)
{
    $dbh = connectPdo();
    
    $sql = 'update todos set content = "' . $spot['content'] .'" where id = ' . $spot['id'];
   
    $dbh->query($sql);
}


?>