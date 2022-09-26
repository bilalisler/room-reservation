<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cardOwner',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'CardOwner parameter can not be empty'])
                ]
            ])
            ->add('cardNumber',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'CardNumber parameter can not be empty'])
                ]
            ])
            ->add('cardExpiry',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'CardExpiry parameter can not be empty'])
                ]
            ])
            ->add('cardCvc',TextType::class,[
                'constraints' => [
                    new NotBlank(['message' => 'CardCvc parameter can not be empty'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class
        ]);
    }
}
