<?php

namespace App\Controller;

use App\Model\Quote;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class QuoteController extends AbstractController
{
    #[Route('/quote', name: 'app_quote')]
    public function index(SerializerInterface $serializer): Response
    {
        $content = file_get_contents("https://kaamelott.chaudie.re/api/random");

//        $content = $serializer->decode($content, 'json');
//        $quote = $serializer->denormalize($content, Quote::class);

        $quote = $serializer->deserialize($content, Quote::class, 'json');

        return $this->render('quote/index.html.twig', [
            'quote' => $quote,
        ]);
    }
}
