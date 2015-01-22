<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä	
      self::render_view('helloworld.html');
    }
    
    public static function login(){
      self::render_view('suunnitelmat/login.html');
    }
    
    public static function new_questions_list(){
      self::render_view('suunnitelmat/new_questions_list.html');
    }
    
    public static function themas(){
      self::render_view('suunnitelmat/themas.html');
    }
    
    public static function make_question(){
      self::render_view('suunnitelmat/make_question.html');
    }
    
    public static function first_page(){
      self::render_view('suunnitelmat/first_page.html');
    }
  }
