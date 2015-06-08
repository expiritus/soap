<?php
/**
 * Created by PhpStorm.
 * User: michail
 * Date: 08.06.15
 * Time: 10:56
 */

namespace Soap\ServerBundle\Services;


use Soap\ServerBundle\Entity\Users;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class HelloService {

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function hello($name){

        ini_set("soap.wsdl_cache_enabled", "0");
        $user = new Users();
        $user->setUsername($name);
        $this->em->persist($user);
        $this->em->flush();
        $id = ['id' => $user->getId()];
        return json_encode($id);
    }
}