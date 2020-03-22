<?php


namespace App\Controller;



use App\Entity\Grade;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class GradeAddController extends AbstractController
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
     * @Route("/add-grade", name="add_grade")
     */

    public function addGradeAction(Request $request)
    {
        $grade = new Grade();

        $form = $this->createFormBuilder($grade)
            ->add('artist_name', TextType::class)
            ->add('album_title', TextType::class)
            ->add('value', IntegerType::class, array('attr' => array('min'=>1,'max'=>3)))
            ->add('picture', FileType::class)
            ->add('save', SubmitType::class, ['label' => 'Add grade'])
            ->getForm();


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $session = new Session();
            $user_id = $session->get('user_id');

            $user_repository = $this->getDoctrine()->getRepository(User::class);
            /** @var User $user */
            $user = $user_repository->find($user_id);
            /** @var Grade $grade */
            $grade = $form->getData();

            /** @var UploadedFile $picture */
            $picture = $grade->getPicture();
            $original_name = $picture->getClientOriginalName();
            $grade->setPictureName($original_name);
            $picture->move('assets/images', $original_name);


            $users_grade = $user->getAlbumGrades();
            $users_grade[] = $grade;
            $user->setAlbumGrades($users_grade);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

        }

        return $this->render('form/add-grade-form.html.twig', [
            'add_grade_form' => $form->createView(),
        ]);

    }
}