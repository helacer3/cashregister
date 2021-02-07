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
		$sttCash     = $cshRegister->registerCashValues($arrValues);
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

    /**
	* load Cash Register
	*/
	public function loadCashRegister(): array {
		// default Var
		$arrValues = array();
		// default Response
		$arrResponse   = array("status" => "Error", "message" => "No fue posible consultar el estado actual de la caja", "data" => array());
		// instance BL
		$cshRegister   = new CashRegisterBL();
		// calculate Actual Cash
		$actCashStatus = $cshRegister->statusCashRegister();
		// validate Actual Cash
		if (count($actCashStatus) > 0) {
			// iterate Actual Cash
			foreach ($actCashvalue as $value) {
				// push Array Values
				array_push($arrValues, array($value->getIdCurrency()->getValue() => $value->getQuantity()));
			}
			// set Array Response
			$arrResponse  = array("status" => "OK", "message" => "Estado actual de la caja", "data" => array('crccash' => $arrValues));
		} else {
			// set Array Response
			$arrResponse = array("status" => "Error", "message" => "La caja actualmente está vacia", "data" => array());
		}
		// default Return
		return $arrResponse;
	}


	/**
	* remove Cash Register
	*/
	public function removeCashRegister(): array {
		// default Response
		$arrResponse  = array("status" => "Error", "message" => "No fue posible retirar el dinero de la caja", "data" => array());
		// instance BL
		$cshRegister  = new CashRegisterBL();
		// calculate Actual Cash
		$actCashvalue = $cshRegister->calculateActualCash();
		// validate Actual Cash
		if ($actCashvalue > 0) {
			// remove Cash Values
			if ($cshRegister->removeCashValues()) {
				// set Array Response
				$arrResponse  = array("status" => "OK", "message" => "Se realiza el retiro de todo el dinero de la caja", "data" => array('actCashValue' => $actCashvalue));
			}
		} else {
			$arrResponse  = array("status" => "Error", "message" => "No hay dinero disponible en la caja, para retirar", "data" => array());
		}
		// default Return
		return $arrResponse;
	}

	/**
	* load Log Cash Register
	*/
	public function loadLogCashRegister($logDate): array {
		// default Response
		$arrResponse  = array("status" => "Error", "message" => "No fue posible consultar el log de movimientos", "data" => array());
		// instance BL
		$cshRegister  = new CashRegisterBL();
		// calculate Actual Cash
		$actCashLog   = $cshRegister->statusCashLog($logDate);
		// validate Actual Cash
		if (count($actCashLog) > 0) {
			// set Array Response
			$arrResponse  = array("status" => "OK", "message" => "Log de movimientos realizados desde solicitada: ", "data" => array('actCashLog' => $actCashLog));
		} else {
			$arrResponse  = array("status" => "Error", "message" => "No se encontró histórico de movimientos para la fecha indicada", "data" => array());
		}
		// default Return
		return $arrResponse;
	}

}