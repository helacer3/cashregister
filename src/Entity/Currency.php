<?php

/** 
 *
 * @author Snayder Acero <hacero@viajemos.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Energizee\Chatbot\Core\Entity;

// base Class
use App\BaseClass\BaseEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase con la entidad con las monedas disponibles
 * @author Snayder Acero
 * @ORM\Table(name="Chatbot_IntentsPhrases")
 * @ORM\Entity
 */
class Currency extends BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     */
    protected $value;

    /**
     * @var bool
     *
     * @ORM\Column(name="Enabled", type="boolean", length=1, nullable=false)
     */
    protected $enabled;


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value of enabled
     *
     * @return  boolean
     */ 
    public function getEnabled():bool
    {
        return $this->enabled;
    }

    /**
     * Set the value of enabled
     *
     * @param  bool  $enabled
     *
     */ 
    public function setEnabled(bool $enabled)
    {
        $this->enabled = $enabled;
    }
}