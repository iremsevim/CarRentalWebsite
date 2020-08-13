<?php

namespace App\Controller\Admin;

use App\Entity\Araba;
use App\Form\ArabaType;
use App\Repository\ArabaRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/araba")
 */
class ArabaController extends AbstractController
{
    /**
     * @Route("/", name="admin_araba_index", methods={"GET"})
     */
    public function index(ArabaRepository $arabaRepository): Response
    {
        return $this->render('admin/araba/index.html.twig', [
            'arabas' => $arabaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_araba_new", methods={"GET","POST"})
     */
    public function new(Request $request,ArabaRepository $arabaRepository,CategoryRepository $categoryRepository): Response
    {
        $araba = new Araba();
        $form = $this->createForm(ArabaType::class, $araba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($araba);
            $entityManager->flush();

            return $this->redirectToRoute('admin_araba_index');
        }

        return $this->render('admin/araba/new.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'arabas' => $arabaRepository->findAll(),
            'araba' => $araba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_araba_show", methods={"GET"})
     */
    public function show(Araba $araba): Response
    {
        return $this->render('admin/araba/show.html.twig', [
            'araba' => $araba,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_araba_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Araba $araba,ArabaRepository $arabaRepository,CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(ArabaType::class, $araba);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_araba_index');
        }

        return $this->render('admin/araba/edit.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'arabas' => $arabaRepository->findAll(),
            'araba' => $araba,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_araba_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Araba $araba): Response
    {
        if ($this->isCsrfTokenValid('delete'.$araba->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($araba);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_araba_index');
    }

}
