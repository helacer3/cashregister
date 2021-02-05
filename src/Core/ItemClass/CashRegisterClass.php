<?php
namespace App\Core\ItemClass;

use Doctrine\ORM\EntityManagerInterface;

/**
 * Clase para interacción con las entidades de la caja registradora
 *
 * @author Snayder Acero
 */
class CashRegisterClass
{
	/**
	* initial Charge Cash Register
	*/
	public function initialChargeCashRegister($arrValues): array {
		// default Response
		$arrResponse = array("status" => "ERROR", "message" => "No se logró realizar la carga inicial");
		// status Cash Register
		$sttCash     = $cshRegister->statusCashRegister();
		// default Response
		$arrResponse = array("status" => "OK", "message" => "Carga inicial Realizada");
		// default Return
		return $arrResponse;
	}

	/**
	* status Cash Register
	*/
	public function statusCashRegister(): array {
		// default Response
		$arrResponse = array("status" => "ERROR", "message" => "No fué posible consultar el estado de la caja", "data" => array());
		// status Cash Register
		$sttCash     = $cshRegister->statusCashRegister();
		// validate Status Cash
		if (count($sttCash) > 0) {
			// default Response
			$arrResponse = array("status" => "OK", "message" => "", "data" => $sttCash);
		}
		// default Return
		return $arrResponse;
	}

	/**
	* transaction Cash Register
	*/
	public function transactionCashRegister($valPayment, $valReceived): array {
		// default Response
		$arrResponse = array("status" => "ERROR", "message" => "No fue posible procesar la transaccion", "data" => array());
		// instance BL
		$cshRegister = new CashRegisterBL();
		// status Cash Register
		$sttCash     = $cshRegister->statusCashRegister();
		// validate Received Value
		if ($valReceived >= $valPayment) {
			// define Return Value
			$retValue = $valReceived - $valPayment;
			// validate Return Value
			if ($retValue > 0) {
				// calculate actual Cash
				$actCash = $cshRegister->calculateActualCash();
				// validate Actual Cash
				if ($actCash >= $retValue) {
					// status Cash Register
					foreach ($sttCash as $cash) {
						// num Items
						$cntItems = 0;
						do {
							// validate Value
							if ($cash->getIdCurrency()->getValue() >= $retValue && $cash->getQuantity() > 0) {
								$cntItems++;
								$retValue -= $cash->getIdCurrency()->getValue();
							}
						} while ($retValue > 0 && $cntItems < $cash->getQuantity());
						// update Cash By Mount
						$cshRegister->updateCashByMount($cash->getIdCurrency()->getValue(), $cntItems, "exit");
					}
					// register Mount
					$cshRegister->updateCashByMount($valPayment, 1, "entry");
				} else {
					$arrResponse = array("status" => "ERROR", "message" => "La caja no tiene suficiente dinero para procesar la devolución, se cancela la transacción", "data" => array());
				}
			} else {
				$arrResponse = array("status" => "OK", "message" => "El valor recibido es igual al valor a pagar, no se realizará ninguna devolución", "data" => array());
			}
		} else {
			$arrResponse = array("status" => "ERROR", "message" => "El valor recibido es menor al valor a pagar", "data" => array());
		}
		// default Return
		return $arrResponse;
	}
}