<?php

class AihepiiriController extends BaseController{
  public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $aiheet = Aihepiiri::all();
    // Renderöidään views/aihepiiri kansiossa sijaitseva tiedosto index.html muuttujan $aiheet datalla
    self::render_view('aihepiiri/index.html', array('aiheet' => $aiheet));
  }
  
  public static function show($id){
    // Haetaan kaikki pelit tietokannasta
    $aiheet = Aihepiiri::find($id);
    // Renderöidään views/aihepiiri kansiossa sijaitseva tiedosto index.html muuttujan $aiheet datalla
    self::render_view('aihepiiri/show.html', array('aiheet' => $aiheet));
  }
  
  public static function create(){
    self::render_view('aihepiiri/new.html');
  }
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

    // Luon uuden aihepiirin käyttäjän syöttämien tietojen perusteella kutsumalla Aihepiiri-mallini create metodia
    $id = Aihepiiri::create(array(
      'id' => $params['id'],  
      'aihe' => $params['aihe']
    ));

    // Ohjataan käyttäjä aihepiirin esittelysivulle
    self::redirect_to('/aihepiiri/' . $id, array('message' => 'Aihepiiri on nyt lisätty!'));
  }
}

