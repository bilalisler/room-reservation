<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservationCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'error_bubbling' => true,
                'required' => true,
                'invalid_message' => 'User was not found',
                'constraints' => [
                    new NotBlank(['message' => 'User parameter can not be empty'])
                ]
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'id',
                'error_bubbling' => true,
                'required' => true,
                'invalid_message' => 'Room was not found',
                'constraints' => [
                    new NotBlank(['message' => 'Room parameter can not be empty'])
                ]
            ])
            ->add('startDate', DateType::class, [
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'StartDate parameter can not be empty'])
                ]
            ])
            ->add('endDate', DateType::class, [
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'EndDate parameter can not be empty'])
                ]
            ])
            ->add('guestCount', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'GuestCount parameter can not be empty'])
                ]
            ])
            ->add('price', NumberType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Price parameter can not be empty'])
                ]
            ])
            ->add('total', NumberType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Total parameter can not be empty'])
                ]
            ])
            ->add('payment', PaymentType::class, [
                'error_bubbling' => true,
                'required' => true,
            ]);

        $builder->get('startDate')->addModelTransformer(new CallbackTransformer(
            function ($dateObj) {
                return $dateObj;
            },
            function ($stringDate) {
                return new \DateTime($stringDate);
            }
        ));

        $builder->get('endDate')->addModelTransformer(new CallbackTransformer(
            function ($dateObj) {
                return $dateObj;
            },
            function ($stringDate) {
                return new \DateTime($stringDate);
            }
        ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class
        ]);
    }
}
