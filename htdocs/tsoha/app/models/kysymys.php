<?php

// Malli kysymyksiin

class Kysymys extends BaseModel{
  // Attribuutit
  //
  // id = kysymyksen id
  // opiskelijaNro = kysymyksen esittajan opiskelijanumero
  // sisalto = kysymyksen sisalto
  // pvm = kysymyksen paivamaara
  // status = onko kysymykseen vastattu vai ei (true / false)
  //
  public $id, $opiskelijaNro, $sisalto, $pvm, $status;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
    
    $this->validators = array('validate_sisalto');
  }
  
  // validoidaan kysymyksen sisalto
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
  
  // haetaan kaikki kysymykset tietokannasta. Jos annetaan aihe-parametri, niin
  // haetaan kyseiseen aiheeseen liittyvat kysymykset (vain ne kysymykset, joihin
  // on vastattu)
  public static function all($aihe){
    
    if ($aihe == NULL){
        $query = 'SELECT Kysymys.id, Kysymys.sisalto, Kysymys.pvm, Kysymys.status, 
            Vastaus.sisalto AS vastaus_sisalto FROM Kysymys LEFT JOIN Vastaus ON Kysymys.id = Vastaus.kysymys;'; 
        $rows = DB::query($query);   
    } else{
        $query = 'SELECT Kysymys.id, Kysymys.sisalto, Kysymys.pvm, Kysymys.status, 
            Vastaus.sisalto AS vastaus_sisalto FROM Kysymys LEFT JOIN Vastaus ON Kysymys.id = Vastaus.kysymys
            WHERE Vastaus.aihe = :aihe;';
        $rows = DB::query($query, array('aihe' => $aihe));
    }
       
    $kysymykset = array();
    
    // Käydään kyselyn tuottamat rivit läpi
    foreach($rows as $row){
      
      $kysymykset[] = new Kysymys(array(
        'id' => $row['id'],
        'sisalto' => $row['sisalto'],
        'pvm' => $row['pvm'],
        'status' => $row['status']
      ));
    }

    return $kysymykset;
  }
  
  // haetaan tietokannasta kysymys id:n perusteella
  public static function find($id){
    $rows = DB::query('SELECT * FROM Kysymys WHERE id = :id LIMIT 1', array('id' => $id));

    if(count($rows) > 0){
      $row = $rows[0];
     
      // tehdaan uusi muuttuja $date (koska talla tavalla saadaan timestamp 
      // muokattua oikeaan muotoon. Jos laitetaan muotoon 'pvm = $row['pvm'], 
      // niin tulostuu ylimaaraisia desimaalipilkkuja timestampin peraan.
      $date = date_create($row['pvm']);
      
      $kysymys = new Kysymys(array(
        'id' => $row['id'],
        'sisalto' => $row['sisalto'],
        'pvm' => date_format($date, 'Y-m-d H:i:s'),
        'status' => $row['status']
      ));

      return $kysymys;
    }

    return null;
  }
   
  // asetetaan status arvoon true, jos kysymykseen on vastattu (default-arvo on,
  // etta status = false
  public static function set_status_true($id){
    DB::query('UPDATE Kysymys SET status = TRUE WHERE id = :id', array('id' => $id));
  }
  
  // paivitetaan kysymyksen sisalto
  public static function update($id, $kysymys){
    DB::query('UPDATE Kysymys SET sisalto = :sisalto WHERE id = :id', array('id' => $id, 'sisalto' => $kysymys['sisalto']));
  }
   
  // luodaan uusi kysymys
  public static function create($kysymys){ 
    $rows = DB::query('INSERT INTO Kysymys (sisalto, pvm) VALUES(:sisalto, NOW()) RETURNING id', array('sisalto' => $kysymys['sisalto'])); 
    $id = $rows[0]['id'];
    return $id;   
  } 
  
  // tuhotaan kannassa oleva kysymys 
  public static function destroy($id){ 
    DB::query('DELETE FROM Kysymys WHERE id = :id', array('id' => $id));
  }   
}

