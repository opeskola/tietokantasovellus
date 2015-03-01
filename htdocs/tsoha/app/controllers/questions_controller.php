<?php

// tassa kontrollerissa on funktioita kysymyksiin liittyen, mm. kysymysten haku, 
// lisaaminen, poisto ja muokkaus 
//
// Ne funktiot, joiden nimessa on sana "ohjaaja", koskevat opinto-ohjaajia.
//
// Kaikissa funktioissa tarkistetaan, etta kayttaja (opiskelija tai opinto-ohjaaja)
// on kirjautunut sisaan.

class QuestionController extends BaseController{
  
  // tassa funktiossa haketaan kysymykset tietokannasta ja renderöidaan näkymä
  // opiskelijalle
  public static function index(){
    self::check_logged_in();
    
    
    // kysymyksia voidaan hakea aiheen perusteella
    if(key_exists('aihe', $_GET)){
        $aihe = $_GET['aihe'];
    }else{
        $aihe = NULL;
    }

    // Haetaan kaikki kysymykset tietokannasta. Haku tehdaan rajatusti aiheen
    // perusteella, mikali se annetaan parametriksi.
    $kysymykset = Kysymys::all($aihe);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/index.html', array('kysymykset' => $kysymykset));
  }
  
  // tassa funktiossa haketaan kysymykset tietokannasta ja renderöidaan näkymä
  // opinto-ohjaajalle  
  public static function index_ohjaajat(){
    self::check_ohjaaja_logged_in();
    
    if(key_exists('aihe', $_GET)){
        $aihe = $_GET['aihe'];
    }else{
        $aihe = NULL;
    }
   
    // Haetaan kaikki kysymykset tietokannasta
    $kysymykset = Kysymys::all($aihe);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index_ohjaaja.html 
    // muuttujan $kysymykset datalla
    self::render_view('kysymys/index_ohjaaja.html', array('kysymykset' => $kysymykset));
  }
  
  // esitetaan yksittaisen kysymyksen tiedot (opiskelijalle)
  public static function show($id){
    self::check_logged_in();
    
    // Haetaan kysymys tietokannasta id:n perusteella
    $kysymys = Kysymys::find($id);
    
    // Haetaan vastaus kysymyksen id:n perusteella
    $vastaus = Vastaus::find_answer_with_question_id($id);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto show.html
    // muuttujan $kysymykset datalla
    self::render_view('kysymys/show.html', array('kysymys' => $kysymys, 'vastaus' => $vastaus));
  }
  
  // esitetaan yksittaisen kysymyksen tiedot (opinto-ohjaajalle)
  public static function show_ohjaaja($id){
    self::check_ohjaaja_logged_in();
    
    // Haetaan kysymys tietokannasta id:n perusteella
    $kysymys = Kysymys::find($id);
    
    // Haetaan vastaus kysymyksen id:n perusteella
    $vastaus = Vastaus::find_answer_with_question_id($id);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto show_ohjaaja.html
    // muuttujan $kysymykset datalla
    self::render_view('kysymys/show_ohjaaja.html', array('kysymys' => $kysymys, 'vastaus' => $vastaus));
  } 
  //
  //
  // tata funktiota (metadata($id) ei tarvita. Aikaisemmassa versiossa se oli
  // kaytossa, mutta sita ei otettu mukaan lopulliseen versioon
  //  
//  // kysymyksen yksityiskohtaisemmat tiedot
//  public static function metadata($id){
//      self::check_logged_in();
//      
//      $kysymys = Kysymys::find($id);
//      
//      // siirrytaan sivulle, jossa on kysymyksen ja vastauksen tietoja
//      self::render_view('kysymys/metadata.html', array('kysymys' => $kysymys));
//  }
  //
  //
  
  // Opiskelija luo kysymyksen
  public static function create(){
    self::check_logged_in();
    self::render_view('kysymys/new.html');
  }
  
  // varastoidaan kysymys
  public static function store(){
    self::check_logged_in();
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

    $attributes = array(
      // 'opiskelijaNro' => $params['opiskelijaNro'],
      'sisalto' => $params['sisalto']
      //'pvm' => $params['pvm']
    );
    
    $kysymys = new Kysymys($attributes);
    $errors = $kysymys->errors();
    
    if(count($errors) == 0){
      // Kysymys on validi, hyva homma!
      $id = Kysymys::create($attributes);  
      self::redirect_to('/kysymys/' . $id, array('message' => 'Kysymys on lisätty!'));
    }else{
    // Kysymyksessä oli jotain vikaa :(
      self::render_view('kysymys/new.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }
  
  // Kysymyksen muokkaaminen (lomakkeen esittäminen)
  public static function edit($id){
    self::check_logged_in();  
    $kysymys = Kysymys::find($id);

    self::render_view('kysymys/edit.html', array('kysymys' => $kysymys));
  }
    
  // Kysymyksen muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    self::check_logged_in();  
    $params = $_POST;

    $attributes = array(
      'sisalto' => $params['sisalto'],
    );

    $kysymys = new Kysymys($attributes);
    $errors = $kysymys->errors();

    if(count($errors) > 0){
      self::render_view('kysymys/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      Kysymys::update($id, $attributes);

      self::redirect_to('/kysymys/' . $id, array('message' => 'Kysymystä on muokattu onnistuneesti!'));
    }
  }
  
  // Kysymyksen poistaminen
  public static function destroy($id){
    self::check_logged_in();
    // Kutsutaan Kysymys-malliluokan metodia destroy, joka poistaa kysymyksen annetulla id:llä
    Kysymys::destroy($id);

    // Ohjataan käyttäjä kysymysten listaussivulle ilmoituksen kera
    self::redirect_to('/kysymys', array('message' => 'Kysymys on poistettu onnistuneesti!'));
  }
  
  // Kysymyksen vastauslomakkeen näyttäminen
  public static function answer($id){
    self::check_ohjaaja_logged_in();  
    $kysymys = Kysymys::find($id);

    self::render_view('kysymys/answer.html', array('kysymys' => $kysymys));
  }
}

