<?php

class PersonController extends BaseController{

  public static function list(){
    $people = Person::all();
    View::make('person/person_list.html', array('people' => $people));
  }

  public static function show($id){
    $person = Person::find($id);
    View::make('person/person_show.html', array('person' => $person));
  }

  public static function new(){
    View::make('person/person_new.html');
  }

  public static function create(){
    $params = $_POST;
    $person = new Person(array(
      'name' => $params['name'],
      'birthday' => $params['birthday'],
      'description' => $params['description']
    ));
    $person->save();

    Redirect::to('/people/' . $person->id, array('message' => 'Henkilön lisäys onnistui!'));
  }

}