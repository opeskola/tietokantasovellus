<?php

class AnswerController extends BaseController{
  public static function index(){
    //self::check_logged_in();
    
    // Haetaan kaikki vastaukset tietokannasta
    // haetaan kysymykset, koska myös opinto-ohjaajalla on oikeus nähdä ne.
    // Kuitenkin käytetään eri näkymää, koska opinto-ohjaaja ei lisää kysymyksiä, joten hänen
    // näkymässään ei ole lisää kysymys -painiketta
    $kysymykset = Kysymys::all();
    // Renderöidään views/vastaus kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('vastaus/index.html', array('kysymykset' => $kysymykset));
  }
 
  public static function show($id){
    //self::check_logged_in();
    
    // Haetaan kaikki vastaukset tietokannasta
    $vastaus = Vastaus::find($id);
    
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('vastaus/show.html', array('vastaus' => $vastaus));
  }
  
  public static function create(){
    //self::check_logged_in();
    self::render_view('vastaus/new.html');
  }
  
  public static function store(){
    //self::check_logged_in();
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

    $kysymys_id = $params['id'];
    
    
    $attributes = array( 
      'sisalto' => $params['vastaus'],
      'kysymys' => $params['id']
    );
    
    $vastaus = new Vastaus($attributes);
    //$errors = $vastaus->vastaus_errors();
    
    //if(count($errors) == 0){
      // Vastaus on validi, hyva homma!
      $id = Vastaus::create($attributes);  
      self::redirect_to('/kysymys/' . $kysymys_id, array('message' => 'Vastaus on lisätty!'));
    //}else{
    // Kysymyksessä oli jotain vikaa :(
    //  self::render_view('vastaus/new.html', array('errors' => $errors, 'attributes' => $attributes));
    //}
  }  
  
  
  // Vastauksen muokkaaminen (lomakkeen esittäminen)
  public static function edit($id){
    //self::check_logged_in();  
    $vastaus = Vastaus::find($id);

    self::render_view('vastaus/edit.html', array('vastaus' => $vastaus));
  }
  
  // Vastauksen muokkaaminen (lomakkeen käsittely)
  public static function update($id){
    //self::check_logged_in();  
    $params = $_POST;

    $attributes = array(
      'sisalto' => $params['sisalto'],
    );

    $vastaus = new Vastaus($attributes);
    //$errors = $vastaus->errors();

    //if(count($errors) > 0){
    //  self::render_view('vastaus/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    //}else{
      Kysymys::update($id, $attributes);

      self::redirect_to('/vastaus/' . $id, array('message' => 'Vastausta on muokattu onnistuneesti!'));
    //}
  }
  
}

