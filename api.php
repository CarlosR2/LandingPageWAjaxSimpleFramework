<?php
include('functions.php');
include('model.php'); 

global $save_log;
$save_log = false;


////// LOG API CALLS

if($save_log){
	$filename = 'log.txt';
	$fp = fopen($filename, "a");
	//used $content var instead of making new one
	$content = '
	URL '."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'	
	GET:'.print_r($_GET,true).' 
	POST'.print_r($_POST,true);
	fputs($fp, $content . "\r\n");
	fclose($fp);
}




// API CALL: GET parameter op. EX: http://yourdomain.com/api.php?op=api_call


if(!isset($_GET['op'])) {
      ok('No operation defined');
}

$model = new model();
$op = $_GET['op'];







////// API functions router

switch($op) {
	  case 'api_call_post':
	 		api_call_post();
	  case 'api_call_get':
	 		api_call_get();
	 //Add functions here in more cases		
      default:
            ok('Nothing to see here');
            break;
}







////// API functions definition. They call the model in cae they need

function api_call_post(){
	global$model;
	if(!isset($_POST['foo'])) error('foo missing');
	$foo =$_POST['foo'];
	$res = $model->foo($foo);
	if(!$res) error();
	ok($res);	
}

function api_call_get(){
	global$model;
	if(!isset($_GET['foo'])) error('foo missing');
	$foo =$_GET['foo'];
	$res = $model->foo($foo);
	if(!$res) error();
	ok($res);	
}

function send_random_mail(){
	$res = send_mail("subject","MEssage","email@email.com");
	if($res) ok();
	error();
}

// Add your functions here


?>