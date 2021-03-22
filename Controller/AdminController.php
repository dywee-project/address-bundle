<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Entity\Address;
use Dywee\AddressBundle\Form\CompleteAddressType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route(name="address_admin_table", path="admin/address")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function tableAction(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $query = $ar->findAll();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            25/*limit per page*/
        );

        return $this->render('@DyweeAddressBundle/Admin/table.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @Route(name="address_admin_add", path="admin/address/add")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $address = new Address();

        $form = $this->get('form.factory')->create(CompleteAddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_admin_table'));
        }

        return $this->render('@DyweeAddressBundle/Admin/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(name="address_admin_view", path="admin/address/{id}")
     *
     * @param Address $address
     *
     * @return Response
     */
    public function viewAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $or = $em->getRepository('DyweeOrderBundle:BaseOrder');

        //Créer une fonction dans le repository
        $orders = array_merge($or->findByBillingAddress($address), $or->findByShippingAddress($address));

        return $this->render('@DyweeAddressBundle/Admin/view.html.twig', ['address' => $address, 'orders' => $orders]);
    }

    /**
     * @Route(name="address_admin_update", path="admin/address/{id}/update")
     *
     * @param Address $address
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateAction(Address $address, Request $request)
    {
        $form = $this->get('form.factory')->create(CompleteAddressType::class, $address);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

            return $this->redirect($this->generateUrl('address_admin_table'));
        }

        return $this->render(
            '@DyweeAddressBundle/Admin/edit.html.twig',
            ['address' => $address, 'form' => $form->createView()]
        );
    }

    /**
     * @Route(name="address_admin_delete", path="admin/address/{id}/delete")
     *
     * @param Address $address
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
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
