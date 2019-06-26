<?php

namespace Middleware;

use Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response;

class Home_Middleware {

    public function __invoke (Request $rRequest, Response $rResponse, $cNext) {

        $rResponse -> getBody() -> write('BEFORE ');
    
        $rResponse = $cNext($rRequest, $rResponse);
    
        $rResponse -> getBody() -> write(' AFTER');
    
        return $rResponse;
    
    }

}
