<?php

namespace App\Controller;

use App\Entity\Muscle;
use App\Form\MuscleType;
use App\Repository\MuscleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/muscle")
 */
class MuscleController extends AbstractController
{
    /**
     * @Route("/", name="muscle_index", methods={"GET"})
     */
    public function index(MuscleRepository $muscleRepository): Response
    {
        return $this->render('muscle/index.html.twig', [
            'muscles' => $muscleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="muscle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $muscle = new Muscle();
        $form = $this->createForm(MuscleType::class, $muscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($muscle);
            $entityManager->flush();

            return $this->redirectToRoute('muscle_index');
        }

        return $this->render('muscle/new.html.twig', [
            'muscle' => $muscle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="muscle_show", methods={"GET"})
     */
    public function show(Muscle $muscle): Response
    {
        return $this->render('muscle/show.html.twig', [
            'muscle' => $muscle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="muscle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Muscle $muscle): Response
    {
        $form = $this->createForm(MuscleType::class, $muscle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('muscle_index');
        }

        return $this->render('muscle/edit.html.twig', [
            'muscle' => $muscle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="muscle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Muscle $muscle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$muscle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($muscle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('muscle_index');
    }
}
