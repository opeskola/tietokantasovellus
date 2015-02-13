<?php

  
  // Etusivu ( listaussivu)
  $app->get('/', function(){
    QuestionController::index();
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
    // Pelin muokkauslomakkeen esittäminen
    QuestionController::edit($id);
  });
  
  $app->get('/kysymys/:id/metadata', function($id){
    // Pelin muokkauslomakkeen esittäminen
    QuestionController::metadata($id);
  });
  
  $app->post('/kysymys/:id/edit', function($id){
    // Pelin muokkaaminen
    QuestionController::update($id);
  });  

  $app->post('/kysymys/:id/destroy', function($id){
    // Kysymyksen poisto
    QuestionController::destroy($id);
  }); 
  
  $app->get('/kysymys/:id/vastaa', function($id){
    // Kysymyksen poisto
    QuestionController::answer($id);
  });   
  
  $app->post('/kysymys/:id/vastaa', function($id){
    // Kysymyksen poisto
    AnswerController::store($id);
  });
 
  
//  // tasta alkaa vastauksiin liittyvat toiminnot
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
  
  // Aiheiden listaussivu
  $app->get('/aihepiiri', function(){
    AihepiiriController::index();
  });
  
  $app->post('/aihepiiri', function(){
    AihepiiriController::store();
  });    
  
  // Aihepiirin lisäyslomakkeen näyttäminen
  $app->get('/aihepiiri/new', function(){
    AihepiiriController::create();	
  });
  
  // Kysymyksen esittelysivu
  $app->get('/aihepiiri/:id', function($id){
    AihepiiriController::show($id);
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
  
  $app->get('/login_ohjaaja', function(){
    // Kirjautumislomakkeen esittäminen
    OhjaajaController::login();
  });

  $app->post('/login_ohjaaja', function(){
    // Kirjautumisen käsittely
    OhjaajaController::handle_login();
  });
  
  $app->post('/logout_ohjaaja', function(){
    OhjaajaController::logout();
  });
  
  
  // Testikamaa

  $app->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $app->get('/suunnitelmat/login', function() {
    HelloWorldController::login();
  });
  
  $app->get('/suunnitelmat/new_questions_list', function() {
    HelloWorldController::new_questions_list();
  });
  
  $app->get('/suunnitelmat/themas', function() {
    HelloWorldController::themas();
  });
  
  $app->get('/suunnitelmat/make_question', function() {
    HelloWorldController::make_question();
  });
  
  $app->get('/suunnitelmat/first_page', function() {
    HelloWorldController::first_page();
  });  
