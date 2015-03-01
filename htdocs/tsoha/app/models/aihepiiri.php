<?php

//
// EI KAYTOSSA!
//
// Tata mallia ei tarvita lopullisessa versiossa. 
//
//
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
  
  public static function create($aihepiiri){
    $rows = DB::query('INSERT INTO Aihepiiri(aihe) VALUES(:aihe)', array('aihe' => $aihepiiri['aihe']));
    $id = $rows[0]['id'];
    return $id;
//    
//    $aihepiiri = new Aihepiiri(array(
//      'id' => $row['id']
//      'aihe' => $row['aihe']
//    ));
//
//    return $aihepiiri['id'];
  }
  
}

