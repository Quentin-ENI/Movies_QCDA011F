<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route("/movies", name: "movies_")]
final class MovieController extends AbstractController
{

    #[Route('', name: 'list', methods: ['GET'])]
    #[IsGranted("ROLE_USER")]
    public function list(MovieRepository $movieRepository): Response
    {
//        $movies = $movieRepository->findAll();
        $movies = $movieRepository->findAllWithCategories();
//        $movies = $movieRepository->findContainsSubstring("tru");

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    #[IsGranted("ROLE_ADMIN")]
    public function detail(int $id, MovieRepository $movieRepository): Response {
        $movie = $movieRepository->find($id);

        return $this->render('movie/detail.html.twig', [
            'movie' => $movie
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response {
        $movie = new Movie();
        $movieForm = $this->createForm(MovieType::class, $movie, [
                'action' => $this->generateUrl('movies_create'),
                'method' => 'POST'
        ]);
        $movieForm->handleRequest($request);

        if ($movieForm->isSubmitted() && $movieForm->isValid()) {
            // Insérer en base de données
            try {
                $entityManager->persist($movie);
                $entityManager->flush();
                $this->addFlash('success', 'Le film a bien été ajouté');

                return $this->redirectToRoute('movies_detail', ['id' => $movie->getId()]);
            } catch (Exception $e) {
                $this->addFlash('danger', "Le film n'a pas été créé en base de données.\n".$e->getMessage());
            }
        }

        return $this->render('movie/create.html.twig', [
            'movieForm' => $movieForm
        ]);
    }
}
