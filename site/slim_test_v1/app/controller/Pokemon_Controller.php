<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response,

    App\Models\Pokemon_Model;

class Pokemon_Controller {

  protected $cContainer;

  public function __construct (Container $cContainer) { $this -> cContainer = $cContainer; }

  public function getall (Request $rRequest, Response $rResponse) {

    $aConfig = $this -> cContainer -> get('config');

    $aData = ($aConfig['db']['driver'] == 'json') ? json_decode(file_get_contents($this -> cContainer -> db['path'] . '/' . $this -> cContainer -> db['filename']), true) : $this -> cContainer -> db -> table('pokemons') -> get();

    $aParameters = [
      'aPage' =>  [
        'strTitle' => 'Welcome - Slim + Twig',
        'strDescription' => 'Welcome to the oficial page Slim + Twig.',
        'strType' => 'Controller'
      ],
      'aPokemons' => $aData
    ];

    return $this -> cContainer -> view -> render($rResponse, 'pokemons.twig', $aParameters);

  }

}
