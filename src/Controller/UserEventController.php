<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/eventuser")
 */
class UserEventController extends AbstractController
{
    /**
     * @Route("/userevt", name="app_user_event")
     */
    public function index(EvenementRepository  $evenementRepository): Response
    {
        return $this->render('user_event/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id_event}", name="app_usrevent_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('user_event/usereventshow.html.twig', [
            'evenement' => $evenement,
        ]);
    }


}
