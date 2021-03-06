<?php

class GiftController extends BaseController{

  public static function list(){
    $user = self::get_user_logged_in();
    $gifts = Gift::all($user->id);
    View::make('gift/gift_list.html', array('gifts' => $gifts));
  }

  public static function show($id){
    $gift = Gift::find($id);
    self::check_if_authorized($gift->account_id);
    View::make('gift/gift_show.html', array('gift' => $gift));
  }

  public static function new(){
    $user = self::get_user_logged_in();
    $people = Person::all($user->id);
    self::check_if_people($people);
    $tags = Tag::all($user->id);
    View::make('gift/gift_new.html', array('people' => $people, 'tags' => $tags));
  }

  public static function create(){
    $user = self::get_user_logged_in();
    $params = $_POST;

    if(array_key_exists('status', $params)){
      $attributes = array(
        'account_id' => $user->id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 1,
        'description' => $params['description'],
        'added' => date("Y-m-d")
      );
    }else{
      $attributes = array(
        'account_id' => $user->id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 0,
        'description' => $params['description'],
        'added' => date("Y-m-d")
      );
    }

    $gift = new Gift($attributes);
    $errors = $gift->errors();

    if(count($errors) == 0){
      $gift->save();
      if(array_key_exists('tags', $params)){
        foreach($params['tags'] as $tag_id){
          $gift_tag = new GiftTag(array('gift_id' => $gift->id, 'tag_id' => $tag_id));
          $gift_tag->save();
        }
      }
      Redirect::to('/gifts/' . $gift->id, array('message' => 'Lahjan lisäys onnistui!'));
    }else{
      $people = Person::all($user->id);
      View::make('gift/gift_new.html', array('errors' => $errors, 'attributes' => $attributes, 'people' => $people));
    }
  }

  public static function edit($id){
    $gift = Gift::find($id);
    self::check_if_authorized($gift->account_id);
    $user = self::get_user_logged_in();
    $people = Person::all($user->id);
    $tags = Tag::all($user->id);
    View::make('gift/gift_edit.html', array('gift' => $gift, 'people' => $people, 'tags' => $tags));
  }

  public static function update($id){
    $gift = Gift::find($id);
    self::check_if_authorized($gift->account_id);
    $params = $_POST;

    if(array_key_exists('status', $params)){
      $gift = new Gift(array(
        'id' => $id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 1,
        'description' => $params['description']
      ));
    }else{
      $gift = new Gift(array(
        'id' => $id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 0,
        'description' => $params['description']
      ));
    }
    
    $errors = $gift->errors();

    if(count($errors) == 0){
      $gift->update();
      GiftTag::delete_by_gift($gift->id);
      if(array_key_exists('tags', $params)){
        foreach($params['tags'] as $tag_id){
          $gift_tag = new GiftTag(array('gift_id' => $gift->id, 'tag_id' => $tag_id));
          $gift_tag->save();
        }
      }
      Redirect::to('/gifts/' . $gift->id, array('message' => 'Lahjan muokkaus onnistui!'));
    }else{
      $user = self::get_user_logged_in();
      $people = Person::all($user->id);
      View::make('gift/gift_edit.html', array('errors' => $errors, 'gift' => $gift, 'people' => $people));
    }
  }

  public static function destroy($id){
    $gift = Gift::find($id);
    self::check_if_authorized($gift->account_id);
    $gift->delete();
    Redirect::to('/gifts', array('message' => 'Lahjan poisto onnistui!'));
  }

  public static function check_if_people($people){
    if(!$people){
      Redirect::to('/people', array('error' => 'Ennen uuden lahjan luomista järjestelmään pitää lisätä lahjan saaja'));
    }
  }
}
