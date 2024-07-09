<?php

abstract class DB{
    protected $testing = "hello world";
    abstract public function connection();
    abstract public function list();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();
}

class Model extends DB{
    public function connection(){
        echo $this->testing;
    }
    public function list(){
        echo "hello";
    }
    public function insert(){
        echo "hello";
    }
    public function update(){
        echo "hello";
    }
    public function delete(){
        echo "hello";
    }
}

$n = new Model();
$n->connection();