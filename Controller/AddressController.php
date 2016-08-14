<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Form\AddressType;
use Dywee\AddressBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AddressController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(name="address_user_table", path="member/address")
     */
    public function tableAction()
    {
        $ar = $this->getDoctrine()->getRepository('DyweeAddressBundle:Address');

        $as = $ar->findByUser($this->getUser());

        return $this->render('DyweeAddressBundle:User:table.html.twig', array('addresses' => $as));
    }

    /**
     * @param Address $address
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route(name="address_user_view", path="member/address/{id}")
     */
    public function viewAction(Address $address)
    {
        if($address->getUser() === $this->getUser())
            return $this->render('DyweeAddressBundle:User:view.html.twig', array('addresses' => $address));

        else throw new AccessDeniedException('Vous ne pouvez pas voir cette addresse');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route(name="user_route_add", path="member/address/add")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $address = new Address();
        $address->setUser($this->getUser());

        $form = $this->get('form.factory')->create(new AddressType(), $address);

        if($form->handleRequest($request)->isValid())
        {
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('address_user_table'));
        }
        return $this->render('DyweeAddressBundle:User:add.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Address $address
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route(name="address_user_update", path="member/address/{id}/update")
     */
    public function updateAction(Address $address, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($address)
        {
            if($address->getUser() == $this->getUser())
            {
                $form = $this->get('form.factory')->create(new AddressType(), $address);

                if($form->handleRequest($request)->isValid())
                {
                    $em->persist($address);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

                    return $this->redirect($this->generateUrl('address_user_table'));
                }

                return $this->render('DyweeAddressBundle:User:edit.html.twig', array('address' => $address, 'form' => $form->createView()));
            }
            else throw new AccessDeniedException('Vous ne pouvez pas editer cette adresse');
        }
        else throw $this->createNotFoundException('L\'adresse à éditer est introuvable');
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route(name="address_user_remove", path="member/address/{id}/remove")
     */
    public function deleteAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();

        if($address)
        {
            if($address->getUser() === $this->getUser())
            {
                $em->remove($address);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Adresse bien supprimée');

                return $this->redirect($this->generateUrl('address_user_table'));
            }
            else throw new AccessDeniedException('Vous ne pouvez pas modifier cette addresse');
        }
        else throw $this->createNotFoundException('Cette adresse n\'existe plus');
    }
}
