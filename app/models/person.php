<?php

class Person extends BaseModel {

    public $id, $account_id, $name, $birthday, $description;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Person');
        $query->execute();
        $rows = $query->fetchAll();
    
        $accounts = array();
        
        foreach($rows as $row) {
            $people[] = new Person(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'name' => $row['name'],
                'birthday' => $row['birthday'],
                'description' => $row['description']
            ));
        }

        return $people;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $person = new Person(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'name' => $row['name'],
                'birthday' => $row['birthday'],
                'description' => $row['description']
            ));

            return $person;
        }

        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Person (name, birthday, description) VALUES (:name, :birthday, :description) RETURNING id');
        $query->execute(array('name' => $this->name, 'birthday' => $this->birthday, 'description' => $this->description));
        $row = $query->fetch();
        $this->id = $row['id'];
      }
}