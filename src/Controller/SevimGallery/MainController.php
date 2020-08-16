<?php

namespace App\Controller\SevimGallery;

use App\Repository\SettingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="sevim_gallery_main")
     */
    public function index(SettingRepository $settingRepository)
    {
        $adminsettings=$settingRepository->findBy(['id'=>1]);
        return $this->render('sevim_gallery/main/index.html.twig', [
            'controller_name' => 'MainController',
            'adminsettings'=>$adminsettings,
        ]);
    }


}
