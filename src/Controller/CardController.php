<?php

namespace App\Controller;

use App\Entity\Card;
use App\Form\CardType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/card", name="card_")
 */
class CardController extends AbstractController
{

    /**
     * @Route("/", name="index", methods={"GET","HEAD"})
     */
    public function index()
    {
        $manager = $this->getDoctrine()->getManager();

        $entities = $manager->getRepository(Card::class)->findAll();

        return $this->render('card/list.html.twig', [
            'entities' => $entities,
            'controller_name' => 'CardController',
        ]);
    }

    /*
     * @Route("/create", name="create", methods={"GET","HEAD"})
     */
    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $card = new Card;
        $formCard = $this->createForm(CardType::class, $card,
            [
                'action' => $this->generateUrl('card_create')
            ]
        );

        $cards = $manager->getRepository(Card::class)->findAll();


        $formCard->handleRequest($request);
        if ($formCard->isSubmitted() && $formCard->isValid()) {

            $card->addUser($this->getUser());
            $image = $formCard->get('image')->getData();
            $imageName = 'card-'.uniqid().'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('cards_folder'),
                $imageName
            );

            $card->setImage($imageName);

            $manager->persist($card);
            $manager->flush();
        }

        /*dd($cards);
        die();*/

        return $this->render('card/form.html.twig', [
            'form' => $formCard->createView()
        ]);
    }


    /*
     * @Route("/create", name="store", methods={"POST","PATCH","PUT"})
     */
    /*public function store()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }*/


    /**
     * @Route("/edit", name="edit", methods={"GET","HEAD"})
     */
    public function edit()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }


    /**
     * @Route("/edit", name="update", methods={"POST","PUT"})
     */
    public function update()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }


    /**
     * @Route("/delete", name="delete", methods={"POST","DELETE"})
     */
    public function delete()
    {
        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
        ]);
    }


}
