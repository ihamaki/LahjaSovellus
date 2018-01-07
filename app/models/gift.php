<?php

class Gift extends BaseModel{

    public $id, $account_id, $person_id, $person_name, $name, $status, $description, $added;

    public function __construct($attributes){
        parent::__construct($attributes);
    }

    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Gift');
        $query->execute();
        $rows = $query->fetchAll();
    
        $gifts = array();
        
        foreach($rows as $row){
            $person_name = Person::find($row['person_id'])->name;
            $gifts[] = new Gift(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'person_id' => $row['person_id'],
                'person_name' => $person_name,
                'name' => $row['name'],
                'status' => $row['status'],
                'description' => $row['description'],
                'added' => $row['added']
            ));
        }

        return $gifts;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Gift WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $person_name = Person::find($row['person_id'])->name;
            $gift = new Gift(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'person_id' => $row['person_id'],
                'person_name' => $person_name,
                'name' => $row['name'],
                'status' => $row['status'],
                'description' => $row['description'],
                'added' => $row['added']
            ));

            return $gift;
        }

        return null;
    }

}