<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\SettingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository,SettingRepository $settingRepository): Response
    {
        $adminsettings=$settingRepository->findBy(['id'=>1]);
        return $this->render('user/show.html.twig', [
            'users' => $userRepository->findAll(),
            'adminsettings'=>$adminsettings,
        ]);
    }

    /**
     * @Route("/comments", name="user_comments", methods={"GET"})
     */
    public function comments(UserRepository $userRepository,SettingRepository $settingRepository): Response
    {
        $adminsettings=$settingRepository->findBy(['id'=>1]);
        return $this->render('user/usercomments.html.twig', [
            'users' => $userRepository->findAll(),
            'adminsettings'=>$adminsettings,
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            /** @var  $file */
            $file=$form['Image']->getData();
            if ($file)
            {
                $filename=$this->GenerateUniqueFileName().'.'.$file->guessExtension();
                try
                {
                    $file->move($this->getParameter('image_directory'),$filename);
                }catch (FileException $e){}
                $user->setImage($filename);
            }
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,$id, User $user,SettingRepository $settingRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }
        $adminsettings=$settingRepository->findBy(['id'=>1]);
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'adminsettings'=>$adminsettings,
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @return string
     */
    private  function  GenerateUniqueFileName()
    {
        return md5(uniqid());
    }
}
