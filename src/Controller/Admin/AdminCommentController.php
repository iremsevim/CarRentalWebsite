<?php

namespace App\Controller;

use App\Entity\AdminComment;
use App\Form\AdminCommentType;
use App\Repository\AdminCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/comment")
 */
class AdminCommentController extends AbstractController
{
    /**
     * @Route("/", name="admin_comment_index", methods={"GET"})
     */
    public function index(AdminCommentRepository $adminCommentRepository): Response
    {
        return $this->render('admin_comment/index.html.twig', [
            'admin_comments' => $adminCommentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_comment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adminComment = new AdminComment();
        $form = $this->createForm(AdminCommentType::class, $adminComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adminComment);
            $entityManager->flush();

            return $this->redirectToRoute('admin_comment_index');
        }

        return $this->render('admin_comment/new.html.twig', [
            'admin_comment' => $adminComment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_comment_show", methods={"GET"})
     */
    public function show(AdminComment $adminComment): Response
    {
        return $this->render('admin_comment/show.html.twig', [
            'admin_comment' => $adminComment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_comment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdminComment $adminComment): Response
    {
        $form = $this->createForm(AdminCommentType::class, $adminComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_comment_index');
        }

        return $this->render('admin_comment/edit.html.twig', [
            'admin_comment' => $adminComment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_comment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdminComment $adminComment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminComment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adminComment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_comment_index');
    }
}
