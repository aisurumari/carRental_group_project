<?php
session_start();
include '../src/DatabaseControllerMS.php';
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(0);

$query = 'SELECT * FROM users ORDER BY permission_level ASC';

$db_controller = new DatabaseControllerMS();
$db_conn = $db_controller->connect();


if (isset($_GET['id'])) {
    $db_controller->delete_record($db_conn, 'users', 'user_id', $_GET['id']);
}

if (isset($_GET['form'])) {
    if (validate($db_conn, $_SESSION['user_id'], $_POST['new_login'], $_POST['new_password'], $_POST['new_permission_level'])) {
        $db_controller->edit_record(
            $db_conn,
            'users',
            $_SESSION['user_id'],
            $_POST['new_login'],
            $_POST['new_password'],
            $_POST['new_permission_level']
        );
        echo '<script>alert("Poprawnie zmodyfikowano")</script>';
    } else {
        echo '<script>alert("Podane dane są niepoprawne...")</script>';
    }
}

$radio_button_all = "<input type='radio' id='all' name='perms' value='all' checked>";
$radio_button_admin = "<input type='radio' id='admin' name='perms' value='admin'>";
$radio_button_worker = "<input type='radio' id='worker' name='perms' value='worker'>";
$radio_button_user = "<input type='radio' id='user' name='perms' value='user'>";

if (isset($_GET['perms'])) {
    if ($_GET['perms'] == 'all') {
        $query = 'SELECT * FROM users ORDER BY permission_level ASC';
    } else {
        $radio_button_all = str_replace(' checked', '', "<input type='radio' id='all' name='perms' value='all' checked>");
        if ($_GET['perms'] == 'admin') {
            $query = 'SELECT * FROM users WHERE permission_level= 0';
            $radio_button_admin = str_replace('>', ' checked>', "<input type='radio' id='admin' name='perms' value='admin'>");
        }
        else if ($_GET['perms'] == 'worker') {
            $query = 'SELECT * FROM users WHERE permission_level = 1';
            $radio_button_worker = str_replace('>', ' checked>', "<input type='radio' id='worker' name='perms' value='worker'>");
        }
        else if ($_GET['perms'] == 'user') {
            $query = 'SELECT * FROM users WHERE permission_level = 2';
            $radio_button_user = str_replace('>', ' checked>', "<input type='radio' id='user' name='perms' value='user'>");
        }
    }
}

$statement = $db_conn->prepare($query);
$statement->execute();

$result = $statement->fetchAll();

echo "<html lang='pl'>";
    echo "<head>";
        echo "<link rel='stylesheet' href='css/users_list.css' media='screen'>";
    echo "</head>";
    echo "<body>";
        echo "<h1>Lista użytkowników</h1>";
        echo "<form style='text-align: center' method='get' action='users_list.php'><div>";
        echo $radio_button_all;
        echo "<label for='all'>Wszystkie</label></div><div>";
        echo $radio_button_admin;
        echo "<label for='admin'>Administrator</label></div><div>";
        echo $radio_button_worker;
        echo "<label for='worker'>Pracownik</label></div><div>";
        echo $radio_button_user;
        echo "<label for='user'>Użytkownik</label></div>";
        echo "<input type='submit' value='Filtruj'>
              </div></form>";
        echo "<table class='center'>";
            echo "<tr><th>user_id</th><th>login</th><th>hasło</th><th>poziom uprawnień</th></tr>";
            foreach ($result as $row) {
                if(isset($_GET['idmod']) && $_GET['idmod'] == $row['user_id']) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['permission_level'] = $row['permission_level'];
                    header("Location: ./edit_user.php");
                    exit();
                } else {
                    echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['login'] . "</td>
                    <td>" . $row['password'] . "</td>
                    <td>" . $row['permission_level'] . "</td>
                    <td><a href='users_list.php?id=" . $row['user_id'] . "'>Usuń</a></td>
                    <td><a href='users_list.php?idmod=" . $row['user_id'] . "'>Modyfikuj</a></td>
                  </tr>";
                }
            }
        echo "</table>";
    echo "</body>";
echo "</html>";

function validate($db_conn, $user_id, $login, $password, $permission_level): bool
{
    if (strlen($password) == 0 || strlen($login) == 0 || strlen($login) < 4 || strpos($login, ' ') != False ||
        strpos($password, ' ') != False ||
        $permission_level != 0 && $permission_level != 1 && $permission_level != 2) {
        return False;
    }

    $query = 'SELECT login FROM users WHERE user_id != :user_id';
    $statement = $db_conn->prepare($query);
    $statement->execute([':user_id' => $user_id]);

    $data = $statement->fetchAll();

    $unavailable_logins = [];

    foreach ($data as $d) {
        array_push($unavailable_logins, $d['login']);
    }

    if (in_array($login, $unavailable_logins)) {
        return False;
    }

    return True;
}
?>
<a href="../index.php" target="_self">Menu</a>