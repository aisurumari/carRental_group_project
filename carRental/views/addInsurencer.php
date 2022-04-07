<?php

session_start();
include('../src/DatabaseControllerMP.php');
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$bazaDanych = new DatabaseControllerMP();

$nazwaUbezpieczyciela = $siedzibaFirmy = '';
$errors = array('nazwaUbezpieczyciela'=>'', 'siedzibaFirmy'=>'');


if(isset($_POST['DodajUbezpieczyciela'])){

    //czy wszystko wpisane dobrze
    if(empty($_POST['nazwaUbezpieczyciela'])){
        $errors['nazwaUbezpieczyciela'] = "Podaj nazwę ubezpieczyciela!<br />";
    }
    else{
        $nazwaUbezpieczyciela = $_POST['nazwaUbezpieczyciela'];
    }



    if(empty($_POST['siedzibaFirmy'])){
        $errors['siedzibaFirmy'] = "Podaj siedzibę firmy ubezpieczyciela!<br />";
    } else {
        $siedzibaFirmy = $_POST['siedzibaFirmy'];
    }

    }

    //czy były błędy?
    if(array_filter($errors)){
        echo 'Błędny wpis! Nie dodano!';
    } else {
        $bazaDanych->addInsurancer();

}
