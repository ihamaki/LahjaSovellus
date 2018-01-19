<?php

class UserController extends BaseController{
  public static function login(){
    View::make('user/login.html');
  }

  public static function handle_login(){
    $params = $_POST;
    $user = User::authenticate($params['username'], $params['password']);
    
    if(!$user){
      View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
    }else{
      $_SESSION['user'] = $user->id;
      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->username . '!'));
    }
  }

  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui!'));
  }

  public static function register(){
    View::make('user/register.html');
  }

  public static function handle_register(){
    $params = $_POST;
    $attributes = array(
      'username' => $params['username'],
      'password' => $params['password'],
      'password_confirmation' => $params['password_confirmation']
    );

    $user = new User($attributes);
    $errors = $user->errors();

    if(count($errors) == 0){
      $user->save();
      Redirect::to('/login' , array('message' => 'Rekisteröityminen onnistui! Kirjaudu sisään.'));
    }else{
      View::make('user/register.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
}