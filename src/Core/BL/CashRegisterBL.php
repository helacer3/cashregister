<?php
namespace App\Core\BL;

use App\BaseClass\BaseBL;

// entities
use App\Entity\Currency;
use App\Entity\Movements;
use App\Entity\Cashregister;

/**
 * BL para interacción con las entidades de la caja registradora
 *
 * @author Snayder Acero
 */
class CashRegisterBL extends BaseBL
{

	/**
	* calculate Actual Cash Register
	*/
	public function calculateActualCash() {
		// default Var
		$cshValue = 0;
		try {
			$query = $this->getEntityManager()->createQuery('
				SELECT SUM(c.value * cr.quantity) as valor 
				FROM Cashregister cr
				INNER JOIN Currency::class c
				ON cr.currency_id = c.id
			');
			$cshRegister = $query->getResult();
			// cash Value
			$cshValue = $cshRegister;
		} catch (\Exception $ex) {
			throw $ex;
		}
		// default Return
		return $cshValue;
	}

	/**
	* status Cash Register
	*/
	public function statusCashRegister() {
		// default Var
		$arrResponse = array();
		try {
			$query = $this->getEntityManager()->createQueryBuilder()
				->select('cr')
				->from(CashRegister::class,'cr')
				->orderBy('currency_id', 'ASC')
				->getQuery()
				->getResult();
		} catch (\Exception $ex) {
			throw $ex;
		}
		// default Return
		return $arrResponse;
	}

	/**
	* status Cash Log
	*/
	public function statusCashLog() {
		// default Var
		$arrResponse = array();
		try {
			$query = $this->getEntityManager()->createQueryBuilder()
				->select('cr')
				->from(Movements::class,'m')
				->getQuery()
				->getResult();
		} catch (\Exception $ex) {
			throw $ex;
		}
		// default Return
		return $arrResponse;
	}

	/**
	* update Cash By Mount
	*/
	public function updateCashByMount($numMount, $numQuantity, $strType) {
		// default Var
		$arrResponse = array();
		try {
			$query = $this->getEntityManager()->createQueryBuilder()
				->select('cr')
				->from(Movements::class,'m')
				->getQuery()
				->getResult();
			// register Cash Log
			$this->registerCashLog($numMount, $numQuantity, $strType);
		} catch (\Exception $ex) {
			throw $ex;
		}
		// default Return
		return $arrResponse;
	}

	/**
	* register Cash Log
	*/
	public function registerCashLog($numMount, $numQuantity, $strType):bool {
		// default Var
		$booValidate  = true;
		try {
			$cshLog = new Movements();
			$cshLog->setIdCurrency($numMount);
			$cshLog->setType($strType);
			$cshLog->setQuantity($numQuantity);
			$cshLog->setCreatedDate(new \Datetime());
			$em->persist($cshLog);
			$em->flush();
		} catch (\Exception $ex) {
			$booValidate = false;
			throw $ex;
		}
		// default Return
		return $booValidate;
	}


	/**
	* register Cash Values
	*/
	public function registerCashValues($arrValues):bool {
		// validate Array
		if (count($arrValues) > 0) {
			// iterate Values
			foreach ($arrValues as $value) {
				// register Cash Value
				$this->registerCashValue($value);
			}
		}
	}

	/**
	* register Cash Value
	*/
	public function registerCashValue($value):bool {
		// default Var
		$booValidate  = true;
		try {
			$cshRegister = new Cashregister();
			$cshRegister->setIdCurrency($value->id);
			$cshRegister->setQuantity($value->quantity);
			$em->persist($cshRegister);
			$em->flush();
		} catch (\Exception $ex) {
			$booValidate = false;
			throw $ex;
		}
		// default Return
		return $booValidate;
	}
}