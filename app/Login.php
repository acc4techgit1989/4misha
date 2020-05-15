<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';
$auth = new Auth();
$res = $auth->login($_POST['login'], $_POST['password']);

// redirect
header('Location: /view/index.php');
exit;
// redirect