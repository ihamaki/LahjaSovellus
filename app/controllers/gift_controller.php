<?php

class GiftController extends BaseController{

  public static function list(){
    $user = self::get_user_logged_in();
    $gifts = Gift::all($user->id);
    View::make('gift/gift_list.html', array('gifts' => $gifts));
  }

  public static function show($id){
    $gift = Gift::find($id);
    View::make('gift/gift_show.html', array('gift' => $gift));
  }

  public static function new(){
    $user = self::get_user_logged_in();
    $people = Person::all($user->id);
    View::make('gift/gift_new.html', array('people' => $people));
  }

  public static function create(){
    $user = self::get_user_logged_in();
    $params = $_POST;
    if(array_key_exists('status', $params)){
      $attributes = array(
        'account_id' => $user->id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => $params['status'],
        'description' => $params['description'],
        'added' => date("Y-m-d")
      );
    }else{
      $attributes = array(
        'account_id' => $user->id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 'false',
        'description' => $params['description'],
        'added' => date("Y-m-d")
      );
    }

    $gift = new Gift($attributes);
    $errors = $gift->errors();

    if(count($errors) == 0){
      $gift->save();
      Redirect::to('/gifts/' . $gift->id, array('message' => 'Lahjan lisäys onnistui!'));
    }else{
      $people = Person::all($user->id);
      View::make('gift/gift_new.html', array('errors' => $errors, 'attributes' => $attributes, 'people' => $people));
    }
  }

  public static function edit($id){
    $user = self::get_user_logged_in();
    $gift = Gift::find($id);
    $people = Person::all($user->id);
    View::make('gift/gift_edit.html', array('gift' => $gift, 'people' => $people));
  }

  public static function update($id){
    $params = $_POST;
    if(array_key_exists('status', $params)){
      $gift = new Gift(array(
        'id' => $id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => $params['status'],
        'description' => $params['description']
      ));
    }else{
      $gift = new Gift(array(
        'id' => $id,
        'person_id' => $params['person'],
        'name' => $params['name'],
        'status' => 'false',
        'description' => $params['description']
      ));
    }
    $errors = $gift->errors();

    if(count($errors) == 0){
      $gift->update();
      Redirect::to('/gifts/' . $gift->id, array('message' => 'Lahjan muokkaus onnistui!'));
    }else{
      $user = self::get_user_logged_in();
      $people = Person::all($user->id);
      View::make('gift/gift_edit.html', array('errors' => $errors, 'gift' => $gift, 'people' => $people));
    }
  }

  public static function destroy($id){
    $gift = Gift::find($id);
    $gift->delete();
    Redirect::to('/gifts', array('message' => 'Lahjan poisto onnistui!'));
  }
}