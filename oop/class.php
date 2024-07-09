<?php

class Car {
    public $type;
    public $condition;
    public function display(){
        echo "<br>" .  $this->type . ":" . $this->isNew();
    }
    public function isNew(){
        return $this->condition;
    }
}
$n1 = new Car();
$n1->condition = 'old';
$n1->type = "toyota";

// echo $n1->display();

$n2 = new Car();
echo $n2->display();


?>