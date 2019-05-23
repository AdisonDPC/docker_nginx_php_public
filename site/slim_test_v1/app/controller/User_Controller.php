<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request, 
    Psr\Http\Message\ResponseInterface as Response, 

    App\Models\User_Model;

class User_Controller {

    protected $cContainer;

    public function __construct(Container $cContainer) { $this -> cContainer = $cContainer; }

    public function getall(Request $rRequest, Response $rResponse) {

        $aParameters = [
            'aPage' =>  [
                'strTitle' => 'Welcome - Slim + Twig',
                'strDescription' => 'Welcome to the oficial page Slim + Twig.'
            ],
            'aUsers' => $this -> cContainer -> db -> table('users') -> get()
        ];

        return $this -> cContainer -> view -> render($rResponse, 'users.twig', $aParameters);

    }

}