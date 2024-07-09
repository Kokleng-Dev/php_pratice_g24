<?php
class Car{
    protected $model;
    protected $color;

    final function hello(){
        echo "hello car";
    }
}

class SportCar extends Car{
    public function __construct($model, $color){
        $this->model = $model;
        $this->color = $color;
    }
    public function info(){
        echo "<h6 style='color:{$this->color}'>" . $this->model . "</h6>";
    }
}

class NewCar extends Car{

}

$n = new SportCar('AAA','red');
$n->info();
$n->hello();

$n1 = new NewCar();
$n1->hello();

