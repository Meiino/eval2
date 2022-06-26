<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController{
    #[Route('/vehicule/list' , name:'vehicule_list')]
    public function index(VehiculeRepository $repository) :Response{

        $vehicule = $repository->findAll();

        return $this->render('vehicule/list.html.twig' , [
            'vehicule' => $vehicule
        ]);
    }

    #[Route('/vehicule' , name:'vehicule_new')]
    public function new(Request $request , EntityManagerInterface $manager) :Response{

        $vehicule = new Vehicule();
        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest ($request);
        if($form->isSubmitted() && $form->isValid()){
            $vehicule = $form->getData();

            $manager->persist($vehicule);
            $manager->flush();

        $this->addFlash(
            'success',
            'Votre véhicule a bien été ajouté'
        );

        return $this->redirectToRoute('vehicule_list');
            
        }

        return $this->render('vehicule/new.html.twig' , [
            'form'=> $form->createView()
        ]);
    }

    #[Route('/vehicule/update/{id}' , name:'vehicule_update')]
    public function edit(Vehicule $vehicule, Request $request, EntityManagerInterface $manager) :Response{

        $form = $this->createForm(VehiculeType::class , $vehicule);

        $form->handleRequest ($request);
        if($form->isSubmitted() && $form->isValid()){
            $vehicule = $form->getData();

            $manager->persist($vehicule);
            $manager->flush();

        $this->addFlash(
            'success',
            'Votre véhicule a été modifié avec succès'
        );

        return $this->redirectToRoute('vehicule_list');
            
        }

        return $this->render('vehicule/edit.html.twig' , [
            'form' => $form->createView()
        ]);
    }

    #[Route('/vehicule/delete/{id}' , name:'vehicule_delete')]
    public function delete(EntityManagerInterface $manager, Vehicule $vehicule) :Response{

        $manager->remove($vehicule);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre véhicule a été supprimé avec succès'
        );

        return $this->redirectToRoute('vehicule_list');
    }
}