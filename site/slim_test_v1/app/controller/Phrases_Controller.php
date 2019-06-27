<?php

namespace Controller;

use Psr\Container\ContainerInterface as Container,

    Psr\Http\Message\ServerRequestInterface as Request,
    Psr\Http\Message\ResponseInterface as Response;

class Phrases_Controller {

    protected $cContainer;

    private $strName;
    private $fFile;

    public function __construct (Container $cContainer) { 
        $this -> cContainer = $cContainer; 

        $this -> strName = 'phrases.txt';
        $this -> fFile = file($this -> cContainer -> db['path'] . '/' . $this -> strName);
    }

    public function getCount (Request $rRequest, Response $rResponse) {
      return strval(count($this -> fFile));
    }

    public function getRandom (Request $rRequest, Response $rResponse) {
      $iRow = mt_rand(0, count($this -> fFile));

      return $this -> fFile[$iRow];
    }

    public function getRow (Request $rRequest, Response $rResponse, $aArgs) {
      return $this -> fFile[$aArgs['iRow'] - 1];
    }

    public function addRow (Request $rRequest, Response $rResponse, $aArgs) {
      if(file_put_contents($this -> cContainer -> db['path'] . '/' . $this -> strName, $aArgs['strPhrase'] . "\n", FILE_APPEND))
        return 'Success: Add Row.';
      return 'Error: Add Row.';
    }

}
