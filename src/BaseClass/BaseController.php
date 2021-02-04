<?php
namespace App\BaseClass;

// services
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Clase base para controladores
 *
 * @author Snayder Acero
 */
abstract class BaseController extends AbstractController
{
    // class Vars
    protected EntityManagerInterface $em;
    protected RequestStack           $request;
    
    /**
     * Construct
     * @param EntityManagerInterface $em                  Objeto con la conexión a base de datos
     * @param RequestStack           $request             Objeto con la información del Request
     * @param SessionInterface       $session             Objeto con el servicio de acceso a la información de sessión
     * @param ConfigDataManager      $config              Objeto con el servicio de acceso a los parámetros de configuración
     * @param ContainerInterface     $containerInterface  Objeto con el servicio de acceso a los parámetros de configuración
     */
    public function __construct(EntityManagerInterface $em, RequestStack $request)
    {
        $this->em      = $em;
        $this->request = $request;
    }
}

