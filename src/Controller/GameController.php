<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    #[Route('/game', name: "game")]
    public function game(): Response
    {
        return $this->render('Game/game.html.twig');
    }

    #[Route('/doc', name: "doc")]
    public function doc(): Response
    {
        return $this->render('Game/doc.html.twig');
    }
}
