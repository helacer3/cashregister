<?php
declare(strict_types=1);

namespace App\BaseClass;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;


/**
 * Base BL
 */
abstract class BaseBL
{

    /**
     * @var EntityManagerInterface
     * 
     * Entity Manager system
     */
    private $em;

    /**
     * class implement
     */
    private $class;


    /**
     * Basic Constructor
     * @param EntityManagerInterface $em Entity Management Symfony, we advise get information to controller
     * @param object $class Class to get repository 
     */
    function __construct(EntityManagerInterface $em,  $class)
    {
        $this->em    = $em;
        $this->class = $class;
    }

    /**
     * Get Class dal
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->em;
    }

    /**
     * @return ObjectRepository
     * 
     * Get Repository Base
     */
    public function getRepository(): ObjectRepository
    {
        return $this->dal->getRepository();
    }

    /**
     * @return QueryBuilder
     * 
     * get repository
     */
    public function getQueryBuilder():QueryBuilder 
    {
        return $this->dal->getQueryBuilder();
    }
}