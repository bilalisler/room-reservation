<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\RoomProperty;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class RoomCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('homeType', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'homeType parameter can not be empty'])
                ]
            ])
            ->add('title', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'title parameter can not be empty'])
                ]
            ])
            ->add('totalCapacity', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'totalCapacity parameter can not be empty'])
                ]
            ])
            ->add('totalBathrooms', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'totalBathrooms parameter can not be empty'])
                ]
            ])
            ->add('totalBedrooms', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'totalBedrooms parameter can not be empty'])
                ]
            ])
            ->add('minStayDayCount', IntegerType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'minStayDayCount parameter can not be empty'])
                ]
            ])
            ->add('country', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'country parameter can not be empty'])
                ]
            ])
            ->add('city', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'city parameter can not be empty'])
                ]
            ])
            ->add('address', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'address parameter can not be empty'])
                ]
            ])
            ->add('description', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'description parameter can not be empty'])
                ]
            ])
            ->add('price', NumberType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'price parameter can not be empty'])
                ]
            ])
            ->add('currency', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'currency parameter can not be empty'])
                ]
            ])
            ->add('latitude', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'latitude parameter can not be empty'])
                ]
            ])
            ->add('longitude', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'longitude parameter can not be empty'])
                ]
            ])
            ->add('createdAt',HiddenType::class, [
                'empty_data' => new \DateTime('now')
            ])
            ->add('roomProperties', EntityType::class, [
                'class' => RoomProperty::class,
                'multiple' => true,
                'choice_label' => 'id',
                'error_bubbling' => true,
                'required' => true,
                'invalid_message' => 'roomProperties was not found',
                'constraints' => [
                    new NotBlank(['message' => 'roomProperties parameter can not be empty'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class
        ]);
    }
}
