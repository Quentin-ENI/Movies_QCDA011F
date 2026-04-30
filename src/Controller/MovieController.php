<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/movies", name: "movies_")]
final class MovieController extends AbstractController
{

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();
//        $movies = $movieRepository->findContainsSubstring("tru");

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(int $id, MovieRepository $movieRepository): Response {
        $movie = $movieRepository->find($id);

        return $this->render('movie/detail.html.twig', [
            'movie' => $movie
        ]);
    }

    #[Route('/create', methods: ['GET'])]
    public function create(EntityManagerInterface $entityManager): Response {
        $movie = new Movie();
        $movie->setTitle("Trainspotting");
        $movie->setReleaseDate(1996);

        $entityManager->persist($movie);
        $entityManager->flush();

        return $this->redirectToRoute('movies_list');
    }
}
