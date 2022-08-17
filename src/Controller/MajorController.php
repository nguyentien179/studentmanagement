<?php

namespace App\Controller;

use App\Entity\Major;
use App\Form\MajorType;
use App\Repository\MajorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/major')]
class MajorController extends AbstractController
{
    #[Route('/', name: 'app_major_index', methods: ['GET'])]
    public function index(MajorRepository $majorRepository): Response
    {
        return $this->render('major/index.html.twig', [
            'majors' => $majorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_major_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MajorRepository $majorRepository): Response
    {
        $major = new Major();
        $form = $this->createForm(MajorType::class, $major);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $majorRepository->add($major);
            return $this->redirectToRoute('app_major_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('major/new.html.twig', [
            'major' => $major,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_major_show', methods: ['GET'])]
    public function show(Major $major): Response
    {
        return $this->render('major/show.html.twig', [
            'major' => $major,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_major_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Major $major, MajorRepository $majorRepository): Response
    {
        $form = $this->createForm(MajorType::class, $major);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $majorRepository->add($major);
            return $this->redirectToRoute('app_major_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('major/edit.html.twig', [
            'major' => $major,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_major_delete', methods: ['POST'])]
    public function delete(Request $request, Major $major, MajorRepository $majorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$major->getId(), $request->request->get('_token'))) {
            $majorRepository->remove($major);
        }

        return $this->redirectToRoute('app_major_index', [], Response::HTTP_SEE_OTHER);
    }
}
