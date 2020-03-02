<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserLoginController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function loginAction()
    {
        return new Response(
            '<html><body>Chuj</body></html>'
        );
    }
}