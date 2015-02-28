<?php

// tama on kontrolleri opinto-ohjaajan sisaan- ja uloskirjautumiseen

class OhjaajaController extends BaseController{
  public static function login(){
      self::render_view('ohjaajat/login.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $ohjaaja = Ohjaaja::authenticate($params['id'], $params['salasana']);

    if(!$ohjaaja){
      self::redirect_to('/ohjaaja', array('error' => 'Väärä käyttäjätunnus tai salasana!'));
    }else{
      $_SESSION['ohjaaja'] = $ohjaaja->id;

      self::redirect_to('/index_ohjaajat', array('message' => 'Tervetuloa takaisin' . $ohjaaja->nimi . '!'));
    }
  }
  
  public static function logout(){
    $_SESSION['ohjaaja'] = null;

    self::redirect_to('/ohjaaja', array('message' => 'Olet kirjautunut ulos!'));
  }
}

