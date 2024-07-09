<?php

class Database {
    private $host = "localhost";
    private $username = 'root';
    private $password = 'root';
    private $db = 'project_php_pos';
    protected $mysql;
    public function __construct(){
        $this->mysql = new mysqli($this->host,$this->username,$this->password,$this->db);
    }
}

class Model extends Database{
    protected $table;
    public function __construct($table){
        Database::__construct();
        $this->table = $table;
    }
    protected function DB($statement){
        return $this->mysql->query($statement);
    }
}

class User extends Model {
    public function __construct(){
        parent::__construct('users');
    }
    public function list(){
        return $this->DB("SELECT * FROM {$this->table}");
    }
    public function insert($data){
        return $this->DB("INSERT INTO {$this->table} (name, username, password) VALUES ('{$data['name']}','{$data['username']}','{$data['password']}')");
    }
    public function update($id,$data){
        return $this->DB("UPDATE  {$this->table}  SET name = '{$data['name']}', username = '{$data['username']}' , password = '{$data['password']}' WHERE id = '$id'");
    }
    public function delete($id){
        return $this->DB("DELETE FROM {$this->table} WHERE id = '{$id}'");
    }
}

class Product extends Model {
    public function __construct(){
        parent::__construct('products');
    }
    public function list(){
        return $this->DB("SELECT * FROM {$this->table}");
    }
    public function insert($data){
        return $this->DB("INSERT INTO {$this->table} (name, username, password) VALUES ('{$data['name']}','{$data['username']}','{$data['password']}')");
    }
    public function update($id,$data){
        return $this->DB("UPDATE  {$this->table}  SET name = '{$data['name']}', username = '{$data['username']}' , password = '{$data['password']}' WHERE id = '$id'");
    }
    public function delete($id){
        return $this->DB("DELETE FROM {$this->table} WHERE id = '{$id}'");
    }
}

$product = new Product();
// print_r($user->list()->fetch_object());


