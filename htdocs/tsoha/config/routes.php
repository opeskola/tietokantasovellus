<?php

  
  // Etusivu (listaussivu opiskelijoille)
  $app->get('/', function(){
    QuestionController::index();
  });  
  
  // Etusivu (listaussivu opinto-ohjaajille)
  $app->get('/index_ohjaajat', function(){
    QuestionController::index_ohjaajat();
  });    
  
  
  
  // tasta alkaa kysymyksiin liittyvat toiminnot
  
  $app->post('/kysymys', function(){
    QuestionController::store();
  });
  
  // Kysymyksen lisäyslomakkeen näyttäminen
  $app->get('/kysymys/new', function(){
    QuestionController::create();	
  });
  
  // Kysymysten listaussivu
  $app->get('/kysymys', function(){
    QuestionController::index();
  });  
  
  // Kysymyksen esittelysivu
  $app->get('/kysymys/:id', function($id){
    QuestionController::show($id);
  });  
  
  $app->get('/kysymys/:id/edit', function($id){
    // Kysymyksen muokkauslomakkeen esittäminen
    QuestionController::edit($id);
  });
  
  $app->get('/kysymys/:id/metadata', function($id){
    // Kysymyksen tarkemmat tiedot
    QuestionController::metadata($id);
  });
  
  $app->post('/kysymys/:id/edit', function($id){
    // Kysymyksen muokkaaminen
    QuestionController::update($id);
  });  

  $app->post('/kysymys/:id/destroy', function($id){
    // Kysymyksen poisto
    QuestionController::destroy($id);
  }); 
  
  $app->get('/kysymys/:id/vastaa', function($id){
    // 
    QuestionController::answer($id);
  });   
  
  $app->post('/kysymys/:id/vastaa', function($id){
    // 
    AnswerController::store($id);
  });
  
  
  
  
  // Kysymyksen esittelysivu opinto-ohjaajille
  $app->get('/ohjaaja/kysymys/:id', function($id){
    QuestionController::show_ohjaaja($id);
  }); 
  
  
  
  
  $app->get('/kysymys/:id/edit_answer', function($id){
    // Kysymykseen vastaaminen
    AnswerController::edit($id);
  });
  
  $app->post('/vastaus/:id/edit', function($id){
    // Kysymyksen muokkaaminen
    AnswerController::update($id);
  });
 
  
//  tasta alkaa vastauksiin liittyvat toiminnot
//  Naita ei tarvita todennakoisesti
//  
//  $app->post('/vastaus', function(){
//    AnswerController::store();
//  });
//  
//  // Vastauksen lisäyslomakkeen näyttäminen
//  $app->get('/vastaus/new', function(){
//    AnswerController::create();	
//  });
//  
//  // Kysymysten ja vastausten listaussivu
//  $app->get('/vastaus', function(){
//    AnswerController::index();
//  });
//  
//  // Vastauksen esittelysivu
//  $app->get('/vastaus/:id', function($id){
//    AnswerController::show($id);
//  }); 
//  
//  $app->get('/vastaus/:id/edit', function($id){
//    // Pelin muokkauslomakkeen esittäminen
//    AnswerController::edit($id);
//  });
//  
//  $app->post('/vastaus/:id/edit', function($id){
//    // Pelin muokkaaminen
//    AnswerController::update($id);
//  }); 
  
  
  // tasta alkaa aihepiireihin liittyvat toiminnot
  
  // naita ei tarvita todennakoisesti, koska aiheita ei ole sittenkaan
  // tarkoitus lisata kayttoliittymasta, vaan riittaa, etta ne lisataan
  // suoraan kantaan yllapitajan toimesta  
  
//  // Aiheiden listaussivu
//  $app->get('/aihepiiri', function(){
//    AihepiiriController::index();
//  });
//  
//  $app->post('/aihepiiri', function(){
//    AihepiiriController::store();
//  });    
//  
//  // Aihepiirin lisäyslomakkeen näyttäminen
//  $app->get('/aihepiiri/new', function(){
//    AihepiiriController::create();	
//  });
  
  // vastausten haku aiheen perusteella
  $app->post('/aihepiiri', function(){
    AihepiiriController::show();
  });
  
  
  
  // Tasta alkaa login-funktiot (opiskelijoille)
  
  $app->get('/login', function(){
    // Kirjautumislomakkeen esittäminen
    UserController::login();
  });

  $app->post('/login', function(){
    // Kirjautumisen käsittely
    UserController::handle_login();
  });
  
  $app->post('/logout', function(){
    UserController::logout();
  });
  

  
  
  // Tasta alkaa login_ohjaaja-funktiot (ohjaajille)
  
  // opinto-ohjaajan sisaankirjautuminen ei toimi, joten tama pitaa fiksata
  
  $app->get('/ohjaaja', function(){
    // Kirjautumislomakkeen esittäminen
    OhjaajaController::login();
  });

  $app->post('/ohjaaja', function(){
    // Kirjautumisen käsittely
    OhjaajaController::handle_login();
  });
  
  $app->post('/ohjaaja', function(){
    OhjaajaController::logout();
  });
