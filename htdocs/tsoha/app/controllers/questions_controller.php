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
    $kysymykset = Kysymys::find($id);
    // Renderöidään views/kysymys kansiossa sijaitseva tiedosto index.html muuttujan $kysymykset datalla
    self::render_view('kysymys/show.html', array('kysymykset' => $kysymykset));
  }  
  
  public static function create(){
      self::render_view('kysymys/new.html');
  }
  
  
  public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

    // Luon uuden pelin käyttäjän syöttämien tietojen perusteella kutsumalla Game mallini create metodia
    $id = Kysymys::create(array(
      'sisalto' => $params['sisalto'],
      'opiskelijaNro' => $params['opiskelijaNro']  
    ));

    // Ohjataan käyttäjä pelin esittelysivulle
    self::redirect_to('/kysymys/' . $id, array('message' => 'Kysymys on lisatty!'));
  }  
}

