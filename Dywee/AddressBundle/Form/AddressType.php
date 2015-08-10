<?php

namespace Dywee\AddressBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use libphonenumber\PhoneNumberFormat;

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('companyName',    'text', array('required' => false))
            ->add('firstName',      'text')
            ->add('lastName',       'text')
            ->add('email',          'email')
            ->add('address1',       'text')
            ->add('address2',       'text', array('required' => false))
            ->add('mobile',         'tel')
            ->add('zip',            'text')
            ->add('cityString',     'text')
            ->add('country',      'entity', array(
                'class' => 'DyweeAddressBundle:Country',
                'property' => 'name'
                )
            )
            ->add('save',      'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dywee\AddressBundle\Entity\Address'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dywee_addressbundle_address';
    }
}
