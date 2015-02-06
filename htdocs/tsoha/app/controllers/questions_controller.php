<?php

class QuestionController extends BaseController{
  public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $kysymykset = Kysymys::all();
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/index.html', array('kysymykset' => $kysymykset));
  }
  
  public static function show($id){
    // Haetaan kaikki pelit tietokannasta
    $kysymys = Kysymys::find($id);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/show.html', array('kysymys' => $kysymys));
  }  
  
  public static function create(){
      self::render_view('kysymys/new.html');
  }
  
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

    $attributes = array(
      'opiskelijaNro' => $params['opiskelijaNro'],
      'sisalto' => $params['sisalto']
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
    $kysymys = Kysymys::find($id);

    self::render_view('kysymys/edit.html', array('kysymys' => $kysymys));
  }
    
  // Pelin muokkaaminen (lomakkeen käsittely)
  public static function update($id){
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
    // Kutsutaan Kysymys-malliluokan metodia destroy, joka poistaa kysymyksen annetulla id:llä
    Kysymys::destroy($id);

    // Ohjataan käyttäjä kysymystenn listaussivulle ilmoituksen kera
    self::redirect_to('/kysymys', array('message' => 'Kysymys on poistettu onnistuneesti!'));
  }  
}

