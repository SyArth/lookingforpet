<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="accueil", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository, Request $request): Response
    {  
        $limit = $request->get("limit",6);
        $page = $request->get("page",1);

        /** @var Paginator $animaux */
            $animaux = $animalRepository->getPaginatedAnimaux(
            $page,
            $limit
        );
        $pages = ceil($animaux->count()/$limit) ;
        $range = range(
            max($page - 3, 1),
            min($page + 3, $pages)
        );

        return $this->render("main/accueil.html.twig",[
            "animaux" => $animaux,
            "pages" => $pages,
            "page" => $page,
            "limit" => $limit,
            "range" => $range,
        ]);
    }
}
