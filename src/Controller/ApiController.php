<?php

namespace App\Controller;

use App\Controller\CardGameController;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ApiController extends AbstractController
{
    #[Route('/api', name: "api")]
    public function api(): Response
    {
        return $this->render('Api/api.html.twig');
    }

    // Show deck
    #[Route('/api/deck', name: "api_deck", methods: ["GET"])]
    public function api_deck(SessionInterface $session, CardGameController $cardGameController): Response
    {
        $drawnCards = $cardGameController->deck_api($session);
        $data = [
            "cards" => $drawnCards,
        ];

        $json = json_encode($data, JSON_PRETTY_PRINT);
        $response = new JsonResponse();
        $response->setJson($json);
        return $response;
    }


    #[Route('/api/deck/shuffle', name: 'api_deck_shuffle', methods: ['POST'])]
    public function api_deck_shuffle(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        $session->remove("cardWithoutDrawn");
        $deck->generateDeck();
        $deck->shuffle();
        $session->set("cardWithoutDrawn", $deck->getArray());

        $data = [
            "cards" => $deck->getArray()
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/deck/draw', name: 'api_deck_draw', methods: ['POST'])]
    public function api_deck_draw(SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        if(!$session->has("cardWithoutDrawn")) {
            $deck->generateDeck();
            $deck->shuffle();
        } else {
            $savedDeck = $session->get("cardWithoutDrawn");
            $deck->wannabeDeck($savedDeck);
        }

        if($deck->getNumberCards() >= 1) {
            $drawnCard = $deck->drawACard()[0]->getCard();
            $cardWithoutDrawn = $deck->getArray();
            $session->set("cardWithoutDrawn", $cardWithoutDrawn);

            $data = [
                "draw" => $drawnCard,
                "numOfCards" => $deck->getNumberCards(),
            ];
        } else {
            $data = [
                "draw" => ["graphic"=>"slut på kort"],
                "numOfCards" => 0,
            ];
        }
        return new JsonResponse($data);
    }

    #[Route('/api/deck/draw/{num<\d+>}', name: 'api_deck_draw_num', methods: ['POST'])]
    public function api_deck_draw_num(int $num, SessionInterface $session): JsonResponse
    {
        $deck = new DeckOfCards();
        if(!$session->has("cardWithoutDrawn")) {
            $deck->generateDeck();
            $deck->shuffle();
        } else {
            $savedDeck = $session->get("cardWithoutDrawn");
            $deck->wannabeDeck($savedDeck);
        }

        if($deck->getNumberCards() >= 1) {
            $cardsDrawn = [];
            for($i = 0; $i < $num; $i++) {
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
        return new JsonResponse($data);
    }
}
