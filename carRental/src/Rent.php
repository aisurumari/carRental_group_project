<?php

class Rent
{
    
    public $controller;

    function add_controller(){
        $this->controller = new DataBaseController();
    }

    function calculate_price ( $conn, $table_name, $user_id, $carID, $date_of_start, $date_of_end){
        

        $sql = "SELECT count(*) FROM rents WHERE user_id = $user_id"; 
        $result = $conn->prepare($sql); 
        $result->execute(); 
        $number_of_rows = $result->fetchColumn();

        $sql = "SELECT cena FROM car WHERE idSamochodu = $carID"; 
        $res = $conn->prepare($sql); 
        $res->execute(); 
        $car_price = $res->fetchColumn();

        
        $start = strtotime($date_of_start);
        $end = strtotime($date_of_end);
        $datediff = $end - $start;

        $number_of_days = round($datediff / (60 * 60 * 24));

        $price = $number_of_days * $car_price;
        if($number_of_rows > 10) $price = $price*90/100;
        elseif ($number_of_rows > 5) $price = $price*95/100;
        
        return $price;
    }

    function add_rent(){

        $connect = $this->controller -> connect('localhost', 'root', '', 'carrental');

        $user_id = $_POST['user_id'];
        $carID = $_POST['carID'];
        $date_of_start = $_POST['date_of_start'];
        $date_of_end = $_POST['date_of_end'];

        $sql = "SELECT rentID FROM rents ORDER BY rentID DESC LIMIT 1"; 
        $result = $connect->prepare($sql); 
        $result->execute(); 
        $rentID = $result->fetchColumn() + 1;

        if($this->check_date($date_of_start, $date_of_end) == true){
            $price = $this -> calculate_price( $connect, 'rents', $user_id, $carID, $date_of_start, $date_of_end);

            $start = strtotime($date_of_start);
            $today = time();
            if($start>$today) $this->controller -> add_record($connect, 'rents', $rentID, $user_id, $carID, $price, $date_of_start, $date_of_end, 'zaplanowane'); 
            else $this->controller -> add_record($connect, 'rents', $rentID, $user_id, $carID, $price, $date_of_start, $date_of_end, 'trwajace'); 

            echo "Wypożyczenie dodano pomyślnie";
        }

        
    }

    function delete_rent(){
        $connect = $this->controller -> connect('localhost', 'root', '', 'carrental');

        $rentID = $_POST['rentID'];

        $sql = "SELECT count(*) FROM rents WHERE rentID = $rentID"; 
        $result = $connect->prepare($sql); 
        $result->execute(); 
        $x = $result->fetchColumn();

        if($x==0) echo "Nie ma takiego wypożyczenia";
        else {
            $this->controller->delete_record($connect, 'rents', 'rentID', $rentID);
            echo "Wypożyczenie usunięto pomyślnie";
        }

        
    }

    function show_rents(){
        $connect = $this->controller -> connect('localhost', 'root', '', 'carrental');

        $sql = "SELECT * FROM rents "; 
        $result = $connect->query($sql);


        echo '<table><tr><th>ID wypożyczenia  |</th><th>|  ID klienta  |</th><th>|  ID samochodu  |</th><th>|  cena  |</th>
        <th>|  data rozpoczęcia  |</th><th>|  data zakończenia  |</th><th>|  status  |</th></tr>';
        while($row = $result->fetch()) {
            echo "<tr><th>{$row['rentID']}</th><th>{$row['user_ID']}</th><th>{$row['carID']}</th><th>{$row['price']}</th>
            <th>{$row['date_of_start']}</th><th>{$row['date_of_end']}</th><th>{$row['status_of_rent']}</th></tr>";
        }
        echo '</table>';
    }

    function show_one_rent(){
        $connect = $this->controller -> connect('localhost', 'root', '', 'carrental');

        $rentID = $_POST['rentID'];
        $sql = "SELECT * FROM rents WHERE rentID = $rentID "; 
        $result = $connect->query($sql);


        echo '<table><tr><th>ID wypożyczenia  |</th><th>|  ID klienta  |</th><th>|  ID samochodu  |</th><th>|  cena  |</th>
        <th>|  data rozpoczęcia  |</th><th>|  data zakończenia  |</th><th>|  status  |</th></tr>';
        while($row = $result->fetch()) {
            echo "<tr><th>{$row['rentID']}</th><th>{$row['user_ID']}</th><th>{$row['carID']}</th><th>{$row['price']}</th>
            <th>{$row['date_of_start']}</th><th>{$row['date_of_end']}</th><th>{$row['status_of_rent']}</th></tr>";
        }
        echo '</table>';
    }

    function show_client_rents(){
        $connect = $this->controller -> connect('localhost', 'root', '', 'carrental');

        $user_id = $_POST['user_id'];
        $sql = "SELECT * FROM rents WHERE user_ID = $user_id "; 
        $result = $connect->query($sql);


        echo '<table><tr><th>ID wypożyczenia  |</th><th>|  ID klienta  |</th><th>|  ID samochodu  |</th><th>|  cena  |</th>
        <th>|  data rozpoczęcia  |</th><th>|  data zakończenia  |</th><th>|  status  |</th></tr>';
        while($row = $result->fetch()) {
            echo "<tr><th>{$row['rentID']}</th><th>{$row['user_ID']}</th><th>{$row['carID']}</th><th>{$row['price']}</th>
            <th>{$row['date_of_start']}</th><th>{$row['date_of_end']}</th><th>{$row['status_of_rent']}</th></tr>";
        }
        echo '</table>';
    }

    function check_date($date_of_start, $date_of_end){
        $start = strtotime($date_of_start);
        $end = strtotime($date_of_end);
        $today = time();

        if($start>$end || $start==$end) {
            echo "Wypożyczenie musi trwać przynajmniej jeden dzień";
            return false;
        }
        return true;
    }

}