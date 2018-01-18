<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($this->{$validator}(), $errors);
      }

      return $errors;
    }

    public function validate_not_empty($string){
      $string = trim($string);
      if($string == '' || $string == null){
        return false;
      }
      return true;
    }

    public function validate_min_length($string, $min){
      if (strlen($string) < $min){
        return false;
      }
      return true;
    }

    public function validate_max_length($string, $max){
      if (strlen($string) > $max){
        return false;
      }
      return true;
    }

    public function validate_date($date){
      $format = 'Y-m-d';
      $d = DateTime::createFromFormat($format, $date);
      if($d && $d->format($format) == $date){
        return true;
      }
      return false;
    }
  }
