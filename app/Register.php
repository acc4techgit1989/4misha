<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';
$auth = new Auth();
$userId = $auth->register($_POST['login'], $_POST['password'], $_POST['email']);
if($userId) {
    $auth->loginById($userId);
}
// redirect
header('Location: /view/index.php');
exit;
// redirect

