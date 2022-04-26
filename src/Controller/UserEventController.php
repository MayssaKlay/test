<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\Participant;
use App\Form\EvenementType;
use App\Repository\ClubRepository;
use App\Repository\EvenementRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/new", name="new_evenement_user", methods={"GET", "POST"})
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
            $this->addFlash('success', 'Evenement ajouté avec succes !');

            return $this->redirectToRoute('app_usrevent_showall', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_event/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form->createView(),
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


    /**
     * @Route("/all/{id}", name="app_usrevent_showall", methods={"GET"})
     */
    public function show2(Evenement $evenement,EvenementRepository $revent,ParticipantRepository $Rparticipant,$id): Response
    {
        return $this->render('user_event/index.html.twig', [
            'evenements' => $revent->findby(array
            ('club'=>$id)
            ),
            'parts' => $Rparticipant->findAll()
        ]);
    }

/*
    /**
     * @param(idu)
     * @param(ide)
     * @Route("/rejo/{ide}/{idu}", name="rejo", methods={"GET", "POST"})

    public function new($idu,$ide,ParticipantRepository $participantRepository,Request $request,EntityManagerInterface $entityManager): Response
    {
        $parp = new Participant();
        $parp->setIdu($idu);
        $parp->setIde($ide);
        $entityManager->persist($parp);
        $entityManager->flush();

        return $this->redirectToRoute('app_usrevent_show', [
            'id_event'=>$ide
        ], Response::HTTP_SEE_OTHER);


    }*/

    /**
     * @param Request $request
     * @route("evenement/Participer/{ide}" , name="participer")
     */

    function Participer(Request $request, EvenementRepository $repository, $ide):Response{
        $participant=new Participant() ;
        $participant->setIde($ide) ;
        $participant->setIdu(1) ;
        $evenement=$repository->find($ide);
       // $evenement->setNbrparticiMax($nbrparticipants) ;
        $em=$this->getDoctrine()->getManager();
        $em->persist($participant);
        $em->persist($evenement);
        $em->flush();
        return $this->redirectToRoute("app_usrevent_show", [
            'id_event'=>$ide
        ], Response::HTTP_SEE_OTHER);


    }


}
