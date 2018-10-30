<?php

use League\Plates\Engine;
use Sherpa\App\App;
use Zend\Diactoros\Response\HtmlResponse;

//ini_set("display_errors", 1);
//error_reporting(E_ALL);

require __DIR__.'/../../vendor/autoload.php';
    
$app = new App();

$app->addDeclaration(Sherpa\Plates\Declarations::class);

$app->set('renderer.dir', 'templates');

$routerMap = $app->getMap();

$routerMap->get('home', '/', function(Engine $engine){
    return new HtmlResponse($engine->render('hello'));
});

$app->bootstrap();
