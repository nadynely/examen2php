<?php


$routes = new Router;

$routes->get('/conducteurs',            'ConducteursController@index');
$routes->get('/conducteurs/(\d+)',      'ConducteursController@show');
$routes->get('/conducteurs/add',        'ConducteursController@add');
$routes->post('/conducteurs/save',       'ConducteursController@save');
$routes->get('/conducteurs/(\d+)/delete','ConducteursController@delete');

$routes->get('/vehicules',            'VehiculesController@index');
$routes->get('/vehicules/(\d+)',      'VehiculesController@show');
$routes->get('/vehicules/add',        'VehiculesController@add');
$routes->post('/vehicules/save',       'VehiculesController@save');
$routes->get('/vehicules/(\d+)/delete','VehiculesController@delete');

$routes->get('/associations',            'AssociationsController@index');
$routes->get('/associations/add',        'AssociationsController@add');
$routes->post('/associations/save',       'AssociationsController@save');
$routes->get('/associations/(\d+)/delete','AssociationsController@delete');

$routes->get('/',  'PagesController@home');


//Si j'ai le temps de faire exercice 5 : indiquer l'affichage des données dans cette page:

/* $routes->get('/divers',  'PagesController@divers'); */

$routes->run();