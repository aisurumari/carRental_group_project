<?php

abstract class Samochod {
    public $name;

    public function getName()
    {
        return $this->name;
    }
    public function __construct($name) {
        $this->name = $name;
    }
    abstract public function intro() : string;
}
?>



