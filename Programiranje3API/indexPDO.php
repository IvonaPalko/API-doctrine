<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods", "GET,POST");
header("Access-Control-Allow-Headers", "Content-Type");
require 'vendor/autoload.php';

//Read
Flight::route('/read', function(){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,email,ime,prezime,uloga,datumprijave from operater");
	$izraz->execute();
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
});

Flight::route('/read/@id', function($sifra){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,email,ime,prezime,uloga,datumprijave from operater where sifra=:sifra");
	$izraz->execute(array("sifra" => $sifra));
	echo json_encode($izraz->fetch(PDO::FETCH_OBJ));
});

//Create
Flight::route('POST /create', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("insert into operater (email,ime,prezime,uloga,datumprijave) values (:email,:ime,:prezime,:uloga,now())");
	$izraz->execute((array)$o);
	echo "OK";
});

//Update
Flight::route('POST /update', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("update operater set email=:email,ime=:ime,prezime=:prezime,uloga=:uloga where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});

//Delete
Flight::route('POST /delete', function(){
	$o = json_decode(file_get_contents('php://input'));
	$veza = Flight::db();
	$izraz = $veza->prepare("delete from operater where sifra=:sifra;");
	$izraz->execute((array)$o);
	echo "OK";
});

//Search
Flight::route('/search/@uvjet', function($uvjet){
	$veza = Flight::db();
	$izraz = $veza->prepare("select sifra,email,ime,prezime,uloga,datumprijave from operater where concat(ime,' ',prezime) like :uvjet");
	$izraz->execute(array("uvjet" => "%" . $uvjet . "%"));
	echo json_encode($izraz->fetchAll(PDO::FETCH_OBJ));
});

//utility
Flight::map('notFound', function(){
   $poruka=new stdClass();
   $poruka->status="404";
   $poruka->message="Not found";
   echo json_encode($poruka);
});

//lokalno
//Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=P3API;charset=UTF8','root','000000'));
//server
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=P3API;charset=UTF8','root','000000'));

Flight::start();