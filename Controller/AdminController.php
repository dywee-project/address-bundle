<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Form\AddressType;
use Dywee\AddressBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminController extends Controller
{
	//un test
    public function tableAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');
        $websiteRepository = $em->getRepository('DyweeWebsiteBundle:Website');
        $website = $websiteRepository->findOneById($this->get('session')->get('activeWebsite'));

        $query = $ar->FindAllForPagination($website);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            25/*limit per page*/
        );

        return $this->render('DyweeAddressBundle:Admin:table.html.twig', array('pagination' => $pagination));
    }

    public function viewAction(Address $address)
    {
        if($address->getWebsite()->getId() != $this->get('session')->get('activeWebsite')->getId())
            throw $this->createNotFoundException('Cette adresse est introuvable');

        $em = $this->getDoctrine()->getManager();
        $or = $em->getRepository('DyweeOrderBundle:BaseOrder');

        //Créer une fonction dans le repository
        $orders = array_merge($or->findByBillingAddress($address), $or->findByShippingAddress($address));

        return $this->render('DyweeAddressBundle:Admin:view.html.twig', array('address' => $address, 'orders' => $orders));
    }
    
    public function addAction(Request $request)
    {
        $address = new Address();

        $form = $this->get('form.factory')->create(new AddressType(), $address);

        $form->remove('email');
        $form->add('email');

        if($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $websiteRepository = $em->getRepository('DyweeWebsiteBundle:Website');
            $website = $websiteRepository->findOneById($this->get('session')->get('activeWebsite'));

            $address->setWebsite($website);

            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('dywee_address_admin_table'));
        }
        return $this->render('DyweeAddressBundle:Admin:add.html.twig', array('form' => $form->createView()));
    }

    public function updateAction(Address $address, Request $request)
    {
        if($address->getWebsite()->getId() != $this->get('session')->get('activeWebsite')->getId())
            throw $this->createNotFoundException('Cette adresse est introuvable');

        $form = $this->get('form.factory')->create(new AddressType(), $address);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

            return $this->redirect($this->generateUrl('dywee_address_admin_table'));
        }

        return $this->render('DyweeAddressBundle:Admin:edit.html.twig', array('address' => $address, 'form' => $form->createView()));

    }

    public function deleteAction(Address $address)
    {
        if($address->getWebsite()->getId() != $this->get('session')->get('activeWebsite')->getId())
            throw $this->createNotFoundException('Cette adresse est introuvable');

        $em = $this->getDoctrine()->getManager();

        $em->remove($address);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Adresse bien supprimée');

        return $this->redirect($this->generateUrl('dywee_address_admin_table'));
    }
}
