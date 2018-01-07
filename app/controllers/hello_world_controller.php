<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      $mike = new Person(array(
        'name' => ''
      ));
      $errors = $mike->errors();
    
      Kint::dump($errors);
    }

    public static function frontpage(){
   	  View::make('suunnitelmat/frontpage.html');
    }

    public static function gift_list(){
      View::make('suunnitelmat/gift_list.html');
    }

    public static function gift_show(){
      View::make('suunnitelmat/gift_show.html');
    }

    public static function gift_edit(){
      View::make('suunnitelmat/gift_edit.html');
    }

    public static function person_list(){
      View::make('suunnitelmat/person_list.html');
    }

    public static function person_gifts(){
      View::make('suunnitelmat/person_gifts.html');
    }

    public static function person_show(){
      View::make('suunnitelmat/person_show.html');
    }

    public static function person_edit(){
      View::make('suunnitelmat/person_edit.html');
    }

    public static function tag_edit(){
      View::make('suunnitelmat/tag_edit.html');
    }
  
    public static function login(){
      View::make('suunnitelmat/login.html');
    }
  
    public static function register(){
      View::make('suunnitelmat/register.html');
    }
  }
