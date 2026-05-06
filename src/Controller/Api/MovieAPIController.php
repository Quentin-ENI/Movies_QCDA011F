<?php

namespace App\Controller\Api;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/movies', name: 'api_movies_')]
class MovieAPIController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(
        MovieRepository $movieRepository,
        SerializerInterface $serializer,
    ): JsonResponse {
        $movies = $movieRepository->findAll();

        $data = $serializer->serialize($movies, 'json', [
            'groups' => 'getMovies'
        ]);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
