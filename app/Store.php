<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';
//get fields
$category_name = $_POST['category_name'];
$login = $_SESSION['login'];
$text_of_comment = $_POST['text_of_comment'];
$category_id = $_POST['category_id'];

// PDO
try
{
    $db = new PDO('mysql:host=localhost;dbname=Simple_chat','root','');
    foreach($db->query("SELECT id FROM users WHERE login='$login' ") as $row)
    {
         $row;
    };
    
    $db->query("INSERT INTO categoryes (category_name,user_id) VALUES ('$category_name','$row[0]') ");
    $db->query("INSERT INTO comments (category_id,user_id,text_of_comment) VALUES ('$category_id','$row[0]','$text_of_comment') ");
    $db = null;
}catch(PDOException $e)
{
    print $e->getMessage();
    exit;
}
// PDO

// redirect
header('Location: /view/index.php');
exit;
// redirect 