<?php

// tassa on malli vastauksille

class Vastaus extends BaseModel{
  // Attribuutit
  public $id, $vastaaja, $kysymys, $aihe, $sisalto, $pvm;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }   
  
  // haetaan kaikki vastaukset tietokannasta
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
  
  // haetaan vastaus tietokannasta id:n perusteella
  public static function find($id){
    $rows = DB::query('SELECT * FROM Vastaus WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];

      $vastaus = new Vastaus(array(
        'id' => $row['id'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm']
      ));

      return $vastaus;
    }

    return null;
  }
  
  // haetaan vastaukset aiheen perusteella
  public static function find_answer_with_thema($aihe){
    $vastaukset = array();
    
    $rows = DB::query('SELECT * FROM Vastaus WHERE aihe = :aihe', array('aihe' => $aihe));
    
    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      $vastaukset[] = new Vastaus(array(
        'id' => $row['id'],
        'aihe' => $row['aihe'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm']
      ));
    }
    
    return $vastaukset;
  }
  
  // haetaan vastaus kysymyksen id:n perusteella
  public static function find_answer_with_question_id($kysymys){
    $rows = DB::query('SELECT * FROM Vastaus WHERE kysymys = :kysymys LIMIT 1', array('kysymys' => $kysymys));  
    
    if(count($rows) > 0){
      $row = $rows[0];

      // tehdaan uusi muuttuja $date (koska talla tavalla saatiin timestamp 
      // muokattua oikeaan muotoon. Jos laitetaan muotoon 'pvm = $row['pvm'], 
      // niin tulostuu ylimaaraisia desimaalipilkkuja timestampin peraan.
      $date = date_create($row['pvm']);
      
      $vastaus = new Vastaus(array(
        'id' => $row['id'],
        'kysymys' => $row['kysymys'],
        'sisalto' => $row['sisalto'],
        'pvm' => date_format($date, 'Y-m-d H:i:s')
      ));

      return $vastaus;
    }

    return null;      
      
  }
  
  // paivitetaan vastaus 
  public static function update($id, $vastaus){
    DB::query('UPDATE Vastaus SET sisalto = :sisalto WHERE id = :id', array('id' => $id, 'sisalto' => $vastaus['sisalto']));
  }
  
  // luodaan uusi vastaus
  public static function create($vastaus){ 
    $rows = DB::query('INSERT INTO Vastaus (sisalto, kysymys, aihe, pvm) VALUES(:sisalto, :kysymys, :aihe, NOW()) RETURNING id', array('sisalto' => $vastaus['sisalto'], 'kysymys' => $vastaus['kysymys'], 'aihe' => $vastaus['aihe'])); 
    $id = $rows[0]['id'];
    return $id;   
  }
  
  // tuhotaan vastaus (tata ei tarvita lopullisessa versiossa)
  public static function destroy($id){ 
    DB::query('DELETE FROM Vastaus WHERE id = :id', array('id' => $id));
  } 
}

