<?php

define('DB_HOST','localhost');
define('DB_NAME','db_name');
define('DB_USER','db_user');
define('DB_PASS','db_pass');



define('URL','');
define('PATH','/home/user/');


include("libraries/mailer/class.phpmailer.php");


function connect_db() {
      $link=mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Error connecting to DB.");
      mysql_select_db(DB_NAME ,$link) or die("Error selecting the DB.");      
      mysql_set_charset('utf8');
      return $link;
}

function sanitize($string) {
      return mysql_real_escape_string($string);
}

function set_session_var($var,$valor) {
      @session_start();
      $_SESSION[$var] = $valor;
}
function destroy_session_vars() {
      @session_start();
      session_destroy();
}



// Functions for the API: returns data

function ok($return = '') {
      $result = Array();
      $result['status'] = true;
      if($return != '') {
            $result['result'] = $return;
      }
      echo json_encode($result);
      exit;
}

function error($info = '') {
      $result = Array();
      $result['status'] = false;
      if($info != '') {
            $result['result'] = $info;
      }
      echo json_encode($result);
      exit;
}






function create_seo_url($input) {

      $output ='';
      $string = $input;
      //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
      $string = strtolower($string);

      $convert_to = array(
          "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
          "v", "w", "x", "y", "z", "a", "a", "a", "a", "A", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i",
          "o", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "a", "b", "b", "p", "a", "e", "e", "",
          "", "", "", "", "", "m", "h", "o", "p", "p", "c", "t", "y", "o", "x", "", "", "", "", "", "",
          "", "", "", ""
      );
      $convert_from= array(
          "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
          "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
          "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
          "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
          "ь", "э", "ю", "я"
      );

      $string =  str_replace($convert_from, $convert_to, $string);

      //Strip any unwanted characters
      $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
      //Clean multiple dashes or whitespaces
      $string = preg_replace("/[\s-]+/", " ", $string);
      //Convert whitespaces and underscore to dash
      $string = preg_replace("/[\s_]/", "-", $string);
      $output = $string;

      return $output;

}


function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
}



function send_mail($subject,$message,$email) {



      $mailer = new PHPMailer();
      $mailer->IsSMTP();
      $mailer->Mailer = "smtp";
      $mailer->Host = "mail.yourdomain.com";//"mail.empresa.com";
      $mailer->Port = 25;
      $mailer->SMTPAuth = true;
      $mailer->SMTPKeepAlive = true;
      $mailer->Username = "info@yourdomain.com";//'correo@empresa.com';  // Change this to your gmail adress
      $mailer->Password = 'yourdomainpass';//'contraseña';  // Change this to your gmail password
      $mailer->From = 'info@yourdomain.com';  // This HAVE TO be your gmail adress
      //$mailer->AddAddress = 'crubiomarti@gmail.com';  // This HAVE TO be your gmail adress
      $mailer->FromName = 'yourdomain'; // This is the from name in the email, you can put anything you like here
      $mailer->IsHTML(true);
      $mailer->AddAddress($email);

      $mailer->Body = $message;
      $mailer->Subject = $subjet;
      // This is where you put the email adress of the person you want to mail

      if(!$mailer->Send()) {
            return false;
      }
      else {
            return true;
      }
}

function curPageURL() {
	 $pageURL = 'http';
	 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	 $pageURL .= "://";
	 if ($_SERVER["SERVER_PORT"] != "80") {
	  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	 } else {
	  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 }
	 return $pageURL;
}




?>
