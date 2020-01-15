<?php
require 'flight/Flight.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$json_data = file_get_contents("php://input");
Flight::set('json_data', $json_data );



Flight::route('/', function(){
	echo "Hello World!";
});

Flight::route('GET /getEUR/@rsd', function($rsd){
    header ("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');
  
	
    $eur = getEURO($rsd);
    
	$array = array($eur);
	echo json_encode($array);
	return false;
});

function getEURO($rsd){

	$html = file_get_contents("https://www.vipsistem.rs/kursna-lista.php");
    $the_start = explode('<div class="rates-table-cell curr">EUR</div><div class="rates-table-cell num">117.0000</div><div class="rates-table-cell num">',$html);
    $the_end = explode('</div><div class="rates-table-cell num">118.5000</div></div>',$the_start[1]);

	$eur = $rsd / (float)$the_end[0];
	$eur = number_format((float)$eur, 2, '.', '');
	
	return $eur;
};


Flight::route('POST /registerUser', function(){
	session_start();
	include "../connect.php";
	header ("Content-Type: application/json; charset=utf-8");
	header('Access-Control-Allow-Origin: *');
	$data_json = Flight::get("json_data");
	$data = json_decode ($data_json);
	if ($data == null){
		response("Nema podataka.");
	} else {
	    if (!property_exists($data,'name')){
			response("Pogrešni podaci prosleđeni.");
		} else {
			$name =$conn->real_escape_string($data->name);
			$surname =$conn->real_escape_string($data->surname);
			$mail =$conn->real_escape_string($data->mail);
			$phone =$conn->real_escape_string($data->phone);
			$password =$conn->real_escape_string($data->password);
			$password = md5($password);

			if (empty($name) || empty($surname) || empty($password) || empty($mail) || empty($phone)){
				response("Sva polja moraju biti popunjena.");
			}

			$sql="INSERT INTO users (name, surname, mail, phone, password) VALUES ('".$name."', '".$surname."', '".$mail."', '".$phone."', '".$password."')";

			if($q=$conn->query($sql)){
				response("Uspesno ste se registrovali! Sada je potrebno da se prijavite.");
			} else {
				response("Greška sa bazom!");
			}

		}
	}	
	}
);

function response($res){
	$array = array("<div class='alert alert-success' >'$res'</div>");
	$json_response = json_encode ($array,JSON_UNESCAPED_UNICODE);
	echo $json_response;
	return false;
}





Flight::start();
