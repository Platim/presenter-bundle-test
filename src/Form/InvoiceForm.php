<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Track;
use App\Form\Data\InvoiceData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customerId', EntityType::class, [
                'required' => true,
                'property_path' => 'customer',
                'class' => Customer::class,
            ])
            ->add('billingAddress')
            ->add('billingCity')
            ->add('billingState')
            ->add('billingCountry')
            ->add('billingPostalCode')
            ->add('tracks', CollectionType::class, [
                'required' => true,
                'allow_add' => true,
                'entry_type' => EntityType::class,
                'entry_options' => [
                    'class' => Track::class,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => InvoiceData::class,
        ]);
    }
}
