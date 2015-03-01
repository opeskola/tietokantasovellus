<?php

  
  // Etusivu (listaussivu opiskelijoille)
  $app->get('/', function(){
    QuestionController::index();
  });  
  
  // Etusivu (listaussivu opinto-ohjaajille)
  $app->get('/index_ohjaajat', function(){
    QuestionController::index_ohjaajat();
  });    
  
  
  
  // tasta alkavat kysymyksiin liittyvat reititykset
  
  // kysymyksen varastointi
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
  
  // TAMA EI KAYTOSSA
  $app->get('/kysymys/:id/metadata', function($id){
    // Kysymyksen tarkemmat tiedot
    QuestionController::metadata($id);
  });
  
  // Kysymyksen muokkaus
  $app->post('/kysymys/:id/edit', function($id){
    // Kysymyksen muokkaaminen
    QuestionController::update($id);
  });  

  // Kysymyksen poisto
  $app->post('/kysymys/:id/destroy', function($id){
    // Kysymyksen poisto
    QuestionController::destroy($id);
  }); 
  
  // Kysymykseen vastaaminen
  $app->get('/kysymys/:id/vastaa', function($id){
    // 
    QuestionController::answer($id);
  });   
  
  // Kysymyksen esittelysivu opinto-ohjaajille
  $app->get('/ohjaaja/kysymys/:id', function($id){
    QuestionController::show_ohjaaja($id);
  }); 
  
  
  
  
  
  // Tasta alkavat reititykset, jotka menevat vastauskontrolleriin
  //
  // Kysymyksen vastauksen varastointi
  $app->post('/kysymys/:id/vastaa', function($id){
    // 
    AnswerController::store($id);
  });  
  
  // Vastauksen editointi
  $app->get('/kysymys/:id/edit_answer', function($id){
    AnswerController::edit($id);
  });
  
  // vastauksen muokkaus
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
  
  
  // TAMA EI KAYTOSSA!
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
  

  
  
  // Tasta alkaa login_ohjaaja-funktiot (opinto-ohjaajille)
  
  $app->get('/ohjaaja', function(){
    // Kirjautumislomakkeen esittäminen
    OhjaajaController::login();
  });

  $app->post('/ohjaaja', function(){
    // Kirjautumisen käsittely
    OhjaajaController::handle_login();
  });
  
  $app->post('/ohjaaja/logout', function(){
    OhjaajaController::logout();
  });
