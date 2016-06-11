<?php

namespace Dywee\AddressBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('line1',          null,               array(
                'label' => 'Rue'
            ))
            ->add('number',         TextType::class,    array(
                'label' => 'Numéro'
            ))
            ->add('box',            TextType::class,    array(
                'label' => 'Boite',
                'required' => false
            ))
            //->add('line2',          TextType::class, array('required' => false))
            //->add('other',          TextType::class, array('required' => false))
            //->add('instruction',    TextType::class, array('required' => false))
            ->add('city', EntityType::class, array(
                'class' => 'DyweeAddressBundle:City',
                'choice_label' => 'zipName',
                'attr' => array('class' => 'select2'),
                'label' => 'Ville'
            ))
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
