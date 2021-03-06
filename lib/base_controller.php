<?php

class BaseController{
	public static function get_user_logged_in(){
    if(isset($_SESSION['user'])){
      $user_id = $_SESSION['user'];
      $user = User::find($user_id);
      return $user;
    }
      return null;
  }

  public static function check_logged_in(){
    if(!isset($_SESSION['user'])){
      Redirect::to('/login', array('message' => 'Kirjaudu sisään päästäksesi sivulle'));
    }
  }

  public static function check_if_authorized($id){
    $user = self::get_user_logged_in();
    if($user->id != $id){
      Redirect::to('/', array('error' => 'Sinulla ei ole oikeuksia tälle sivulle'));
    }
  }

}