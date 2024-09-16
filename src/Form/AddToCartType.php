<?php

namespace App\Form;

use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddToCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stock', EntityType::class, [
                'class' => Stock::class,
                'choice_label' => function (Stock $stock) {
                    return $stock->getSize()->getSize() . ' (En stock : ' . $stock->getQuantity() . ')';
                },
                'label' => 'Choisir une taille disponible',
                'placeholder' => 'Sélectionnez une taille',
                'query_builder' => function ($repo) use ($options) {
                    return $repo->createQueryBuilder('s')
                        ->where('s.product = :product')
                        ->setParameter('product', $options['product']);
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
