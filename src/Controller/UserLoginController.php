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
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserLoginController extends AbstractController
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
     * @Route("/login", name="user_login")
     */
    public function loginAction(Request $request) {
        $form = $this->createFormBuilder()
            ->add('login', TextType::class)
            ->add('password', PasswordType::class)
            ->add('log_in', SubmitType::class, ['label' => 'Log in'])
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user_repository = $this->getDoctrine()->getRepository(User::class);
            $hashed_password = md5($form->getData()['password']);
            /** @var User $user */
            $user = $user_repository->findOneBy([
                'login' => $form->getData()['login'],
                'password' => $hashed_password,
                ]);

            if(empty($user)) {
                return $this->render('form/user-login-form.html.twig', [
                    'login_form' => $form->createView(),
                    'errors' => 'Nieprawidłowy login lub hasło',
                    'create_user' => 'create/user',
                ]);
            }


            $session = new Session();
            $session->clear();
            $session->start();
            $session->set('user_id', $user->getId());


        }

        return $this->render('form/user-login-form.html.twig', [
            'login_form' => $form->createView(),
            'errors' => '',
            'create_user' => '',
        ]);

    }
}