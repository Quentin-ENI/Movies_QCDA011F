<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/movies", name: "movies_")]
final class MovieController extends AbstractController
{
    private $moviesDB = [
        "Les Indestructibles",
        "Trainspotting",
        "Retour vers le futur",
        "Dancer in the dark",
        "Eternal sunshine of the spotless mind",
        "Men in Black",
        "Je suis une légende",
        "Big fish"
    ];

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        // Simulation
        $movies = $this->moviesDB;

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(int $id): Response {
        // Simulation
        $movie = $this->moviesDB[$id];

//        dd($movie);

        return $this->render('movie/detail.html.twig', [
            'movie' => $movie
        ]);
    }
}
