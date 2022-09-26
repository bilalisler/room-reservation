<?php

namespace App\Form;

use App\Entity\Payment;
use App\Entity\Room;
use App\Request\SearchRoomRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SearchRoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country',TextType::class,[
                'error_bubbling' => true,
            ])
            ->add('city',TextType::class,[
                'error_bubbling' => true,
            ])
            ->add('startDate',DateType::class,[
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('endDate',DateType::class,[
                'input' => 'string',
                'input_format' => 'Y-m-d',
                'widget' => 'single_text',
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('guestCount',IntegerType::class,[
                'error_bubbling' => true,
            ])
        ;

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
            'data_class' => SearchRoomRequest::class
        ]);
    }
}
