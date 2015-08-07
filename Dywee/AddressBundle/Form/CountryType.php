<?php

namespace Dywee\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CountryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',   'text')
            ->add('iso',    'text')
            ->add('state',  'choice', array(
                0 => 'Désactivé',
                1 => 'Actif'
            ))
            ->add('vatRate', 'percent')
            ->add('phonePrefix', 'number')
            ->add('defaultCurrency', 'entity', array(
                'class' => 'DyweeCurrencyBundle:Currency',
                'property' => 'name'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\AddressBundle\Entity\Country'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dywee_addressbundle_country';
    }
}
