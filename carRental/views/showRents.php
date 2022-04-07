<?php
session_start();
include "../src/Rent.php";
include "../src/DataBaseController.php";
include ('../src/Authorization.php');
//protect endpoint
$authorozation = new Authorization();
$authorozation->protect_endpoint(1);

$rent = new Rent();
$rent->add_controller();

$rent->show_rents();