<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response, JsonResponse};
use App\Service\User\UserManager;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{   
    /**
     * @Route("/register", name="register_new_user", methods={"POST"})
     */
    public function register(Request $request, UserManager $userManager)
    {
        $request = $request->request;
        $user = $userManager->registerUser($request->get('_username'), $request->get('_password'));
        if ($user) {
            return new JsonResponse(["message" => "OK!"], 200);
        }
        return new JsonResponse(["message" => "Bad Request!"], Response::HTTP_BAD_REQUEST);
    }
}
