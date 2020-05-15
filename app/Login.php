<?php
session_start();

//get fields
$login = $_POST['login'];
$password = $_POST['password'];

// PDO
try
{
    $db = new PDO('mysql:host=localhost;dbname=Simple_chat','root','');
    foreach($db->query("SELECT * FROM users WHERE 'login'='$login' 'password'='$password'  ") as $user)
    {
     $_SESSION['login'] = $user['login'];   
     $_SESSION['password'] = $user['password'];   
    }
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