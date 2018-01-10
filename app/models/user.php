<?php

class User extends BaseModel{

    public $id, $username, $password, $password_confirmation;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_password');
    }

    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Account 
                                            WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $user = new User(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Account (username, password) 
                                            VALUES (:username, :password)
                                            RETURNING id');
        $query->execute(array(
            'username' => $this->username,
            'password' => $this->password
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_username(){
        $errors = array();
        if(!$this->validate_min_length($this->username, 5) || !$this->validate_max_length($this->username, 30)){
            $errors[] = 'Käyttäjän nimen tulee olla 5-30 merkkiä pitkä';
        }
        return $errors;
    }

    public function validate_password(){
        $errors = array();
        if(!$this->validate_min_length($this->password, 8) || !$this->validate_max_length($this->password, 30)){
            $errors[] = 'Salasanan tulee olla 8-30 merkkiä pitkä';
        }
        if($this->password != $this->password_confirmation){
            $errors[] = 'Salasanat eivät täsmää';
        }
        return $errors;
    }
}