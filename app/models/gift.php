<?php

class Gift extends BaseModel{

    public $id, $account_id, $person_id, $person_name, $name, $status, $description, $added;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_description');
    }

    public static function all($account_id){
        $query = DB::connection()->prepare('SELECT * FROM Gift WHERE account_id = :account_id
                                            ORDER BY added DESC');
        $query->execute(array('account_id' => $account_id));
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

    public static function findByPerson($person_id){
        $query = DB::connection()->prepare('SELECT * FROM Gift WHERE person_id = :person_id');
        $query->execute(array('person_id' => $person_id));
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

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Gift (account_id, person_id, name, status, description, added)
                                            VALUES (:account_id, :person_id, :name, :status, :description, :added)
                                            RETURNING id');
        $query->execute(array(
            'account_id' => $this->account_id,
            'person_id' => $this->person_id,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'added' => $this->added
        ));

        // $query->bindValue(':account_id', $this->account_id, PDO::PARAM_INT);
        // $query->bindValue(':person_id', $this->person_id, PDO::PARAM_INT);
        // $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        // $query->bindValue(':status', $this->status, PDO::PARAM_BOOL);
        // $query->bindValue(':description', $this->description, PDO::PARAM_STR);
        // $query->execute();

        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Gift
                                            SET person_id = :person_id, name = :name, status = :status, description = :description
                                            WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'person_id' => $this->person_id,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description
        ));
    }

    public function delete(){
        $query = DB::connection()->prepare('DELETE FROM Gift WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_name(){
        $errors = array();
        if(!$this->validate_not_empty($this->name)){
            $errors[] = 'Lahjan nimi ei saa olla tyhjä';
        }
        if(!$this->validate_max_length($this->name, 100)){
            $errors[] = 'Lahjan nimen pituus ei saa olla yli 100 merkkiä';
        }
        return $errors;
    }

    public function validate_description(){
        $errors = array();
        if(!$this->validate_max_length($this->description, 500)){
            $errors[] = 'Kuvaus ei saa olla yli 500 merkkiä';
        }
        return $errors;
    }
}