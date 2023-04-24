<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        $card = new CardGraphic(13, "spades");

        $data = [
            "cardString" => $card->getCard(),
        ];

        return $this->render('Card/card.html.twig', $data);
    }


    #[Route("/deck", name: "deck")]
    public function deck(): Response
    {
        $deck = new DeckOfCards();
        $deck->generateDeck();
        $data = [
            "cards" => $deck->getArray()
        ];

        return $this->render('Card/deck.html.twig', $data);
    }



    #[Route("/deck/api", name: "deckApi")]
    public function deckApi(): string
    {
        $deck = new DeckOfCards();
        $deck->generateDeck();
        $data = [
            "cards" => $deck->getArray()
        ];
        $response = new JsonResponse($data);
        $content = $response->getContent();

        return $content;
    }

    #[Route("/shuffle", name: "shuffle")]
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        $session->remove("cardWithoutDrawn");
        $deck->generateDeck();
        $deck->shuffle();
        $session->set("cardWithoutDrawn", $deck->getArray());


        $data = [
            "cards" => $deck->getArray()
        ];

        return $this->render('Card/shuffle.html.twig', $data);
    }

    #[Route("/draw", name: "draw")]
    public function draw(SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        if (!$session->has("cardWithoutDrawn")) {
            $deck->generateDeck();
            $deck->shuffle();
        } else {
            $savedDeck = $session->get("cardWithoutDrawn");
            $deck->wannabeDeck($savedDeck);
        }

        if ($deck->getNumberCards() >= 1) {
            $drawnCard = $deck->drawACard()[0]->getCard();
            $cardWithoutDrawn = $deck->getArray();
            $session->set("cardWithoutDrawn", $cardWithoutDrawn);

            $data = [
                "draw" => $drawnCard,
                "numOfCards" => $deck->getNumberCards(),
            ];
        } else {
            $data = [
                "draw" => ["graphic" => "slut på kort"],
                "numOfCards" => 0,
            ];
        }

        return $this->render('Card/draw.html.twig', $data);
    }




    #[Route("/draw/{num<\d+>}", name: "drawNum")]
    public function drawNum(int $num, SessionInterface $session): Response
    {
        $deck = new DeckOfCards();
        if (!$session->has("cardWithoutDrawn")) {
            $deck->generateDeck();
            $deck->shuffle();
        } else {
            $savedDeck = $session->get("cardWithoutDrawn");
            $deck->wannabeDeck($savedDeck);
        }

        if ($deck->getNumberCards() >= 1) {
            $cardsDrawn = [];
            for ($i = 0; $i < $num; $i++) {
                $cardsDrawn[] = $deck->drawACard()[0]->getCard();
            }
            $cardWithoutDrawn = $deck->getArray();
            $session->set("cardWithoutDrawn", $cardWithoutDrawn);


            $data = [
                "num" => $num,
                "deck" => $cardsDrawn,
                "numOfCards" => $deck->getNumberCards(),
            ];
        } else {
            $data = [
                "deck" => [["graphic" => "Slut på kort :("]],
                "numOfCards" => 0,
            ];
        }

        return $this->render('Card/drawNum.html.twig', $data);
    }
}
