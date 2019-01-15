<?php



header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods", "GET,POST");
header("Access-Control-Allow-Headers", "Content-Type");
require 'vendor/autoload.php';





//Read
Flight::route('/read', function(){
    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $repozitorij = $em->getRepository('Operater');
    $operateri = $repozitorij->findAll();


    echo $doctrineBoostrap->getJson($operateri);
});

Flight::route('/read/@id', function($sifra){

    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $operater = $em->find('Operater', $sifra);

    echo $doctrineBoostrap->getJson($operater);
});

//Create
Flight::route('POST /create', function(){
	$o = json_decode(file_get_contents('php://input'));
	$operater = new Operater();
	$operater->setIme($o->ime);
	$operater->setPrezime($o->prezime);
	$operater->setEmail($o->email);
	$operater->setUloga($o->uloga);
	$operater->setLozinka("");
	$operater->setDatumprijave(new DateTime());

    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $em->persist($operater);
    $em->flush();
    echo "OK";
});

//Update
Flight::route('POST /update', function(){
	$o = json_decode(file_get_contents('php://input'));
    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $operater = $em->find('Operater', $o->sifra);
    $operater->setIme($o->ime);
    $operater->setPrezime($o->prezime);
    $operater->setEmail($o->email);
    $operater->setUloga($o->uloga);

    $em->persist($operater);
    $em->flush();
	echo "OK";
});

//Delete
Flight::route('POST /delete', function(){
	$o = json_decode(file_get_contents('php://input'));
    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $operater = $em->find('Operater', $o->sifra);

    $em->remove($operater);
    $em->flush();
    echo "OK";
});

//Search
Flight::route('/search/@uvjet', function($uvjet){
    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $operateri = $em->getRepository('Operater')->createQueryBuilder('o')
        ->where("concat(o.ime, ' ', o.prezime) like :uvjet")
        ->setParameter('uvjet', "%" . $uvjet . "%")
        ->getQuery()
        ->getResult();

    echo $doctrineBoostrap->getJson($operateri);
});


//Read
Flight::route('/mjesto/read', function(){
    $doctrineBoostrap = Flight::entityManager();
    $em = $doctrineBoostrap->getEntityManager();

    $repozitorij = $em->getRepository('Mjesto');
    $operateri = $repozitorij->findAll();


    echo $doctrineBoostrap->getJson($operateri);
});


//utility
Flight::map('notFound', function(){
   $poruka=new stdClass();
   $poruka->status="404";
   $poruka->message="Not found";
   echo json_encode($poruka);
});

require "bootstrap.php";
Flight::register('entityManager', 'DoctrineBoostrap');

Flight::start();