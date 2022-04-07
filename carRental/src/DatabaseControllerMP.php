<?php

class DatabaseControllerMP{
    function connect(){
        $conn = mysqli_connect('localhost', 'root', '', 'carrental');

        //sprawdzenie polaczenia
        if(!$conn){
            echo 'Błąd połączenia z bazą danych';
        }

        return $conn;
    }


    function addCar($marka, $liczbaDrzwi, $pojemnoscSilnika, $cena)
    {
        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        // escape sql chars
        $marka = mysqli_real_escape_string($conn, $_POST['marka']);
        $liczbaDrzwi = mysqli_real_escape_string($conn, $_POST['liczbaDrzwi']);
        $pojemnoscSilnika = mysqli_real_escape_string($conn, $_POST['pojemnoscSilnika']);
        $cena = mysqli_real_escape_string($conn, $_POST['cena']);

        // create sql
        $sql = "INSERT INTO car(marka,liczbaDrzwi,pojemnoscSilnika,cena,bezwypadkowe,dostepnoscSamochodu) VALUES('$marka','$liczbaDrzwi','$pojemnoscSilnika','$cena',1,1)";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            echo 'Dodano do bazy :)';
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }

    }

    function allCars(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        $sql = 'SELECT * FROM car ORDER BY idSamochodu';

        $result = mysqli_query($conn, $sql);
        $cars = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);

        return $cars;
    }

    function findCar($id){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        $idSamochoduWypadkowego = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM car WHERE idSamochodu = $idSamochoduWypadkowego";
        $result = mysqli_query($conn, $sql);
        $car = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);

        return $car['marka'];

    }

    function allInsurancers(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        //wszyscy ubezpieczyciele - query
        $sql = 'SELECT * FROM insurencer ORDER BY idUbezpieczyciela';

        $result = mysqli_query($conn, $sql);
        $insurancers = mysqli_fetch_all($result, MYSQLI_ASSOC);
//        mysqli_free_result($result);
        return $insurancers;

    }

    function addInsurancer(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        // escape sql chars
        $nazwaUbezpieczyciela = mysqli_real_escape_string($conn, $_POST['nazwaUbezpieczyciela']);
        $siedzibaFirmy = mysqli_real_escape_string($conn, $_POST['siedzibaFirmy']);

        // create sql
        $sql = "INSERT INTO insurencer(nazwaUbezpieczyciela, siedzibaFirmy) VALUES('$nazwaUbezpieczyciela','$siedzibaFirmy')";

        // save to db and check
        if(mysqli_query($conn, $sql)){
            header('Location: insurancer.php');
        } else {
            header('Location: insurancer.php');
            echo 'query error: '. mysqli_error($conn);
        }
    }

    function deleteInsurancer(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();


        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM insurencer WHERE idUbezpieczyciela = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: insurancers.php');
        } else {
            header('Location: insurancers.php');
            echo "Błąd usuwania!";
        }
    }

    function getDetails(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        $idSamochodu = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM car WHERE idSamochodu = $idSamochodu";
        $result = mysqli_query($conn, $sql);
        $cars = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);
        return $cars;
    }

    function deleteCar(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM car WHERE idSamochodu = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo "Błąd usuwania!";
        }
        mysqli_close($conn);
    }


    function editCar(){

        $db = new DatabaseControllerMP();
        $conn = $db->connect();

        $id_to_edit = mysqli_real_escape_string($conn, $_POST['id_to_edit']);
        $sql1 = "SELECT bezwypadkowe FROM car WHERE idSamochodu = $id_to_edit";
        $result = mysqli_query($conn, $sql1);
        $cars_to_edit = mysqli_fetch_assoc($result);

        mysqli_free_result($result);


        if($cars_to_edit['bezwypadkowe']=='0') {
            $sql = "UPDATE car SET bezwypadkowe='1' WHERE idSamochodu = $id_to_edit";
        } else{
            $sql = "UPDATE car SET bezwypadkowe='0' WHERE idSamochodu = $id_to_edit";
        }
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo "Błąd edycji!";
        }
        mysqli_close($conn);
    }
}

?>