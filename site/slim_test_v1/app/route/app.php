<?php

use Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response;

$aApp -> get('/', function (Request $rRequest, Response $rResponse) {

    $aParameters = [
        'aPage' =>  [
            'strTitle' => 'Welcome - Slim + Twig',
            'strDescription' => 'Welcome to the oficial page Slim + Twig.'
        ]
    ];

    return $this -> view -> render($rResponse, 'welcome.twig', $aParameters);

});

$aApp -> get('/dd', function () { Kint::dump([1, 'a']); return 'Kint'; });

$aApp -> get('/home', Home_Controller::Class . ':getHome');

$aApp -> get('/pokemon/all/closure', function (Request $rRequest, Response $rResponse) {

    $aParameters = [
        'aPage' =>  [
            'strTitle' => 'Welcome - Slim + Twig',
            'strDescription' => 'Welcome to the oficial page Slim + Twig.',
            'strType' => 'Closure'
        ],
        'aPokemons' => json_decode(file_get_contents($this -> db['path'] . '/pokemons.json'), true)
    ];

    return $this -> view -> render($rResponse, 'pokemons.twig', $aParameters);

});

$aApp -> get('/user/all/controller', User_Controller::Class . ':getall');

$aApp -> get('/user/all/closure', function (Request $rRequest, Response $rResponse) {

    $aParameters = [
        'aPage' =>  [
            'strTitle' => 'Welcome - Slim + Twig',
            'strDescription' => 'Welcome to the oficial page Slim + Twig.',
            'strType' => 'Closure'
        ],
        'aUsers' => $this -> db -> table('users') -> get()
    ];

    return $this -> view -> render($rResponse, 'users.twig', $aParameters);

});

$aApp -> get('/middleware/no', function () { return 'Hello'; });
$aApp -> get('/middleware/yes', function () { return 'Hello'; }) -> add(new \Middleware\Home_Middleware());

$aApp -> get('/parameter-01/{parameter-01}', function (Request $rRequest, Response $rResponse, array $aArgs) {

    $strParameter01 = $aArgs['parameter-01'];

    $rResponse -> getBody() -> write("$strParameter01");

    return $rResponse;

});

$aApp -> get('/parameter-02/{parameter-01}/{parameter-02}', function (Request $rRequest, Response $rResponse, array $aArgs) {

    $strParameter01 = $aArgs['parameter-01'];
    $strParameter02 = $aArgs['parameter-02'];

    $rResponse -> getBody() -> write("$strParameter01, $strParameter02");

    return $rResponse;

});

$aApp -> get('/parameter-03/{parameter-01}/{parameter-02}[/{parameter-03}]', function (Request $rRequest, Response $rResponse, array $aArgs) {

    $strParameter01 = $aArgs['parameter-01'];
    $strParameter02 = $aArgs['parameter-02'];
    $strParameter03 = $aArgs['parameter-03'];

    $rResponse -> getBody() -> write("$strParameter01, $strParameter02, $strParameter03");

    return $rResponse;

});
