<?php
session_start();
include('../src/DatabaseControllerMP.php');
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);


$bazaDanych = new DatabaseControllerMP();

if(isset($_POST['UsunUbezpieczyciela'])){
    $bazaDanych->deleteInsurancer();
}


?>
