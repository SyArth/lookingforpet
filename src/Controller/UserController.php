<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
     /**
     * @Route("/user/signalement", name="user_signalement")
     */
    public function signalement(Request $request)
    {
        $animal = new Animal;
        $form = $this->createForm(AnimalType::class, $animal);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $animal->setUser($this->getUser());
            $animal->setActive(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($animal);
            $em->flush();

            return $this->redirectToRoute('user');
        }

        return $this->render('user/signalement.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
