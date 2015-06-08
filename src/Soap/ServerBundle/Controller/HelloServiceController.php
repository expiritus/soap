<?php
/**
 * Created by PhpStorm.
 * User: michail
 * Date: 08.06.15
 * Time: 11:03
 */

namespace Soap\ServerBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloServiceController extends Controller {

    public function serverAction(){

        $dir = $this->get('kernel')->getRootDir().'/../web/wsdl/hello.wsdl';
        $server = new \SoapServer($dir);
        $server->setObject($this->get('hello_service'));

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

    public function clientAction($name){

        $client = new \SoapClient('http://soap/server?wsdl');
        $result = $client->hello($name);
        return new Response($result);

    }
}