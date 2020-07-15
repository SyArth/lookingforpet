<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Animal;

use App\Repository\AnimalRepository;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(AnimalRepository $animalRepository)
    {        
        return $this->render('main/accueil.html.twig', [
            'animaux' => $animalRepository->findAll(),
        ]);
    }
}
