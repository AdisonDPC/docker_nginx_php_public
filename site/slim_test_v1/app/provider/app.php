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

// SERVICE FACTORY FOR THE ORM.

$aContainer['db'] = function ($cContainer) {

    $mManager = new \Illuminate\Database\Capsule\Manager;

    $aConfig = $cContainer -> get('config')['db'];

    $mManager -> addConnection($aConfig);

    $mManager -> setAsGlobal();
    $mManager -> bootEloquent();

    return $mManager;

};

$aContainer['Home_Controller'] = function ($cContainer) { return new \Controller\Home_Controller($cContainer); };
$aContainer['User_Controller'] = function ($cContainer) { return new \Controller\User_Controller($cContainer); };
