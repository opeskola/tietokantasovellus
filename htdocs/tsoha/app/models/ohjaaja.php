<?php

//
// tassa on malli opinto-ohjaajille
//
class Ohjaaja extends BaseModel{
  // Attribuutit
  //
  // id = opinto-ohjaajan id
  // nimi = opinto-ohjaajan nimi
  // osoite = opinto-ohjaajan osoite
  // syntymaAika = opinto-ohjaajan syntyma-aika
  // salasana = opinto-ohjaajan salasana sivustolle
  //
  public $id, $nimi, $osoite, $syntymaAika, $salasana;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  // autentikoidaan opinto-ohjaaja
  public function authenticate($id, $salasana){
      $opintoOhjaajat = DB::query('SELECT * FROM OpintoOhjaaja WHERE id = :id AND salasana = :salasana', array('id' => $id, 'salasana' => $salasana));
      
      // jos opinto-ohjaajaa ei loydy haetuilla tunnuksilla ja salasanalla, palautetaan FALSE
      
      if (count($opintoOhjaajat) == 0){
          return FALSE;
      }
      
      if (count($opintoOhjaajat) > 0){
          $opintoOhjaaja = $opintoOhjaajat[0];
          //var_dump($opiskelijat);
          //exit();
          $ohjaaja = new Ohjaaja(array('id' => $opintoOhjaaja['id'],
              'nimi' => $opintoOhjaaja['nimi'],
              'osoite' => $opintoOhjaaja['osoite'],
              'syntymaAika' => $opintoOhjaaja['syntymaaika'],
              'salasana' => $opintoOhjaaja['salasana']));

      
          return $ohjaaja;
      }
  }
   
  // etsitaan opinto-ohjaaja id:n perusteella
  public function find($id){
    $rows = DB::query('SELECT * FROM OpintoOhjaaja WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];

      $ohjaaja = new Ohjaaja(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite'],
        'syntymaAika' => $row['syntymaaika'],
        'salasana' => $row['salasana']
      ));

      return $ohjaaja;
    }

    return null;
  } 
}