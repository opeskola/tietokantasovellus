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
  
  
  
  // tasta alkaa aihepiireihin liittyvat toiminnot
  
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
