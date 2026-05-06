<?php

namespace App\Services;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;

class MovieService
{
    private $entityManager;
    private $mailService;

    public function __construct(
        EntityManagerInterface $entityManager,
        MailService $mailService
    ) {
        $this->entityManager = $entityManager;
        $this->mailService = $mailService;
    }

    public function create(Movie $movie) {
        $this->entityManager->persist($movie);
        $this->entityManager->flush();
        $this->mailService->sendEmail();
    }
}
