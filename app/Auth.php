<?php
session_start();
require   __DIR__. '/../vendor/autoload.php';

class Auth
{
//     private $login;
//     private $password;

//     public function __construct($login ,$password)
//     {
//         $this->login = $login;
//         $this->password = $password;
//     }
//     public function auth($login,$password)
//     {
//         if($login == $this->login && $password == $this->password)
//         {
//             $_SESSION['isAuth'] = true;
//             $_SESSION['login'] = $login;
//             return $_SESSION['isAuth'];
//         }else
//         {
//             $_SESSION['isAuth'] = false;
//             return $_SESSION['isAuth'];
//         }
//     }
//     public function isAuth()
//     {
//         if(isset($_SESSION['isAuth']))
//         {
//             return $_SESSION['isAuth'];
//         }else{ return false;}
//     }
//     public function getLogin()
//     {
//         if($this->isAuth())
//         {
//             return $_SESSION['login'];
//         }
//     }
//     public function out()
//     {
//         $_SESSION = [];
//         session_destroy();
//     }

    private $userId = false;
    private $userData = null;
    public function __construct()
    {
        $this->userId = isset($_SESSION['user_id']);
    }

    public function isLoggedIn()
    {
        return !empty($this->userId);
    }

    public function user($column = null)
    {
        if(!$this->isLoggedIn()) {
            return false;
        }
        if(!$this->userData) {
            $this->userData = $this->getUserBy($this->userId);
        }
        return $column ? $this->userData[$column] : $this->userData;
    }

    protected function getUserBy($value, $column = 'id')
    {
        $stmt = DB::getInstance()->prepare('SELECT * from users WHERE '.$column.' = ? LIMIT 1');
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);;
    }
    public function login($login, $password)
    {
        $user = $this->getUserBy($login, 'login');
        if(empty($user)) {
            //Invalid login
            return false;
        }
        if($user['pawssword'] != $this->encrypt($password)) {
            //invalid pass
            return false;
        }
        $this->saveAuth($user['id']);
        return true;
    }

    public function logout()
    {
        $this->saveAuth();
    }

    public function loginById($id = null)
    {
        $this->saveAuth($id);
    }

    protected function saveAuth($id = null) {
        if(empty($id)) {
            unset($_SESSION['user_id']);
            $this->userId = false;
            $this->userData = null;
        } else {
            $this->userId = $id;
            $_SESSION['user_id'] = $id;
        }
        return $this;
    }

    public function register($login, $password, $email)
    {
        $conn = DB::getInstance();

        $user = $this->getUserBy($login, 'login');
        if($user) {
            //login exists
            return false;
        }
        $stmt = $conn->prepare('insert into users (login, password, email) VALUES (?,?,?)');
        $stmt->execute([$login, $this->encrypt($password), $email]);

        $userId = $conn->lastInsertId();
        $this->saveAuth($userId);
        return true;
    }

    private function encrypt($string)
    {
        return md5($string);
    }
}