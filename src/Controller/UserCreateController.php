<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCreateController extends AbstractController
{
    /**
     * @Route("/create/user, name="user_create")
     */
    public function createAction()
    {

        $user = new User()





        return new Response(
            '<html><body>Chuj</body></html>'
        );
    }
}