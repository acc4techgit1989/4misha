<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';

class Auth
{
    private $login;
    private $password;
    
    public function __construct($login ,$password)
    {
        $this->login = $login;
        $this->password = $password;
    }
    public function auth($login,$password)
    {
        if($login == $this->login && $password == $this->password)
        {
            $_SESSION['isAuth'] = true;
            $_SESSION['login'] = $login;
            return $_SESSION['isAuth'];
        }else
        {
            $_SESSION['isAuth'] = false;
            return $_SESSION['isAuth'];
        }
    }
    public function isAuth()
    {
        if(isset($_SESSION['isAuth']))
        {
            return $_SESSION['isAuth'];
        }else{ return false;}
    }
    public function getLogin()
    {
        if($this->isAuth())
        {
            return $_SESSION['login'];
        }
    }
    public function out()
    {
        $_SESSION = [];
        session_destroy();
    }
    
}