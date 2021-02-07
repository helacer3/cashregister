<?php
namespace App\Controller\Rest;

// base Class
use App\BaseClass\BaseRest;

// services
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Core\ItemClass\CashRegisterClass;

/**
 * Controlador del servicio rest para la caja registradora
 *
 * @author Snayder Acero
 *
 * @Route("/api/cash", name="api_cash_")
 */
class CashController extends BaseRest
{
    /**
    * @Route("/initialCharge")
    */
    public function initialChargeCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // request Body Content
      $bodContent  = json_decode($this->request->getCurrentRequest()->getContent());
      echo "<pre>";print_r($this->request->getCurrentRequest()->getContent());echo "</pre>";die;
      // request Array Values
      $chrcash     = (property_exists($bodContent, "chrcash")) ? $bodContent->chrcash : array();
      // available User Agents
      $arrResponse = $cashClass->initialChargeCashRegister($chrcash);
      // set Data Response
  		$response->setData($arrResponse);
      // default Return
  		return $response;
    }

    /**
    * @Route("/makePayment", methods={"POST"})
    */
    public function makePaymentCash()
    {
      // instance Response 
      $response     = new JsonResponse();
      // instance User API
      $cashClass    = new CashRegisterClass();
      // request Body Content
      $bodContent   = json_decode($this->request->getCurrentRequest()->getContent());
      // request Value Payment
      $valPayment   = (property_exists($bodContent, "valPayment")) ? $bodContent->valPayment : 0;
      // request Value Received
      $valDelivered = (property_exists($bodContent, "valDelivered")) ? $bodContent->valDelivered : 0;
      // available User Agents
      $arrResponse  = $cashClass->transactionCashRegister($valPayment, $valDelivered);
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/statusCash", methods={"POST"})
    */
    public function viewStatusCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // remove Cash Register
      $arrResponse = $cashClass->statusCashRegister();
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/removeCharge", methods={"POST"})
    */
    public function removeChargeCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // remove Cash Register
      $arrResponse = $cashClass->removeCashRegister();
      // set Data Response
      $response->setData($arrResponse);
      // default Return
      return $response;
    }

    /**
    * @Route("/logCash", methods={"POST"})
    */
    public function logByDateCash()
    {
      // instance Response 
      $response    = new JsonResponse();
      // instance User API
      $cashClass   = new CashRegisterClass();
      // request Body Content
      $bodContent  = json_decode($this->request->getCurrentRequest()->getContent());
      // request Log Date
      $logDate     = (property_exists($bodContent, "logDate")) ? $bodContent->logDate : date("Y-m-d");
      // available User Agents
      $arrResponse = $cashClass->loadLogCashRegister($logDate);
      // set Data Response
      $response->setData($arrResponse);
      return $response;
    }
}