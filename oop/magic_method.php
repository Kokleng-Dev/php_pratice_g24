<?php

class Car {
    private $name;
    private $color;
    public function __construct($models, $color){
       $this->name = $models;
       $this->color = $color;
    }
    public function model(){
        foreach($this->name as $index => $name){
            echo "<h6 style='color:{$this->color[$index]} '>". $name ."</h6>";
        }
    }
    public function whoami(){
        echo  __CLASS__;
    }
}

$n = new Car(['bmw','toyota','lexus'], ['red','pink','blue']);
$n->model();
// $n->whoami();

$n1 = new Car(['lexus','bmw','toyota'], ['red','pink','blue']);
$n1->model();
