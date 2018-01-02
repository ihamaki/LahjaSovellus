<?php

class DefaultController extends BaseController{
    public static function home(){
        View::make('home.html');
   }
}