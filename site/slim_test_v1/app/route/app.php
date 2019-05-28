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

$aApp -> get('/migrate/pokemons/json/to/sql', function () { 
    $aTutu = json_decode(file_get_contents($this -> db['path'] . '/pokemons.json'), true);
    $iTutu = count($aTutu);

    $strHTML  = '';

    $strHTML .= 'CREATE TABLE `pokemons` ( </br>';
    $strHTML .= '    `id` int(11) NOT NULL, </br>';
    $strHTML .= '    `name` varchar(250) NOT NULL, </br>';
    $strHTML .= '    `types` text NOT NULL, </br>';
    $strHTML .= '    `hp` int(11) NOT NULL DEFAULT 0, </br>';
    $strHTML .= '    `attack` int(11) NOT NULL DEFAULT 0, </br>';
    $strHTML .= '    `defense` int(11) NOT NULL DEFAULT 0, </br>';
    $strHTML .= '    `speed` int(11) NOT NULL DEFAULT 0, </br>';
    $strHTML .= '    `special` int(11) NOT NULL DEFAULT 0, </br>';
    $strHTML .= '    `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, </br>';
    $strHTML .= '    `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP </br>';
    $strHTML .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8; </br>';

    $strHTML .= 'INSERT INTO `pokemons` (`id`, `name`, `types`, `hp`, `attack`, `defense`, `speed`, `special`, `created_at`, `updated_at`) VALUES <br>';

    foreach ($aTutu as $mKey => $mValue) {
        $strHTML .= '(';
        $strHTML .= $mValue['id'] . ', ';
        $strHTML .= '"' . $mValue['name'] . '", ';
        $strHTML .= '\''  . json_encode($mValue['types']) . '\', ';
        $strHTML .= $mValue['baseStats']['hp'] . ', ';
        $strHTML .= $mValue['baseStats']['attack'] . ', ';
        $strHTML .= $mValue['baseStats']['defense'] . ', ';
        $strHTML .= $mValue['baseStats']['speed'] . ', ';
        $strHTML .= $mValue['baseStats']['special'] . ', ';
        $strHTML .= '\'2017-08-06 11:47:24\', ';
        $strHTML .= '\'2017-08-06 17:06:57\'';
        $strHTML .= ')';
        $strHTML .= ($mKey < $iTutu - 1) ? ',' : ';';
        $strHTML .= ' <br>';
    }

    $strHTML .= 'ALTER TABLE `pokemons` ADD PRIMARY KEY (`id`); <br>';
    $strHTML .= 'ALTER TABLE `pokemons` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=' . $iTutu . '; <br>';

    return $strHTML;
});

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

$aApp -> get('/pokemon/all/controller', Pokemon_Controller::Class . ':getall');

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

$aApp -> get('/user/all/controller', User_Controller::Class . ':getall');

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
