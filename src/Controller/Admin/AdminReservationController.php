<?php

namespace App\Controller;

use App\Entity\AdminReservation;
use App\Form\AdminReservationType;
use App\Repository\AdminReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/reservation")
 */
class AdminReservationController extends AbstractController
{
    /**
     * @Route("/", name="admin_reservation_index", methods={"GET"})
     */
    public function index(AdminReservationRepository $adminReservationRepository): Response
    {
        return $this->render('admin_reservation/index.html.twig', [
            'admin_reservations' => $adminReservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_reservation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $adminReservation = new AdminReservation();
        $form = $this->createForm(AdminReservationType::class, $adminReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adminReservation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_reservation_index');
        }

        return $this->render('admin_reservation/new.html.twig', [
            'admin_reservation' => $adminReservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_reservation_show", methods={"GET"})
     */
    public function show(AdminReservation $adminReservation): Response
    {
        return $this->render('admin_reservation/show.html.twig', [
            'admin_reservation' => $adminReservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_reservation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AdminReservation $adminReservation): Response
    {
        $form = $this->createForm(AdminReservationType::class, $adminReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_reservation_index');
        }

        return $this->render('admin_reservation/edit.html.twig', [
            'admin_reservation' => $adminReservation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_reservation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AdminReservation $adminReservation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adminReservation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adminReservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_reservation_index');
    }
}
