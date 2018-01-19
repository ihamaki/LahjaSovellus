<?php

class GiftTag extends BaseModel{

    public $gift_id, $tag_id;

    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tag WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $rows = $query->fetch();;
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

    public static function find_by_gift($gift_id){
        $query = DB::connection()->prepare('SELECT Tag.id, Tag.account_id, Tag.name 
                                            FROM Tag INNER JOIN GiftTag
                                            ON Tag.id = GiftTag.tag_id
                                            WHERE gift_id = :gift_id');
        $query->execute(array('gift_id' => $gift_id));
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

    public static function find_by_tag($tag_id){
        $query = DB::connection()->prepare('SELECT Gift.id, Gift.account_id, Gift.name, Gift.status, Gift.added
                                            FROM Gift INNER JOIN GiftTag
                                            ON Gift.id = GiftTag.gift_id
                                            WHERE tag_id = :tag_id');
        $query->execute(array('tag_id' => $tag_id));
        $rows = $query->fetchAll();
        $gifts = array();
        foreach($rows as $row){
            $gifts[] = new Gift(array(
                'id' => $row['id'],
                'account_id' => $row['account_id'],
                'status' => $row['status'],
                'name' => $row['name'],
                'added' => $row['added']
            ));
        }
        return $gifts;
    }

    public static function delete_by_gift($gift_id){
        $query = DB::connection()->prepare('DELETE FROM GiftTag 
                                            WHERE gift_id = :gift_id');
        $query->execute(array('gift_id' => $gift_id));
    }

    public function save(){
        $query = DB::connection()->prepare('INSERT INTO GiftTag (gift_id, tag_id)
                                            VALUES (:gift_id, :tag_id)');
        $query->execute(array('gift_id' => $this->gift_id, 'tag_id' => $this->tag_id));
        $row = $query->fetch();
    }

}