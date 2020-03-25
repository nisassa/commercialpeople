<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
  * @Route("/api") 
  */
class IndexController extends AbstractController
{  
    /**
     * @Route("/", name="base_index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Base/IndexController.php',
            'user' => $this->getUser()->getUsername(),
        ]);
    }
}
