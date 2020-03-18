<?php


namespace App\Controller;


use App\Entity\Grade;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MyGradesController extends AbstractController
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
     * @Route("/my-grades", name="my_grade")
     */
    public function displayGrades(Request $request)
    {
        $session = new Session();
        $user_id = $session->get('user_id');
        $grade_repository = $this->getDoctrine()->getRepository(User::class);

        /** @var User $user */
        $user = $grade_repository->find($user_id);
        $album_grades = $user->getAlbumGrades();
        $display_grades = [];
        /** @var Grade $album_grades */
        foreach($album_grades as $album_grades)
        {
            $display_grades[] = [
                'title' => $album_grades->getAlbumTitle(),
                'artist' => $album_grades->getArtistName(),
                'grade' => $album_grades->getValue(),
            ];
        }



        return $this->render('my-grades-view.html.twig', [
            'albums' => $display_grades,
        ]);
    }


}