<?php
session_start();
include '../src/RegistrationController.php';
include '../src/Authorization.php';

$registrationController = new RegistrationController();

$login = $_POST['login'];
$password = $_POST['password'];

$error_code = $registrationController->addUser($login, $password, Role::WORKER);

session_start();

$authorization = new Authorization();
$authorization->protect_endpoint(0);

if ($error_code == 0) {
    $_SESSION['login'] = $login;
    $_SESSION['password'] = $password;
    $_SESSION['permission'] = Role::WORKER;
    header("Location: ./users_list.php");
    exit();
} else {
    if ($error_code == 1) {
        echo "Login zajęty, spróbuj ponownie\n";
    } else if ($error_code == 2) {
        echo "Login pusty, spróbuj ponownie\n";
    } else if ($error_code == 3) {
        echo "Login jest za krótki, spróbuj ponownie\n";
    } else if ($error_code == 4) {
        echo "Hasło puste, spróbuj ponownie\n";
    } else if ($error_code == 5) {
        echo "Spacja jest niedozwolonym znakiem, spróbuj ponownie\n";
    }

    echo "<form action='./registration.html'>
              <input type='submit' value='Wróć' />
          </form>";
}