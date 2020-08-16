<?php

namespace App\Controller;

use App\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser())
        {
            $user=$this->getUser();
            if ($user->getRoles()[0]=="Role_Admin")
             return $this->redirectToRoute('admin_admin');
            else
                return $this->redirectToRoute('sevim_gallery_main');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/adminlogin.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/loginuser", name="login_user")
     */
    public function loginuser(AuthenticationUtils $authenticationUtils,SettingRepository $settingRepository): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        $adminsettings=$settingRepository->findBy(['id'=>1]);

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/loginuser.html.twig', ['last_username' => $lastUsername, 'error' => $error,'adminsettings'=>$adminsettings,]);
    }

    /**
     * @Route("admin/login", name="admin_login")
     */
    public function loginadmin(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/adminlogin.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
