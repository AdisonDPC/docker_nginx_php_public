<?php

$aContainer = $aApp -> getContainer();

// REGISTER COMPONENT ON CONTAINER.

$aContainer['view'] = function ($cContainer) {

  $aConfig = $cContainer -> get('config')['view'];

  $vViews = new \Slim\Views\Twig($aConfig['path'], $aConfig['twig']);

  $vViews -> addExtension(new \Slim\Views\TwigExtension(
    $cContainer -> router,
    $cContainer -> request -> getUri()
  ));

  return $vViews;

};

// SERVICE FACTORY FOR THE DATABASE (ORM MYSQL ELOQUENT | JSON | TXT).

$aContainer['db'] = function ($cContainer) {

  $mManager = new \Illuminate\Database\Capsule\Manager;

  $aConfig = $cContainer -> get('config')['db'];

  if ($aConfig['driver'] != 'mysql') return $aConfig[$aConfig['driver']];

  $mManager -> addConnection($aConfig[$aConfig['driver']]);

  $mManager -> setAsGlobal();
  $mManager -> bootEloquent();

  return $mManager;

};

$aContainer['Home_Controller'] = function ($cContainer) { return new \Controller\Home_Controller($cContainer); };
$aContainer['User_Controller'] = function ($cContainer) { return new \Controller\User_Controller($cContainer); };
$aContainer['Pokemon_Controller'] = function ($cContainer) { return new \Controller\Pokemon_Controller($cContainer); };
$aContainer['Phrases_Controller'] = function ($cContainer) { return new \Controller\Phrases_Controller($cContainer); };

$aContainer['DB_Middleware'] = function ($cContainer) { return new \Middleware\DB_Middleware($cContainer); };
