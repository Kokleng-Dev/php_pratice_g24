<?php

interface Model {
    public function modelAndTopSpeed();
}

class Car implements Model{
    private $speed;
    private $model;

    public function __construct($model,$speed){
        $this->speed = $speed;
        $this->model = $model;
    }
    public function modelAndTopSpeed(){
        echo $this->model . " : " . $this->speed;
    }
}

class Moto implements Model {
    private $speed;
    private $model;

    public function __construct($model,$speed){
        $this->speed = $speed;
        $this->model = $model;
    }
    public function modelAndTopSpeed(){
        echo $this->model . " : " . $this->speed * 10;
    }
}

$car1 = new Car("BMW",'125');
// $car1->modelAndTopSpeed();

echo "<br>";

$moto = new Moto("Honda",'125');
// $moto->modelAndTopSpeed();




class Car1 {
    protected $model;

    // string type hinting
    public function setModel(int $model)
    {
        $this->model = $model;
    }
    public function show(){
        echo $this->model;
    }
}

$n = new Car1();
$n->setModel(false);
$n->show();
  