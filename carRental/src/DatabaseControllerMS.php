<?php


class DatabaseControllerMS
{
    function connect($host = 'localhost', $username = 'root', $password = '', $dbName = 'carrental'): PDO
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'carrental';

        return new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    }

    function add_record($conn, $db_name, ...$values)
    {
        $query = 'INSERT INTO ' . $db_name .' VALUES (';
        $data = [];

        $it = 0;
        foreach ($values as $value) {
            $data += [':arg' . $it => $value];
            $query .= ':arg' . $it . ', ';
            $it += 1;
        }

        $query = substr($query, 0, -2);
        $query .= ')';

        $statement = $conn->prepare($query);
        $statement->execute($data);
    }

    function delete_record($conn, $db_name, $db_key, $compare_key)
    {
        $query = 'DELETE FROM ' . $db_name . ' WHERE ' . $db_key . '=';
        $query .= ':' . $db_key;

        $statement = $conn->prepare($query);
        $statement->execute([
            ':' . $db_key => $compare_key
        ]);
    }

    function edit_record($conn, $db_name, $user_id, $new_login, $new_password, $new_permission_level)
    {
        $query = 'UPDATE ' . $db_name .' SET login = :login, password = :password, permission_level = :permission_level WHERE user_id = :user_id';

        $statement = $conn->prepare($query);
        $statement->execute([
            ':login' => $new_login,
            ':password' => $new_password,
            ':permission_level' => $new_permission_level,
            ':user_id' => $user_id
        ]);
    }
}