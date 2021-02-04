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

// entities
use App\Entity\Currency;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase para llevar el log de los movimientos de la caja registradora
 * @author Snayder Acero
 * @ORM\Table(name="Chatbot_IntentsPhrases")
 * @ORM\Entity
 */
class Movements extends BaseEntity
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
     * @ORM\Column(name="type", type="text", nullable=false)
     */
    protected $type;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    protected $quantity;
    /**
     * @var int
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    protected $createdDate;


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
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity():int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param int $createdDate
     *
     * @return self
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }
}