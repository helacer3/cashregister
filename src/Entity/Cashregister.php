<?php
/** 
 *
 * @author Snayder Acero <hacero@viajemos.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Entity;

// base Class
use App\BaseClass\BaseEntity;
// service
use Doctrine\ORM\Mapping as ORM;

// entities
use App\Entity\Currency;

/**
 * Clase con la entidad para guardar el estado actual de la caja registradora
 * @author Snayder Acero
 * @ORM\Table(name="cashregister")
 * @ORM\Entity
 */
class Cashregister extends BaseEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     **/
    protected $idCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="integer", length=5, nullable=false)
     */
    protected $quantity;

    /**
     * @return mixed
     */
    public function getIdCurrency():Currency
    {
        return $this->idCurrency;
    }

    /**
     * @param mixed $idCurrency
     *
     * @return self
     */
    public function setIdCurrency(Currency $idCurrency)
    {
        $this->idCurrency = $idCurrency;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuantity():int
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}