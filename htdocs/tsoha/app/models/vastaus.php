<?php

class Vastaus extends BaseModel{
  // Attribuutit
  public $id, $vastaaja, $kysymys, $aihe, $sisalto, $pvm;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
}

