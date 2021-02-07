<?php
namespace App\BaseClass;

// services
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
// services
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Clase para manejo peticiones REST
 *
 * @author Snayder Acero
 */
abstract class BaseRest
{
    // class Vars
    protected $em;
    protected $request;

    /**
     * Construct
     */
    public function __construct(EntityManagerInterface $em, RequestStack $request)
    {
       $this->em      = $em;
       $this->request = $request;
    }


    /**
     * estandariza Respuesta Cliente
     * @param Object $responseObject
     * @return View
     */
    protected function responseData($responseObject, $responseCode = Response::HTTP_OK)
    {
        $response = View::create($responseObject, $responseCode, []);
        $response->setHeader('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
