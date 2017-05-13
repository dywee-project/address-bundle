<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Form\AddressType;
use Dywee\AddressBundle\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function tableAction()
    {
        $ar = $this->getDoctrine()->getManager()->getRepository('DyweeAddressBundle:Address');

        $as = $ar->findBy(
            ['user' => $this->getUser()],
            ['id' => 'desc']
        );

        return $this->render('DyweeAddressBundle:User:table.html.twig', ['addressList' => $as]);
    }

    public function viewAction($id)
    {
        $ar = $this->getDoctrine()->getManager()->getRepository('DyweeAddressBundle:Address');
        $address = $ar->findOneById($id);

        if ($address->getUser() == $this->getUser()) {
            return $this->render('DyweeAddressBundle:User:view.html.twig', ['address' => $address]);
        } else {
            throw new AccessDeniedException('Vous ne pouvez pas voir cette addresse');
        }
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $address = new Address();
        $address->setUser($this->getUser());

        $form = $this->get('form.factory')->create(new AddressType(), $address);

        $form->remove('email');
        $form->add('email');

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('dywee_address_user_table'));
        }

        return $this->render('DyweeAddressBundle:User:add.html.twig', ['form' => $form->createView()]);
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $address = $ar->findOneById($id);

        if ($address != null) {
            if ($address->getUser() == $this->getUser()) {
                $form = $this->get('form.factory')->create(new AddressType(), $address);

                if ($form->handleRequest($request)->isValid()) {
                    $em->persist($address);
                    $em->flush();

                    $request->getSession()->getFlashBag()->add('success', 'Adresse bien modifiée');

                    return $this->redirect($this->generateUrl('dywee_address_user_table'));
                }

                return $this->render('DyweeAddressBundle:User:edit.html.twig', ['address' => $address, 'form' => $form->createView()]);
            } else throw new AccessDeniedException('Vous ne pouvez pas editer cette adresse');
        } else throw $this->createNotFoundException('L\'adresse à éditer est introuvable');
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ar = $em->getRepository('DyweeAddressBundle:Address');

        $address = $ar->findOneById($id);

        if ($address !== null) {
            if ($address->getUser() == $this->getUser()) {
                $em->remove($address);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Adresse bien supprimée');

                return $this->redirect($this->generateUrl('dywee_address_user_table'));
            } else throw new AccessDeniedException('Vous ne pouvez pas modifier cette addresse');
        } else throw $this->createNotFoundException('Cette adresse n\'existe plus');
    }
}
