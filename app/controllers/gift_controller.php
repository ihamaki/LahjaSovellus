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
    $gift->save();
    Redirect::to('/gifts/' . $gift->id, array('message' => 'Lahjan lisäys onnistui!'));
  }

  public static function destroy($id){
    $gift = Gift::find($id);
    $gift->delete();
    Redirect::to('/gifts', array('message' => 'Lahjan poisto onnistui!'));
  }
}