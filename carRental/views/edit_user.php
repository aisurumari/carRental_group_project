<?php
include '../src/Authorization.php';
session_start();
//protect endpoint
$authorization = new Authorization();
$authorization->protect_endpoint(0);

echo "<html lang='pl'>";
    echo "<head>";
        echo "<link rel='stylesheet' href='css/users_list.css' media='screen'>";
    echo "</head>";
    echo "<body>";
        echo "<h1>Edytujesz użytkownika user_id = " . $_SESSION['user_id'] . "</h1>";
        echo "<form action='users_list.php?form=true' method='post'><table class='center'>
                            <tr><th>user_id</th><th>login</th><th>hasło</th><th>poziom uprawnień</th></tr>
                            <tr><td>" . $_SESSION['user_id']  . "</td>
                            <td><input type='text' id='new_login' name='new_login' value='" . $_SESSION['login'] . "'></td>
                            <td><input type='text' id='new_password' name='new_password' value='". $_SESSION['password'] . "'></td>
                            <td><input type='text' id='new_permission_level' name='new_permission_level' value='". $_SESSION['permission_level'] . "'></td>
                            <td><input type='submit' value='Zatwierdź'></td>
                            <td><a href='./users_list.php'>Odrzuć</a></td>
                        </tr></table></form>";
echo "</body>";
echo "</html>";
?>
<a href="../index.php" target="_self">Menu</a>
