<?php
/**
 * Created by PhpStorm.
 * User: Olivier
 * Date: 8/05/17
 * Time: 19:14
 */

namespace Dywee\AddressBundle\Service;


use Doctrine\ORM\EntityManager;
use Dywee\AddressBundle\Entity\Address;
use Dywee\AddressBundle\Form\AddressType;
use Dywee\AddressBundle\Form\CompleteAddressType;
use Dywee\OrderCMSBundle\Form\BillingAddressType;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    /** @var FormFactory $formFactory */
    private $formFactory;

    /** @var EntityManager $em */
    private $em;

    /**
     * FormHandler constructor.
     *
     * @param FormFactory   $formFactory
     * @param EntityManager $entityManager
     */
    public function __construct(FormFactory $formFactory, EntityManager $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->em = $entityManager;
    }

    /**
     * @param Address|null $address
     * @param Request      $request
     * @param array        $options
     *
     * @return Address|\Symfony\Component\Form\FormInterface
     */
    public function handleForm(Address $address = null, Request $request, $options = [])
    {
        if (!$address) {
            $address = new Address();
        }

        $form = $this->createForm($address, $request, $options);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $address;
        }

        return $form;
    }

    /**
     * @param null|Address $address
     * @param array        $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm(Address $address = null, $options = [])
    {
        return $this->formFactory->create(BillingAddressType::class, $address, $options);
    }
}