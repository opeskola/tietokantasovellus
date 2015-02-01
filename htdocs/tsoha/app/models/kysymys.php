<?php

class Kysymys extends BaseModel{
  // Attribuutit
  public $id, $opiskelijaNro, $sisalto, $pvm, $status;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
  public static function all(){
    $kysymykset = array();
    // Kutsutaan luokan DB staattista metodia query
    $rows = DB::query('SELECT * FROM Kysymys');

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $kysymykset[] = new Kysymys(array(
        'id' => $row['id'],
        'opiskelijaNro' => $row['opiskelijaNro'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
        'status' => $row['status']
      ));
    }

    return $kysymykset;
  }
  
  public static function find($id){
    $rows = DB::query('SELECT * FROM Kysymys WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];

      $kysymys = new Kysymys(array(
        'id' => $row['id'],
        'opiskelijaNro' => $row['opiskelijaNro'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
        'status' => $row['status']
      ));

      return $kysymys;
    }

    return null;
  }
  
  public static function create() {
      $rows = DB::query('INSERT INTO Kysymys(...) VALUES(...)');
      
      if(count($rows) > 0){
        $row = $rows[0];

        $kysymys = new Kysymys(array(
          'id' => $row['id'],
          'opiskelijaNro' => $row['opiskelijaNro'],
          'sisalto' => $row['sisalto'],
          'pvm' => $row['pvm'],
          'status' => $row['status']
        ));

        return $kysymys;
      }

      return null;
  }
}

