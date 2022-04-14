<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\UploadedFile;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/evenement")
 */
class EvenementController extends AbstractController
{
    /**
     * @Route("/eventlist", name="evenement_index", methods={"GET"})
     */
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /*
    /**
     * @Route("/eventli", name="evenement_list", methods={"GET"})

    public function indexAdmin(EvenementRepository $evenementRepository): Response
    {
        return $this->render('dashboardAdmin/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    } */




    /**
     * @Route("/new", name="evenement_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EvenementRepository $evenementRepository): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $evenement->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            /*$file->move($this->getParameter('images_directory'), $fileName);*/
            $file->move($this->getParameter('kernel.project_dir') .'/public/AdminPart/images',$fileName);
            $evenement->setImage($fileName);
            $em = $this->getDoctrine()->getManager();

            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_event}", name="evenement_show", methods={"GET"})
     */
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    /**
     * @Route("edit/{id_event}", name="evenement_edit", methods={"GET", "POST"})

     */
    public function edit(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $evenement->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('kernel.project_dir') .'/public/AdminPart/images',$fileName);
            $evenement->setImage($fileName);


            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id_event}", name="evenement_delete", methods={"POST"})
     */
    public function delete(Request $request, Evenement $evenement, EvenementRepository $evenementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId_event(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }

        return $this->redirectToRoute('evenement_index', [], Response::HTTP_SEE_OTHER);
    }

}
