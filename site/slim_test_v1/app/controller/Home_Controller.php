<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response;

class Home_Controller {

  protected $cContainer;

  public function __construct (Container $cContainer) { $this -> cContainer = $cContainer; }

  public function getHome (Request $rRequest, Response $rResponse) {

    $aParameters = [
      'aPage' =>  [
        'strTitle' => 'Welcome - Slim + Twig',
        'strDescription' => 'Welcome to the oficial page Slim + Twig.'
      ]
    ];

    return $this -> cContainer -> view -> render($rResponse, 'welcome.twig', $aParameters);

  }

}
