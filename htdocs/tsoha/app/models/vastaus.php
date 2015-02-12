<?php

class Vastaus extends BaseModel{
  // Attribuutit
  public $id, $vastaaja, $kysymys, $aihe, $sisalto, $pvm;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
  
//  public function validate_vastaus_sisalto(){
//    $errors = array();
//
//    if($this->sisalto == '' || $this->sisalto == null){
//      $errors[] = 'Vastaus ei saa olla tyhjä!';
//    }
//    if(strlen($this->sisalto) > 2000){
//      $errors[] = 'Vastauksen pituuden tulee olla enintään 2000 merkkiä!';
//    }
//
//    return $errors;
// }    
  
  public static function all(){
    $vastaukset = array();
    // Kutsutaan luokan DB staattista metodia query
    $rows = DB::query('SELECT * FROM Vastaus');

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $vastaukset[] = new Vastaus(array(
        'id' => $row['id'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
      ));
    }

    return $vastaukset;
  }
  
  public static function find($id){
    $rows = DB::query('SELECT * FROM Vastaus WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];

      $vastaus = new Vastaus(array(
        'id' => $row['id'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
      ));

      return $vastaus;
    }

    return null;
  }
  
  public static function update($id, $vastaus){
    DB::query('UPDATE Vastaus SET sisalto = :sisalto WHERE id = :id', array('id' => $id, 'sisalto' => $vastaus['sisalto']));
  }
  
  public static function create($vastaus){ 
    $rows = DB::query('INSERT INTO Vastaus (sisalto) VALUES(:sisalto) RETURNING id', array('sisalto' => $vastaus['sisalto'])); 
    $id = $rows[0]['id'];
    return $id;   
  }
  
  public static function destroy($id){ 
    DB::query('DELETE FROM Vastaus WHERE id = :id', array('id' => $id));
  } 
}

