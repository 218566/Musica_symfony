<?php


namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCreateController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/create/user", name="user_create")
     */

    public function createAction(Request $request)
    {

        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('login', TextType::class)
            ->add('password', PasswordType::class)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create user'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $password = $user->getPassword();
            $hashed_password = md5($password);
            $user->setPassword($hashed_password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return $this->redirectToRoute('user_login');
        }



        return $this->render('form/user-create-form.html.twig', [
            'user_form' => $form->createView(),
        ]);



    }
}