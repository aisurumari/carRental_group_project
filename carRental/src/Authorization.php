<?php


class Authorization
{
    public function is_authorized($expected_permission_level)
    {
        if ($_SESSION['permission_level'] <= $expected_permission_level) {
            return true;
        } else {
            return false;
        }
    }

    public function protect_endpoint($expected_permission_level, $redirect1 = 'Location: ../views/login.html',
                                     $redirect2 = 'Location: my_account.php') {
            if(!isset($_SESSION['login'])) {
                header($redirect1);
            }
            if($_SESSION['permission_level'] > $expected_permission_level) {
                header($redirect2);
            }
        }
}
