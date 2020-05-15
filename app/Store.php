<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';
$auth = new Auth();
if($auth->isLoggedIn()) {
    $category_name = $_POST['category_name'];
    $login = $auth->user('login');
    $text_of_comment = $_POST['text_of_comment'];
    $category_id = $_POST['category_id'];

}
//get fields

// PDO
try
{
    $db = DB::getInstance();

//     $stmt = $db->prepare('INSERT INTO categoryes (category_name,user_id) VALUES (?,?,?)');
//     $stmt->execute([$category_name, $auth->user('id')]);

    $stmt = $db->prepare('INSERT INTO comments (category_id,user_id,text_of_comment) VALUES (?,?,?)');
    $stmt->execute([$category_id, $auth->user('id'), $text_of_comment]);
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