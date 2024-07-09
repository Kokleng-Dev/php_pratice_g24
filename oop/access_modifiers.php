<?php

class Person{
    private $firstname;
    private $lastname;

    public function setFullname($firstname,$lastname){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function showFullName(){
        echo $this->firstname . " " . $this->lastname;
    }
}

$n = new Person();
$n->setFullname('A','Makara');
$n->showFullName();
