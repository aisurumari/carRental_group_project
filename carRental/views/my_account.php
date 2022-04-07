<?php
include '../src/Authorization.php';
session_start();
$authorization = new Authorization();
$authorization->protect_endpoint(2);

$login = $_SESSION['login'];
$password = $_SESSION['password'];
$permission = $_SESSION['permission_level'];


switch($permission) {
    case 0:
        $account = 'Administrator';
        break;

    case 1:
        $account = 'Pracownik';
        break;

    case 2:
        $account = 'Użytkownik';
        break;

    case 3:
        $account = 'Gość';
        break;
}

echo "<html lang='pl'>";
    echo "<head>";
        echo "<link rel='stylesheet' href='css/my_account.css' media='screen'>";
    echo "</head>";
    echo "<body>";
        echo "<h1>Moje konto</h1>";
        echo "<table class='center'>";
            echo "<tr><td>Login</td><td>". $login . "</td></tr>";
            echo "<tr><td>Hasło</td><td>" . $password . "</td></tr>";
            echo "<tr><td>Typ konta</td><td>" . $account . "</td></tr>";
         echo "</table>";
     echo "</body>";
echo "</html>";
echo '<a href="../index.php" target="_self">Menu</a>';