<?php

namespace App\Controller;

use App\Entity\UserExercise;
use App\Form\UserExerciseModalType;
use App\Form\UserExerciseType;
use App\Repository\UserExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/exercise")
 */
class UserExerciseController extends AbstractController
{
    /**
     * @Route("/", name="user_exercise_index", methods={"GET"})
     */
    public function index(UserExerciseRepository $userExerciseRepository): Response
    {
        return $this->render('user_exercise/index.html.twig', [
            'user_exercises' => $userExerciseRepository->findBy([],['priority' => 'desc']),
        ]);
    }

    /**
     * @Route("/new", name="user_exercise_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userExercise = new UserExercise();
        $form = $this->createForm(UserExerciseModalType::class, $userExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userExercise);
            $entityManager->flush();

            return $this->redirectToRoute('program_edit', ['id' => $userExercise->getProgram()->getId()]);
        }

        return $this->redirectToRoute('program_edit', ['id' => $userExercise->getProgram()->getId()]);
    }

    /**
     * @Route("/{id}", name="user_exercise_show", methods={"GET"})
     */
    public function show(UserExercise $userExercise): Response
    {
        return $this->render('user_exercise/show.html.twig', [
            'user_exercise' => $userExercise,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_exercise_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserExercise $userExercise): Response
    {
        $form = $this->createForm(UserExerciseType::class, $userExercise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_exercise_index');
        }

        return $this->render('user_exercise/edit.html.twig', [
            'user_exercise' => $userExercise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_exercise_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserExercise $userExercise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userExercise->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userExercise);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_exercise_index');
    }
}
