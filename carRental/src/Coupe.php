<?php


class Coupe extends Samochod {
    public function intro() : string {
        return "$this->name -  Rodzaj nadwozia samochodowego, z dwoma, czterema lub rzadziej pięcioma miejscami siedzącymi i z jedną parą drzwi.";
    }
}