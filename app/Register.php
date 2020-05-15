<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';
//get fields
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
//get fields
$_SESSION['login'] = $login;
$_SESSION['password'] = $password;
$_SESSION['email'] = $login;

// PDO
try
{
$db = new PDO('mysql:host=localhost;dbname=Simple_chat','root','');
$db->query("INSERT INTO users (login,password,email) VALUES ('$login','$password','$email') ");
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

