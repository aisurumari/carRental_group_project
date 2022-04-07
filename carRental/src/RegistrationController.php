<?php

include '../src/DatabaseControllerMS.php';
include '../src/Roles.php';

class RegistrationController
{
    private DatabaseControllerMS $db_controller;
    private PDO $db_conn;

    function __construct() {
        $this->db_controller = new DatabaseControllerMS();
        $this->db_conn = $this->db_controller->connect();
    }

    private function validate($login, $password): int
    {
        if (is_null($login))
            return 2;

        if (strlen($login) < 4)
            return 3;

        if (is_null($password) || strlen($password) == 0)
            return 4;

        if (strpos($login, ' ') != False || strpos($password, ' ') != False)
            return 5;

        $query = 'SELECT login FROM users';
        $statement = $this->db_conn->prepare($query);
        $statement->execute();

        $data = $statement->fetchAll();

        $unavailable_logins = [];

        foreach ($data as $d)
        {
            array_push($unavailable_logins, $d['login']);
        }

        if (in_array($login, $unavailable_logins))
        {
            return 1;
        }

        return 0;
    }

    function addUser($login, $password, $permission_level): int
    {
        $validation_code = $this->validate($login, $password);

        if ($validation_code != 0)
            return $validation_code;

        $this->db_controller->add_record(
            $this->db_conn,
            'users',
            'DEFAULT', $login, $password, $permission_level
        );

        return 0;
    }
}
