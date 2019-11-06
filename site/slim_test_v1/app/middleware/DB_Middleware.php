<?php

namespace Middleware;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response;

class DB_Middleware {

  protected $cContainer;

  public function __construct (Container $cContainer) { $this -> cContainer = $cContainer; }

  public function __invoke (Request $rRequest, Response $rResponse, $cNext) {

    $aConfig = $this -> cContainer -> get('config');

    $rResponse -> getBody() -> write('Driver is: ' . $aConfig['db']['driver'] . ' ');

    $rResponse = $cNext($rRequest, $rResponse);

    return $rResponse;

  }

}
