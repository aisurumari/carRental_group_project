<?php

class DatabaseControllerMB
{
    function connect($host = 'localhost', $username = 'root', $password = '', $dbName = 'carrental'): PDO
    {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbName = 'carrental';

        return new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    }

    function add_record($conn, $table_name, ...$values)
    {
        $query = 'INSERT INTO ' . $table_name .' VALUES (';
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

    function delete_record($conn, $table_name, $db_key, $compare_key)
    {
        $query = 'DELETE FROM ' . $table_name . ' WHERE ' . $db_key . '=';
        $query .= ':' . $db_key;

        $statement = $conn->prepare($query);
        $statement->execute([
            ':' . $db_key => $compare_key
        ]);
    }

    function edit_record($conn, $table_name, $rentID, $new_user_id, $new_carID, $new_price, $new_date_of_start, $new_date_of_end, $new_status_of_rent)
    {
        $query = 'UPDATE ' . $table_name .' 
		SET 
		user_id = :user_id,
		carID = :carID,
		price = :price,
		date_of_start = :date_of_start,
		date_of_end = :date_of_end,
		status_of_rent = :status_of_rent 
		WHERE rentID = :rentID';

        $statement = $conn->prepare($query);
        $statement->execute([
            ':user_id' => $new_user_id,
            ':carID' => $new_carID,
            ':price' => $new_price,
            ':date_of_start' => $new_date_of_start,
            ':date_of_end' => $new_date_of_end,
            ':status_of_rent' => $new_status_of_rent

        ]);
    }
}