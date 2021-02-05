<?php
namespace App\Controller\Rest;

// base Class
use App\BaseClass\BaseRest;

// services
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controlador del servicio rest para la caja registradora
 *
 * @author Snayder Acero
 *
 * @Route("/api/cash", name="api_cash_")
 */
class CashController extends BaseRest
{
    // class Vars
    protected $em;

    /**
     * Construct
     */
    public function __construct(EntityManagerInterface $em)
    {
		  $this->em = $em;
    }

    /**
    * @Route("/initialCharge")
    */
    public function initialChargeCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // available User Agents
      $arrResponse = $cashClass->initialChargeCashRegister($arrValues);
      // set Data Response
  		$response->setData($arrResponse);
      // default Return
  		return $response;
    }

    /**
    * @Route("/makePayment")
    */
    public function makePaymentCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // available User Agents
      $arrResponse = $cashClass->transactionCashRegister($valPayment, $valReceived);
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/statusCash")
    */
    public function viewStatusCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // available User Agents
      $arrResponse = array(); //$cashClass->($this->em);
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/removeCharge")
    */
    public function removeChargeCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // available User Agents
      $arrResponse = array(); //$cashClass->($this->em);
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/logCash")
    */
    public function logByDateCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // available User Agents
      $arrResponse = array(); //$cashClass->($this->em);
      // set Data Response
      $response->setData($arrResponse);
      return $response;
    }
}