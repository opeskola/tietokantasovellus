<?php

class Aihepiiri extends BaseModel{
  // Attribuutit
  public $id, $aihe;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  public static function all(){
    $aiheet = array();
    // Kutsutaan luokan DB staattista metodia query
    $rows = DB::query('SELECT * FROM Aihepiiri');

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $aiheet[] = new Aihepiiri(array(
        'id' => $row['id'],
        'aihe' => $row['aihe']
      ));
    }

    return $aiheet;
  }  
  
  public static function find($id){
    $rows = DB::query('SELECT * FROM Aihepiiri WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];

      $aihepiiri = new Aihepiiri(array(
        'id' => $row['id'],
        'aihe' => $row['aihe']
      ));

      return $aihepiiri;
    }

    return null;
  }
  
  public static function create($id, $aihe){
    return DB::query('INSERT INTO Aihepiiri(id, aihe) VALUES($id, $aihe) RETURNING id');  
//    
//    $aihepiiri = new Aihepiiri(array(
//      'id' => $row['id'],
//      'aihe' => $row['aihe']
//    ));
//
//    return $aihepiiri['id'];
  }
  
}

