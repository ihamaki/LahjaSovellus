<?php

class Tag extends BaseModel{

    public $id, $account_id, $name;

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }   

    public static function all($account_id){
        $query = DB::connection()->prepare('SELECT * FROM Tag WHERE account_id = :account_id');
        $query->execute(array('account_id' => $account_id));
        $rows = $query->fetchAll();

        $tags = array();
        foreach($rows as $row){
            $tags[] = new Tag(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'name' => $row['name']
            ));
        }
        return $tags;
    }

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tag WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
            $tag = new Tag(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'name' => $row['name']
            ));
            return $tag;
        }
        return null;
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tag (account_id, name)
                                            VALUES (:account_id, :name)
                                            RETURNING id');
        $query->execute(array(
            'account_id' => $this->account_id,
            'name' => $this->name
        ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Tag
                                            SET name = :name
                                            WHERE id = :id');
        $query->execute(array(
            'id' => $this->id,
            'name' => $this->name
        ));
    }

    public function delete(){
        $query = DB::connection()->prepare('DELETE FROM Tag WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function can_delete(){
        $tag_gifts = GiftTag::find_by_tag($this->id);
        if(count($tag_gifts)>0){
            return false;
        }
        return true;
    }

    public function validate_name(){
        $errors = array();
        if(!$this->validate_not_empty($this->name)){
            $errors[] = 'Tagin nimi ei saa olla tyhjä';
        }
        if(!$this->validate_max_length($this->name, 50)){
            $errors[] = 'Tagin nimen pituus ei saa olla yli 50 merkkiä';
        }
        return $errors;
    }
}