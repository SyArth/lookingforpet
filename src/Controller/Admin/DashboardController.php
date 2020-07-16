<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Famille;
use App\Entity\Animal;
use App\Entity\Adresse;
use App\Entity\Image;
use App\Entity\Lieu;
use App\Entity\Puce;
use App\Entity\Signalement;
use App\Entity\Tatouage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Lookingforpet');
    }

    public function configureMenuItems(): iterable
    {

     
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Adresses des membres', 'far fa-map', Adresse::class);
        yield MenuItem::linkToCrud('Familles', 'fas fa-user-friends', Famille::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-paw', Animal::class);
        yield MenuItem::linkToCrud('Photos des animaux', 'fas fa-camera-retro', Image::class);
        yield MenuItem::linkToCrud('Lieu de la disparition', ' 	fas fa-map', Lieu::class);
        yield MenuItem::linkToCrud('Numéro de puce', 'fas fa-sim-card', Puce::class);
        yield MenuItem::linkToCrud('Numéro de tatouage', 'fas fa-pen', Tatouage::class);
        yield MenuItem::linkToCrud('Signalements', 'fas fa-map-marker-alt',Signalement::class);
          
    }
}
