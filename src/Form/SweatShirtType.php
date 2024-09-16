<?php

namespace App\Form;

use App\Entity\SweatShirts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SweatShirtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
            ])
            ->add('price', NumberType::class, [
                'scale' => 2,  // Permet deux chiffres après la virgule
                'attr' => [
                    'step' => 0.01,  // Autorise les incréments de 0.01
                ],
                'label' => false,
            ])
            ->add('isPromoted', CheckboxType::class, [
                'label' => 'Cocher pour promouvoir ',
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Assert\Image([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, JPG)',
                    ]),
                ],
            ])
            ->add('stocks', CollectionType::class, [
                'entry_type' => StockType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SweatShirts::class,
        ]);
    }
}
