<?php

Interface DB {
    public function connection();
    public function testing();
}
Interface QueryStatement {
    public function statment();
}

abstract class Test {

}
abstract class Testing {

}

Class Model extends Test implements DB, QueryStatement{
    public function connection(){

    }
    public function testing(){
        
    }
    public function statment(){

    }
}

$n = new Model();
$n->statment();