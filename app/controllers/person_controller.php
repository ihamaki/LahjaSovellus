<?php

class PersonController extends BaseController{

  public static function list(){
    $user = self::get_user_logged_in();
    $people = Person::all($user->id);
    View::make('person/person_list.html', array('people' => $people));
  }

  public static function show($id){
    $person = Person::find($id);
    $gifts = Gift::findByPerson($id);
    View::make('person/person_show.html', array('person' => $person, 'gifts' => $gifts));
  }

  public static function new(){
    View::make('person/person_new.html');
  }

  public static function create(){
    $user = self::get_user_logged_in();
    $params = $_POST;
    $attributes = array(
      'account_id' => $user->id,
      'name' => $params['name'],
      'birthday' => $params['birthday'],
      'description' => $params['description']
    );

    $person = new Person($attributes);
    $errors = $person->errors();

    if(count($errors) == 0){
      $person->save();
      Redirect::to('/people/' . $person->id, array('message' => 'Henkilön lisäys onnistui!'));
    }else{
      View::make('person/person_new.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }

  public static function edit($id){
    $person = Person::find($id);
    View::make('person/person_edit.html', array('person' => $person));
  }

  public static function update($id){
    $params = $_POST;
    $person = new Person(array(
      'id' => $id,
      'name' => $params['name'],
      'birthday' => $params['birthday'],
      'description' => $params['description']
    ));

    $errors = $person->errors();

    if(count($errors) == 0){
      $person->update();
      Redirect::to('/people/' . $person->id, array('message' => 'Henkilön muokkaus onnistui!'));
    }else{
      View::make('person/person_edit.html', array('errors' => $errors, 'person' => $person));
    }
  }

  public static function destroy($id){
    $person = Person::find($id);
    if($person->can_delete()){
      $person->delete();
      Redirect::to('/people', array('message' => 'Henkilön poisto onnistui!'));
    }else{
      Redirect::to('/people/' . $person->id, array('error' => 'Henkilöä ei voida poistaa, sillä henkilöön liittyy lahjoja', 'person' => $person));
    }
  }

}