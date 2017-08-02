<?php

namespace Dywee\AddressBundle\Form;

use Dywee\AddressBundle\Entity\Address;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType as EmailFieldType;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'address.firstName'])
            ->add('lastName', TextType::class, ['label' => 'address.lastName'])
            ->add('line1', TextType::class, ['label' => 'address.line1'])
            ->add('line2', TextType::class, ['label' => 'address.line2', 'required' => false])
            ->add('number', TextType::class, ['label' => 'address.number'])
            ->add('box', TextType::class, ['label' => 'address.box', 'required' => false])
            ->add('city', EntityType::class, [
                'label'        => 'address.city',
                'class'        => 'DyweeAddressBundle:City',
                'choice_label' => 'zipName'
            ])
            ->add('email', EmailFieldType::class, ['label' => 'address.email'])
            ->add('phone', PhoneNumberType::class, ['label' => 'address.phone']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>  Address::class
        ]);
    }
}
