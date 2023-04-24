<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MeController extends AbstractController
{
    private $httpClient;
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/', name: "home")]
    public function home(): Response
    {
        return $this->render('me.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api/quote", name: "quote")]
    public function apiQuote(): Response
    {
        $date = date("Y/m/d");
        $time = date("h:i:sa");
        $apiKey = '6gr6ONv5Ksy0NThDmqHi8w==yClulFS2py4LFWY9';
        $data = $this->httpClient->request('GET', 'https://api.api-ninjas.com/v1/dadjokes?limit=1', [
            'headers' => [
                'X-API-Key' => $apiKey
            ]
        ]);


        $dataResponse = $data->getContent();
        $data = json_decode($dataResponse, true);
        $dataJoke = ["joke from APININJAS.com" => $data[0]["joke"], "time" => $time, "date" => $date];

        $response = new JsonResponse($dataJoke);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
