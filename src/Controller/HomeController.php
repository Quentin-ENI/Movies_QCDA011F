<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/home", name: "home")]
    public function home(): Response {
        return $this->render("home.html.twig");
    }

    #[Route("/about-us", name: "about_us")]
    public function aboutUs() {
        return $this->render("aboutUs.html.twig");
    }
}
