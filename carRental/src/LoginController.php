<?php
class LoginController {

    function login($login, $password,$connection) {
        $query = "SELECT * FROM users WHERE login='$login' AND password='$password'";
        $queryResult = $connection->query($query);
        if($queryResult->rowCount()>0) {

            $userData = $queryResult->fetch(PDO::FETCH_ASSOC);

            $_SESSION['login'] = $userData['login'];
            $_SESSION['password'] = $userData['password'];
            $_SESSION['permission_level'] = $userData['permission_level'];
//            $connection->close();
            return true;
        }else {
//            $connection->close();
            return false;
        }

    }

}