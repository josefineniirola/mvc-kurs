<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use App\Card\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

    #[Route('/game', name: "game")]
    public function game(SessionInterface $session): Response
    {
        dump($session->get("cardWithoutDrawn"));
        return $this->render('Game/game.html.twig');
    }

    #[Route('/doc', name: "doc")]
    public function doc(): Response
    {
        return $this->render('Game/doc.html.twig');
    }

    #[Route('/startGame', name: "startGame", methods: ["GET"])]
    public function startGame(): Response
    {
        return $this->render('Game/start.html.twig');
    }
    // private function suckMyDick() {

    // }

    #[Route('/start', name: "start", methods: ['POST'])]
    public function start(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        // skapar en kortlek om det inte finns en
        if (!$session->has("cardWithoutDrawn")) {
            $deck->generateDeck();
            $deck->shuffle();
        } else {
            // om det finns en kortlek så hämtar den kortleken
            $savedDeck = $session->get("cardWithoutDrawn");
            $deck->wannabeDeck($savedDeck);
        }

        // om kortleken har mer än 1 kort
        $playerHand = $session->get("playerHand");
        dump($playerHand);
        // spara det jg får frn session i en variabel
        // loopa igenom det
        // skapa ett kort för varje objekt
        // lägg till i spelarens hand
        if (!$session->has("playerHand")) {
            $playerHand = new CardHand();
        }

        if ($session->has("playerHand")) {
            $playerHand = $session->get("playerHand");
            if (!($playerHand instanceof CardHand)) {
                $playerHand = new CardHand();
            }
        }

        $player = new Player($playerHand);
        $drawCard = $deck->drawACard();

        $playerHand->addCard($drawCard);

        $getPlayerCards = $playerHand->getArray();

        // $player->calculateScore();

        // $playerScore = $player->getScore();

        $cardWithoutDrawn = $deck->getArray();
        $session->set("cardWithoutDrawn", $cardWithoutDrawn);
        $session->set("playerHand", $getPlayerCards);


        $data = [
            "playerHand" => $getPlayerCards,
        ];
        return $this->render('Game/start.html.twig', $data);
    }

    #[Route('/restart', name: "restart", methods: ["POST"])]
    public function restart(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $session->remove("playerCardHand");
        $session->remove("cardWithoutDrawn");
        $deck->generateDeck();
        $deck->shuffle();
        $session->set("cardWithoutDrawn", $deck->getArray());

        return $this->redirectToRoute('game');
        // return $this->render('Game/start.html.twig', $data);
    }

    #[Route('/stop', name: "stop", methods: ["POST"])]
    public function stop(SessionInterface $session): Response
    {
        return $this->redirectToRoute('game');
    }
}
