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
                'Accessoires pour lanceurs' => 'Accessoires pour lanceurs',
                'Air comprimé et CO2' => 'Air comprimé et CO2',
                'Bagages et housses' => 'Bagages et housses',
                'Canons' => 'Canons',
                'Covoiturage' => 'Covoiturage',
                'Divers' => 'Divers',
                'Kits et packages' => 'Kits et packages',
                'Lanceurs de scénario' => 'Lanceurs de scénario',
                'Lanceur de compétition' => 'Lanceur de compétition',
                'Lanceurs de loisir' => 'Lanceurs de loisir',
                'Loaders et accessoires' => 'Loaders et accessoires',
                'Masques et écrans' => 'Masques et écrans',
                'Recrutements' => 'Recrutements',
                'Tournois' => 'Tournois',
                'Terrains et accessoires' => 'Terrains et accessoires',
                'Vetements de jeu' => 'Vetements de jeu',
            ]])
            ->add('region', ChoiceType::class, ['label' => 'Region','choices' => [
            'Auvergne-Rhône-Alpes' => 'Auvergne-Rhône-Alpes',
            'Bourgogne-Franche-Comté' => 'Bourgogne-Franche-Comté',
            'Bretagne' => 'Bretagne',
            'Centre-Val de Loire' => 'Centre-Val de Loire',
            'Corse' => 'Corse',
            'Grand Est' => 'Grand Est',
            'Hauts-de-France' => 'Hauts-de-France',
            'Ile-de-France' => 'Ile-de-France',
            'Normandie' => 'Normandie',
            'Nouvelle-Aquitaine' => 'Nouvelle-Aquitaine',
            'Occitanie' => 'Occitanie',
            'Pays de la Loire' => 'Pays de la Loire',
            'Provence-Alpes-Côte d’Azur' => 'Provence-Alpes-Côte d’Azur',]])
            ->add('description')
            ->add('price', NumberType::class, ['label' => 'Prix'])
            ->add('brand', ChoiceType::class, ['label' => 'Marque','choices' => [
                'Autres marques' => 'Autres marques',
        'Armotech' => 'Armotech',
        'Azodin' => 'Azodin',
        'Base' => 'Base',
        'BT' => 'BT',
        'Bunker Kings' => 'Bunker Kings',
        'Deadlywind' => 'Deadlywind',
        'DLX' => 'DLX',
        'Dye' => 'Dye',
        'Empire' => 'Empire',
        'GI Sportz/V-Force' => 'GI Sportz/V-Force',
        'HK Army' => 'HK Army',
        'Honorcore' => 'Honorcore',
        'JT' => 'JT',
        'Lapco' => 'Lapco',
        'MacDev' => 'MacDev',
        'Milsig' => 'Milsig',
        'Oubtreak' => 'Oubtreak',
        'Planet Eclipse' => 'Planet Eclipse',
        'Powair' => 'Powair',
        'Proto' => 'Proto',
        'Sly' => 'Sly',
        'Smart Parts/GOG' => 'Smart Parts/GOG',
        'Soger' => 'Soger',
        'Spyder' => 'Spyder',
        'Tiberius' => 'Tiberius',
        'Tippmann/Hammerhead' => 'Tippmann/Hammerhead',
        'Trident' => 'Trident',
        'Valken' => 'Valken',
        'Virtue' => 'Virtue',
        'WGP' => 'WGP',
            ]])
            ->add('useCondition', ChoiceType::class, ['label' => 'Etat','choices' => [
                'Neuf' => 'Neuf',
                'Très bon état' => 'Très bon état',
                'Bon état' => 'Bon état',
                'Satisfaisant' => 'Satisfaisant',
                'Pour pièces' => 'Pour pièces',]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
        ]);
    }
}
