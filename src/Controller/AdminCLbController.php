<?php

namespace App\Controller;
use App\Entity\Club;
use App\Form\ClubType;
use App\Repository\ClubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/clbadmin")
 */
class AdminCLbController extends AbstractController
{
    /**
     * @Route("/adminclb", name="app_adminclb_index")
     */
    public function index(ClubRepository $clubRepository): Response
    {
        return $this->render('admin_c_lb/index.html.twig', [
            'clubs' => $clubRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="app_adminclb_show", methods={"GET"})
     */
    public function show(Club $club): Response
    {
        return $this->render('admin_c_lb/adminclbshow.html.twig', [
            'club' => $club,
        ]);
    }



}
