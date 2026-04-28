<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/home", name: "home")]
    public function home(): Response {
        $firstName = "Martin";
        $lastName = "Lawrence";
        $birthdate = 1962;
        $movies = ["Bad boys", "Big mamma", "Flic de haut vol"];

        return $this->render("home.html.twig", [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "birthdate" => $birthdate,
            "movies" => $movies,
        ]);
    }

    #[Route("/about-us", name: "about_us")]
    public function aboutUs() {
        return $this->render("aboutUs.html.twig");
    }
}
