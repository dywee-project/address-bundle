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
            ->add('firstName',      TextType::class)
            ->add('lastName',       TextType::class)
            ->add('number',         TextType::class)
            ->add('box',            TextType::class, array('required' => false))
            ->add('line1',          TextType::class)
            ->add('line2',          TextType::class, array('required' => false))
            ->add('city',           EntityType::class, array(
                'class'         => 'DyweeAddressBundle:City',
                'choice_label'  => 'zipName'
            ))
            ->add('email',          EmailType::class)
            ->add('phone',          PhoneNumberType::class)
            ->add('save',           SubmitType::class)
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
