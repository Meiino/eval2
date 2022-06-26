<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre' , TextType::class , [
                'attr' => [
                    'class' => 'form-label form-control mt-4']
            ])
            ->add('marque' , ChoiceType::class , [
                'attr' => [
                    'class' => 'form-label form-control mt-4'],
                'choices' => [
                    'Harley Davidson' => 'Harley Davidson',
                    'Triumph' => 'Triumph',
                    'BMW' => 'BMW',
                    'Aprilia' => 'Aprilia'
                ]
            ])
            ->add('modele' , TextType::class, [
                'attr' => [
                    'class' => 'form-label form-control mt-4']
            ])
            ->add('description' , TextareaType::class, [
                'attr' => [
                    'class' => 'form-label form-control mt-4']
            ])
            ->add('photo' , FileType::class , [
                'attr' => [
                    'class' => 'form-label form-control mt-4'],
                'mapped' => false , "required" => false
            ])
            ->add('prix_journalier' , MoneyType::class, [
                'attr' => [
                    'class' => 'form-label form-control mt-4']
            ])
            //->add('date_enregistrement')
            ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
