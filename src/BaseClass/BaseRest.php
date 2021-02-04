<?php
namespace App\BaseClass;

// services
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;


/**
 * Clase para manejo peticiones REST
 *
 * @author Snayder Acero
 */
abstract class BaseRest
{

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
