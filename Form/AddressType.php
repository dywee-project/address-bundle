<?php

namespace Dywee\AddressBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',      TextType::class, array('label' => 'address.firstName'))
            ->add('lastName',       TextType::class, array('label' => 'address.lastName'))
            ->add('line1',          TextType::class, array('label' => 'address.line1'))
            ->add('line2',          TextType::class, array('label' => 'address.line2', 'required' => false))
            ->add('number',         TextType::class, array('label' => 'address.number'))
            ->add('box',            TextType::class, array('label' => 'address.box', 'required' => false))
            ->add('city',           EntityType::class, array(
                'label' => 'address.city',
                'class'         => 'DyweeAddressBundle:City',
                'choice_label'  => 'zipName'
            ))
            ->add('email',          EmailType::class, array('label' => 'address.email'))
            ->add('phone',          PhoneNumberType::class, array('label' => 'address.phone'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\AddressBundle\Entity\Address'
        ));
    }
}
