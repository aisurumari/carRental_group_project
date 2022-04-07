<?php


class DatabaseControllerJR
{
    function connect($host = 'localhost', $username = 'root', $password = 'pwdpwd', $dbName = 'carrental')
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'carrental';

        return new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    }
}
