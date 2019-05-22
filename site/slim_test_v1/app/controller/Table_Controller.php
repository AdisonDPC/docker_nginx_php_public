<?php

namespace Controller;

use Illuminate\Database\Query\Builder,

    Psr\Http\Message\ServerRequestInterface as Request, 
    Psr\Http\Message\ResponseInterface as Response;

class Table_Controller {

    protected $bTable;

    public function __construct(Builder $bTable) { $this -> bTable = $bTable; }

    public function __invoke (Request $rRequest, Response $rResponse, $mArgs) {

        $aTable = $this -> bTable -> get();

        Kint::dump($aTable);
        die;

        return 'TUTU';

    }

}