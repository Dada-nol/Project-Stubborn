<?php

namespace App\Form;

use App\Entity\Stock;
use App\Entity\SweatShirts;
use App\Entity\TailleSweat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('size', EntityType::class, [
                'class' => TailleSweat::class,
                'label' => false,
                'choice_label' => 'size',
                'disabled' => true, // La taille est fixe, pas modifiable
            ])
            // Champ pour entrer le stock correspondant
            ->add('quantity', NumberType::class, [
                'label' => false,
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
