<?php

class Gift extends BaseModel {

    public $id, $account_id, $person_id, $name, $status, $description, $added;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Gift');
        $query->execute();
        $rows = $query->fetchAll();
    
        $gifts = array();
        
        foreach($rows as $row) {
            $gifts[] = new Gift(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'status' => $row['status'],
                'description' => $row['description'],
                'added' => $row['added']
            ));
        }

        return $gifts;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Gift WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row) {
            $gift = new Gift(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'person_id' => $row['person_id'],
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