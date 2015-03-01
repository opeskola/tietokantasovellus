<?php

// tama on kontrolleri opiskelijan sisaan- ja uloskirjautumiseen

class UserController extends BaseController{
  public static function login(){
      self::render_view('users/login.html');
  }
  
  
  // tarkastetaan ovatko kayttajatunnus ja salasana oikeita. Jos eivat ole, niin
  // annetaan virheilmoitus ja pysytaan kirjautumissivulla. Jos tunnukset ovat 
  // oikein, niin ohjataan etusivulle.
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
  
  // tassa on funktio opiskelijan uloskirjautumiseen
  public static function logout(){
    $_SESSION['user'] = null;

    self::redirect_to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }
}

