<?php
namespace App\Rest;

// base Class
use App\BaseClass\BaseRest;

// services
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controlador del servicio rest para la caja registradora
 *
 * @author Andres Ramirez - Snayder Acero
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
      $response  = new JsonResponse();
      // instance User API
      $agentAPI  = new AgentAPI();
      // available User Agents
      $arrAgents = $agentAPI->availableUserAgentsList($this->em);
      // define Next Agent Chat
      $arrAgents = $agentAPI->defineNextAgentChat($arrAgents);
      dd($arrAgents);
      // set Data Response
  		$response->setData(array('status' => 'OK', "data" => ""));
      // default Return
  		return $response;
    }

    /**
    * @Route("/makePayment")
    */
    public function makePaymentCash()
    {
      // instance Response 
      $response  = new JsonResponse();
      // set Data Response
      $response->setData(array('status' => 'OK', "data" => ""));
      // default Return
      return $response;
    }

    /**
    * @Route("/statusCash")
    */
    public function statuCashByDate()
    {
      // instance Response 
      $response  = new JsonResponse();
      // set Data Response
      $response->setData(array('status' => 'OK', "data" => ""));
      // default Return
      return $response;
    }

    /**
    * @Route("/removeCharge")
    */
    public function removeChargeCash()
    {
      // instance Response 
      $response  = new JsonResponse();
      // set Data Response
      $response->setData(array('status' => 'OK', "data" => ""));
      // default Return
      return $response;
    }
}