<?php

  $app->get('/', function() {
    HelloWorldController::index();
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
