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
			$cshValue    = $cshRegister->value;
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
	public function statusCashLog($logDate) {
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
			$this->getEntityManager()->persist($cshLog);
			$this->getEntityManager()->flush();
		} catch (\Exception $ex) {
			$booValidate = false;
			throw $ex;
		}
		// default Return
		return $booValidate;
	}

	/**
	* update Cash By Mount
	*/
	public function loadCurrencyByValue($numValue) {
		// default Var
		$objCurrency = null;
		try {
			$objCurrency = $this->getEntityManager()->createQueryBuilder()
				->select('c')
				->from(Currency::class,'c')
				->where('c.value = :value')
				->andWhere('c.enable = :enabled')
				->setParameter('value', $numValue)
				->setParameter('enabled', 1)
				->getQuery()
				->getOneOrNullResult();
		} catch (\Exception $ex) {
			throw $ex;
		}
		// default Return
		return $objCurrency;
	}

	/**
	* register Cash Values
	*/
	public function registerCashValues($arrValues):bool {
		// validate Array
		if (count($arrValues) > 0) {
			// iterate Values
			foreach ($arrValues as $value) {
				// load Currency By Value
				$actCurrency = $this->loadCurrencyByValue($value->quantity);
				// validate Active Currency 
				if ($actCurrency != null) {
					// register Cash Value
					$this->registerCashValue($actCurrency->getId(), $value->quantity);
				}
			}
		}
	}

	/**
	* register Cash Value
	*/
	public function registerCashValue($idCurrency, $curQuantity):bool {
		// default Var
		$booValidate  = true;
		try {
			$cshRegister = new Cashregister();
			$cshRegister->setIdCurrency($idCurrency);
			$cshRegister->setQuantity($curQuantity);
			$this->getEntityManager()->persist($cshRegister);
			$this->getEntityManager()->flush();
		} catch (\Exception $ex) {
			$booValidate = false;
			throw $ex;
		}
		// default Return
		return $booValidate;
	}

	/**
	* remove Cash Values
	*/
	public function removeCashValues():bool {
		// default Var
		$booValidate  = true;
		try {
			$this->getEntityManager()->createQueryBuilder()
					->delete()
					->from(Cashregister::class, 'c')
					->getQuery()
					->execute();
		} catch (\Exception $ex) {
			$booValidate = false;
			throw $ex;
		}
		// default Return
		return $booValidate;
	}
}