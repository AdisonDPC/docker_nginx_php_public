<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request, 
    Psr\Http\Message\ResponseInterface as Response;

class Pokemon_Controller {

    protected $cContainer;

    public function __construct (Container $cContainer) { $this -> cContainer = $cContainer; }

    public function getall (Request $rRequest, Response $rResponse) {

        $aParameters = [
            'aPage' =>  [
                'strTitle' => 'Welcome - Slim + Twig',
                'strDescription' => 'Welcome to the oficial page Slim + Twig.',
                'strType' => 'Controller'
            ],
            'aPokemons' => json_decode(file_get_contents($this -> cContainer -> db['path'] . '/pokemons.json'), true)
        ];

        return $this -> cContainer -> view -> render($rResponse, 'pokemons.twig', $aParameters);

    }

}