<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Entity\Address;
use Dywee\AddressBundle\Form\CompleteAddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     *
     * @Route(name="address_admin_table", path="admin/address")
     */
    public function tableAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $query = $ar->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            25/*limit per page*/
        );

        return $this->render('DyweeAddressBundle:Admin:table.html.twig', array('pagination' => $pagination));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route(name="address_admin_add", path="admin/address/add")
     */
    public function addAction(Request $request)
    {
        $address = new Address();

        $form = $this->get('form.factory')->create(CompleteAddressType::class, $address);

        if($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_admin_table'));
        }
        return $this->render('DyweeAddressBundle:Admin:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Address $address
     * @return Response
     *
     * @Route(name="address_admin_view", path="admin/address/{id}")
     */
    public function viewAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $or = $em->getRepository('DyweeOrderBundle:BaseOrder');

        //Créer une fonction dans le repository
        $orders = array_merge($or->findByBillingAddress($address), $or->findByShippingAddress($address));

        return $this->render('DyweeAddressBundle:Admin:view.html.twig', array('address' => $address, 'orders' => $orders));
    }

    /**
     * @param Address $address
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @Route(name="address_admin_update", path="admin/address/{id}/update")
     */
    public function updateAction(Address $address, Request $request)
    {
        $form = $this->get('form.factory')->create(CompleteAddressType::class, $address);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

            return $this->redirect($this->generateUrl('address_admin_table'));
        }

        return $this->render('DyweeAddressBundle:Admin:edit.html.twig', array('address' => $address, 'form' => $form->createView()));

    }

    /**
     * @param Address $address
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route(name="address_admin_delete", path="admin/address/{id}/delete")
     */
    public function deleteAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($address);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Adresse bien supprimée');

        return $this->redirect($this->generateUrl('address_admin_table'));
    }
}
