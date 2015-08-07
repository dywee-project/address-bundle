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
    public function tableAction(Request $request)
    {
        $ar = $this->getDoctrine()->getManager()->getRepository('DyweeAddressBundle:Address');

        $as = $ar->findBy(
            array(),
            array('id' => 'desc')
        );

        $query = $ar->FindAllForPagination();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page')/*page number*/,
            25/*limit per page*/
        );

        return $this->render('DyweeAddressBundle:Admin:table.html.twig', array('pagination' => $pagination));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');
        $or = $em->getRepository('DyweeOrderBundle:BaseOrder');

        $address = $ar->findOneById($id);

        if($address == null)
            throw new NotFoundHttpException('Cette adresse ne semble pas exister');

        //Créer une fonction dans le repository
        $orders = array_merge($or->findByBillingAddress($address), $or->findByShippingAddress($address));

        return $this->render('DyweeAddressBundle:Admin:view.html.twig', array('address' => $address, 'orders' => $orders));
    }
    
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $address = new Address();

        $form = $this->get('form.factory')->create(new AddressType(), $address);

        $form->remove('email');
        $form->add('email');

        if($form->handleRequest($request)->isValid())
        {
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('dywee_address_admin_table'));
        }
        return $this->render('DyweeAddressBundle:Admin:add.html.twig', array('form' => $form->createView()));
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $address = $ar->findOneById($id);

        if($address != null)
        {
            $form = $this->get('form.factory')->create(new AddressType(), $address);

            if($form->handleRequest($request)->isValid())
            {
                $em->persist($address);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

                return $this->redirect($this->generateUrl('dywee_address_admin_table'));
            }

            return $this->render('DyweeAddressBundle:Admin:edit.html.twig', array('address' => $address, 'form' => $form->createView()));
        }
        throw $this->createNotFoundException('L\'adresse à éditer est introuvable');
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $address = $ar->findOneById($id);

        if($address !== null)
        {
            $em->remove($address);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Adresse bien supprimée');

            return $this->redirect($this->generateUrl('dywee_address_admin_table'));
        }
        throw $this->createNotFoundException('Cette adresse n\'existe plus');
    }
}
