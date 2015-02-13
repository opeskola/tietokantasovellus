<?php

class Kysymys extends BaseModel{
  // Attribuutit
  public $id, $opiskelijaNro, $sisalto, $pvm, $status;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
    
    $this->validators = array('validate_sisalto');
  }
  
  public function validate_sisalto(){
    $errors = array();

    if($this->sisalto == '' || $this->sisalto == null){
      $errors[] = 'Kysymys ei saa olla tyhjä!';
    }
    if(strlen($this->sisalto) > 2000){
      $errors[] = 'Kysymyksen pituuden tulee olla enintään 2000 merkkiä!';
    }

    return $errors;
 }  
  
  
  public static function all(){
    $kysymykset = array();
    // Kutsutaan luokan DB staattista metodia query
    $rows = DB::query('SELECT Kysymys.id, Kysymys.sisalto, Kysymys.pvm, Kysymys.status, 
        Vastaus.sisalto AS vastaus_sisalto FROM Kysymys LEFT JOIN Vastaus ON Kysymys.id = Vastaus.kysymys;
');

    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
      $kysymykset[] = new Kysymys(array(
        'id' => $row['id'],
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
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
        'status' => $row['status']
      ));

      return $kysymys;
    }

    return null;
  }
  
  public static function set_status_true($id){
    DB::query('UPDATE Kysymys SET status = TRUE WHERE id = :id', array('id' => $id));
  }
  
  
  public static function update($id, $kysymys){
    DB::query('UPDATE Kysymys SET sisalto = :sisalto WHERE id = :id', array('id' => $id, 'sisalto' => $kysymys['sisalto']));
  }
  
  public static function create($kysymys){ 
    $rows = DB::query('INSERT INTO Kysymys (sisalto, pvm) VALUES(:sisalto, NOW()) RETURNING id', array('sisalto' => $kysymys['sisalto'])); 
    $id = $rows[0]['id'];
    return $id;   
  } 
  
  
  
  
  public static function destroy($id){ 
    DB::query('DELETE FROM Kysymys WHERE id = :id', array('id' => $id));
  }   
}

