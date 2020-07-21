<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Image;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\SignalementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/animaux")
 */
class AnimalController extends AbstractController
{
    /**
     * @Route("/", name="animal_index", methods={"GET"})
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
            "range" => $range
        ]);
    }
    /**
     * @Route("/new", name="animal_new", methods={"GET","POST"})
     */
    public function new(Request $request, string $uploadDirRelativePath): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('photos')->getData();
            foreach($images as $image){
                if ($image = $form['photo']->getData()) {
                    $filename = bin2hex(random_bytes(6)).'.'.$image->guessExtension();
                try {
                    $image->move($uploadDirRelativePath, $filename);
                } catch (FileException $e) {
                }
                $img = new Image();
                $animal->getImages($filename);
            
            }

        }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animal_show", methods={"GET"})
     */
    public function show(Animal $animal, SignalementRepository $signalementRepository): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'signalements' => $signalementRepository->findBy(['animal' => $animal,
            ['created_at'=> 'DESC']])
        ]);
    }

    /**
     * @Route("/{id}/edit", name="animal_edit", methods={"GET","PUT"})
     */
    public function edit(Request $request, Animal $animal): Response
    {
        $form = $this->createForm(AnimalType::class, $animal, [
            'method' => 'PUT'
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('images')->getData();
            foreach($images as $image){
                $fichierImage = md5(uniqid(). '.'. $image->guessExtension());
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichierImage
                );
                $img = new Image();
                $img->setNom($fichierImage);
                $animal->addImage($img);

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('animal_index');
        }

        return $this->render('animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="animal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Animal $animal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('animal_index');
    }

    /**
     * @Route("/supprime/image/{id}", name="animal_delete_image", methods={"DELETE"})
     *
     */
    public function deleteImage(Image $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        //Vérification de la validité du token
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            $nom = $image->getNom();
            
            //Suppression de fichier sur le disque
            unlink($this->getParameter('images_directory').'/'.$nom);
            
            //suppression de l'entité dans la base de données
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
            
            //Réponse en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalid'], 400);
        };
    }
}
