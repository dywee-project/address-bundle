<?php

namespace Dywee\AddressBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneNumberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('phone_number', \Misd\PhoneNumberBundle\Form\Type\PhoneNumberType::class, array(
                    'widget' => \Misd\PhoneNumberBundle\Form\Type\PhoneNumberType::WIDGET_COUNTRY_CHOICE,
                    'country_choices' => array('FR', 'BE'),
                    'preferred_country_choices' => array('BE'),
                    'label' => 'address.phoneNumber'
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\AddressBundle\Entity\PhoneNumber'
        ));
    }
}
