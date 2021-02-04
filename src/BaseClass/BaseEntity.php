<?php
namespace App\BaseClass;


/**
 * Clase base para entidades
 *
 * @author Snayder Acero
 */
abstract class BaseEntity 
{
    /**
     * @var int
     * 
     * @ORM\Column(name="Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * Key repository
     */
    protected $id;

	/**
     * Construct
     */
	public function __construct()
	{
		$this->id = 0;
	}
	
    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}