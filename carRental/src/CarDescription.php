<?php
include 'Car.php';
include "Kabriolet.php";
include "Coupe.php";
include "Hatchback.php";
include "VAN.php";
include "Kombi.php";

class CarDescription{
    function noweSamochody(){

        $kabriolet = new Kabriolet("Kabriolet");
        $coupe = new Coupe("Coupe");
        $hatchback = new Hatchback("Hatchback");
        $van = new VAN("VAN");
        $kombi = new Kombi("Kombi");

        $cars = array($kabriolet,$coupe,$hatchback,$van,$kombi);

        return $cars;

    }

}