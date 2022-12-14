<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
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
                'invalid_message' => 'User was not found'
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'id',
                'error_bubbling' => true,
                'required' => true,
                'invalid_message' => 'Room was not found'
            ])
            ->add('startDate', DateType::class, [
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true
            ])
            ->add('endDate', DateType::class, [
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true
            ])
            ->add('guestCount', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true
            ])
            ->add('price', NumberType::class, [
                'error_bubbling' => true,
                'required' => true
            ])
            ->add('total', NumberType::class, [
                'error_bubbling' => true,
                'required' => true
            ])
            ->add('createdAt',HiddenType::class, [
                'empty_data' => new \DateTime('now')
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
            'data_class' => Reservation::class,
            'validation_groups' => ['reservation','payment']
        ]);
    }
}
