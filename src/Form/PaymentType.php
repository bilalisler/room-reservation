<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cardOwner',TextType::class,[
                'required' => true
            ])
            ->add('cardNumber',TextType::class,[
                'required' => true
            ])
            ->add('cardExpiry',TextType::class,[
                'required' => true
            ])
            ->add('cardCvc',IntegerType::class,[
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
            'validation_groups' => ['payment']
        ]);
    }
}
