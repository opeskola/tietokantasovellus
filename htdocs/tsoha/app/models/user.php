<?php

class User extends BaseModel{
  // Attribuutit
  public $opiskelijaNro, $nimi, $osoite, $syntymaAika, $tiedekunta, $aloitusvuosi, $salasana;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  public function authenticate($opiskelijaNro, $salasana){
      $opiskelijat = DB::query('SELECT * FROM Opiskelija WHERE opiskelijaNro = :opiskelijaNro AND salasana = :salasana', array('opiskelijaNro' => $opiskelijaNro, 'salasana' => $salasana));

      // jos opiskelijaa ei loydy haetuilla tunnuksilla ja salasanalla, palautetaan FALSE
      
      if (count($opiskelijat) == 0){
          return FALSE;
          
      }
      
      if (count($opiskelijat) > 0){
          $opiskelija = $opiskelijat[0];
          //var_dump($opiskelijat);
          //exit();
          $user = new User(array('opiskelijaNro' => $opiskelija['opiskelijanro'],
              'nimi' => $opiskelija['nimi'],
              'osoite' => $opiskelija['osoite'],
              'syntymaAika' => $opiskelija['syntymaaika'],
              'tiedekunta' => $opiskelija['tiedekunta'],
              'aloitusvuosi' => $opiskelija['aloitusvuosi'],
              'salasana' => $opiskelija['salasana']));
      
      return $user;
      }
  }
 
  
  public function find($opiskelijaNro){
    $rows = DB::query('SELECT * FROM Opiskelija WHERE opiskelijaNro = :opiskelijaNro LIMIT 1', array('opiskelijaNro' => $opiskelijaNro));

    if(count($rows) > 0){
      $row = $rows[0];

      $user = new User(array(
        'opiskelijaNro' => $row['opiskelijanro'],
        'nimi' => $row['nimi'],
        'osoite' => $row['osoite'],
        'syntymaAika' => $row['syntymaaika'],
        'tiedekunta' => $row['tiedekunta'],
        'aloitusvuosi' => $row['aloitusvuosi'],
        'salasana' => $row['salasana']
      ));

      return $user;
    }

    return null;
  }
  
  
  
}

