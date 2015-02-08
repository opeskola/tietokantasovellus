<?php

class UserController extends BaseController{
  public static function login(){
      self::render_view('users/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['opiskelijaNro'], $params['salasana']);

    if(!$user){
      self::redirect_to('/login', array('error' => 'Väärä käyttäjätunnus tai salasana!'));
    }else{
      $_SESSION['user'] = $user->opiskelijaNro;

      self::redirect_to('/', array('message' => 'Tervetuloa takaisin' . $user->nimi . '!'));
    }
  }
  
  public static function logout(){
    $_SESSION['user'] = null;

    self::redirect_to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
}

