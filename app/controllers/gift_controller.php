<?php

class GiftController extends BaseController{
  public static function list(){
    $gifts = Gift::all();
    View::make('gift/gift_list.html', array('gifts' => $gifts));
  }

  public static function show($id){
    $gift = Gift::find($id);
    View::make('gift/gift_show.html', array('gift' => $gift));
  }

  public static function new(){
    $people = Person::all();
    View::make('gift/gift_new.html', array('people' => $people));
  }
}