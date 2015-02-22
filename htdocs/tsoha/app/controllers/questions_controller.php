<?php

class QuestionController extends BaseController{
  public static function index(){
    self::check_logged_in();
    
    // Haetaan kaikki kysymykset tietokannasta
    $kysymykset = Kysymys::all();
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/index.html', array('kysymykset' => $kysymykset));
  }
  
  public static function show($id){
    self::check_logged_in();
    
    // Haetaan kysymys tietokannasta id:n perusteella
    $kysymys = Kysymys::find($id);
    
    // Haetaan vastaus kysymyksen id:n perusteella
    $vastaus = Vastaus::find_answer_with_question_id($id);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/show.html', array('kysymys' => $kysymys, 'vastaus' => $vastaus));
  } 
  
  // kysymyksen yksityiskohtaisemmat tiedot
  public static function metadata($id){
      self::check_logged_in();
      
      $kysymys = Kysymys::find($id);
      
      // siirrytaan sivulle, jossa on kysymyksen ja vastauksen tietoja
      self::render_view('kysymys/metadata.html', array('kysymys' => $kysymys));
  }
  
  
  public static function create(){
    self::check_logged_in();
    self::render_view('kysymys/new.html');
  }
  
  
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

    // Ohjataan käyttäjä kysymystenn listaussivulle ilmoituksen kera
    self::redirect_to('/kysymys', array('message' => 'Kysymys on poistettu onnistuneesti!'));
  }
  
  // Vastauslomakkeen näyttäminen
  public static function answer($id){
    //self::check_logged_in();  
    $kysymys = Kysymys::find($id);

    self::render_view('kysymys/answer.html', array('kysymys' => $kysymys));
  }
}

