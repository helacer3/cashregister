<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// base Class
use App\BaseClass\BaseController;

class IndexController extends BaseController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', 
        	array (
        	)
        );
    }
}