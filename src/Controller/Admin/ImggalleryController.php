<?php

namespace App\Controller\Admin;

use App\Entity\Imggallery;
use App\Form\ImggalleryType;
use App\Repository\ArabaRepository;
use App\Repository\ImggalleryRepository;
use PhpParser\Node\Stmt\Else_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Path;

/**
 * @Route("Admin/imggallery")
 */
class ImggalleryController extends AbstractController
{
    /**
     * @Route("/", name="admin_imggallery_index", methods={"GET"})
     */
    public function index(ImggalleryRepository $imggalleryRepository): Response
    {
        return $this->render('admin/imggallery/index.html.twig', [
            'imggalleries' => $imggalleryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="admin_imggallery_new", methods={"GET","POST"})
     */
    public function new(Request $request,$id,ImggalleryRepository $imggalleryRepository, ArabaRepository $arabaRepository): Response
    {
        $imggallery = new Imggallery();
        $form = $this->createForm(ImggalleryType::class, $imggallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && !$form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            /** @var file  $file */
            $file=$form['image']->getData();
            if ($file)
            {
                $filename=$this->GenerateUniqueFileName().'.'.$file->guessExtension();
                try
                {
                    $file->move($this->getParameter('image_directory'),$filename);
                }catch (FileException $e){}
                $imggallery->setImage($filename);
            }



            $entityManager->persist($imggallery);
            $entityManager->flush();

            return $this->redirectToRoute('admin_imggallery_new',['id'=>$id]);
        }

        $images=$imggalleryRepository->findBy(['araba'=>$id]);
        $car=$arabaRepository->find(['id'=>$id]);


        return $this->render('admin/imggallery/new.html.twig', [
            'araba'=>$car,
            'id'=>$id,
            'imggallery' => $imggallery,
            'images'=>$images,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_imggallery_show", methods={"GET"})
     */
    public function show(Imggallery $imggallery): Response
    {
        return $this->render('admin/imggallery/show.html.twig', [
            'imggallery' => $imggallery,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_imggallery_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Imggallery $imggallery): Response
    {
        $form = $this->createForm(ImggalleryType::class, $imggallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imggallery_index');
        }

        return $this->render('admin/imggallery/edit.html.twig', [
            'imggallery' => $imggallery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/{aid}", name="admin_imggallery_delete", methods={"DELETE"})
     */
    public function delete(Request $request,$aid, Imggallery $imggallery): Response
    {
        //echo "araba id ".$aid;
        //die();


        if ($this->isCsrfTokenValid('delete'.$imggallery->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($imggallery);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_imggallery_new',['id'=>$aid]);
    }

    /**
     * @return string
     */
    private  function  GenerateUniqueFileName()
    {
        return md5(uniqid());
    }

}
