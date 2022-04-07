<?php
session_start();
include "../src/LoginController.php";
include "../src/DatabaseControllerJR.php";
if(isset($_SESSION['login'])){
    header('Location: my_account.php');
}

$loginController = new LoginController();
$databaseController = new DatabaseControllerJR();
$connection = $databaseController->connect();
$isLogged = $loginController->login($_POST['login'],$_POST['password'],$connection);
if($isLogged) {
    header('Location: my_account.php');
}else {
    echo("Nie zalogowany");
}
?>