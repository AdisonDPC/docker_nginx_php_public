<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response,

    App\Models\User_Model;

class User_Controller {

  protected $cContainer;

  public function __construct (Container $cContainer) { $this -> cContainer = $cContainer; }

  public function getall (Request $rRequest, Response $rResponse) {

    $aConfig = $this -> cContainer -> get('config');

    if ($aConfig['db']['driver'] != 'mysql') return 'Error: Not MySQL driver';

    $aParameters = [
      'aPage' =>  [
        'strTitle' => 'Welcome - Slim + Twig',
        'strDescription' => 'Welcome to the oficial page Slim + Twig.',
        'strType' => 'Controller'
      ],
      'aUsers' => $this -> cContainer -> db -> table('users') -> get()
    ];

    return $this -> cContainer -> view -> render($rResponse, 'users.twig', $aParameters);

  }

}
