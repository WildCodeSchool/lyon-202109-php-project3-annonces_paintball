<?php

namespace App\Form;

use App\Entity\Advert;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Proxies\__CG__\App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('category', ChoiceType::class, ['label' => 'Catégorie','choices' => [
                'Accessoires pour lanceurs' => true,
                'Air comprimé et CO2' => true,
                'Bagages et housses' => true,
                'Canons' => true,
                'Covoiturage' => true,
                'Divers' => true,
                'Kits et packages' => true,
                'Lanceurs de scénario' => true,
                'Lanceur de compétition' => true,
                'Lanceurs de loisir' => true,
                'Loaders et accessoires' => true,
                'Masques et écrans' => true,
                'Recrutements' => true,
                'Tournois' => true,
                'Terrains et accessoires' => true,
                'Vetements de jeu' => true,
            ]])
            ->add('description')
            ->add('price', NumberType::class, ['label' => 'Prix'])
            ->add('brand', TextType::class, ['label' => 'Marque'])
            ->add('useCondition', ChoiceType::class, ['label' => 'Etat','choices' => [
                'Neuf' => true,
                'Très bon état' => true,
                'Bon état' => true,
                'Satisfaisant' => true,
                'Pour pièces' => true,]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
        ]);
    }
}
