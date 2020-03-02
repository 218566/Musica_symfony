<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCreateController extends AbstractController
{
    /**
     * @Route("/create/user", name="user_create")
     */
    public function createAction(Request $request)
    {

        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('login', TextType::class)
            ->add('password', TextType::class)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create user'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            dump($user);
            die;
        }



        return $this->render('user-create-form.html.twig', [
            'user_form' => $form->createView(),
        ]);



    }
}