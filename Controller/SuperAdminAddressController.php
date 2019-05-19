<?php

namespace Dywee\AddressBundle\Controller;

use Dywee\AddressBundle\Entity\Address;
use Dywee\AddressBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SuperAdminAddressController extends Controller
{
    public function addAction(Request $request)
    {
        $address = new Address();
        $form = $this->get('form.factory')->createBuilder(AddressType::class, $address)
            ->add('valider', SubmitType::class)
            ->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $request->getSession()->getFlashBag()->set('success', 'Adresse correctement modifiée');
            return $this->redirect($this->generateUrl('superAdmin_address_table'));
        }
        return $this->render('DyweeAddressBundle:SuperAdmin:edit.html.twig', array('form' => $form->createView()));
    }

    public function updateAction(Address $address, Request $request)
    {
        $form = $this->get('form.factory')->createBuilder(AddressType::class, $address)->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $request->getSession()->getFlashBag()->set('success', 'Adresse correctement modifiée');
            return $this->redirect($this->generateUrl('superAdmin_address_table'));
        }
        return $this->render('DyweeAddressBundle:SuperAdmin:edit.html.twig', array('form' => $form->createView()));
    }

    public function removeAction(Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Adresse correctement supprimée');

        return $this->redirect($this->generateUrl('superAdmin_address_table'));
    }

    public function tableAction($display = 'normal')
    {
        $datatable = $this->get('address_bundle.datatable.address');
        $datatable->buildDatatable();

        return $this->render('AddressBundle:SuperAdmin:dataTable.html.twig', array(
            'datatable' => $datatable,
        ));

        //return $this->render('AddressBundle:SuperAdmin:table.html.twig', array('addressList' => $addressList));
    }

    public function jsonAction(Address $address = null)
    {
        if ($address) {
            $response = array(
                'name' => $address->getName(),
                'id' => $address->getId(),
                'box' => $address->getBox(),
                'city' => $address->getCity() ? $address->getCity()->getZipName() : 'null',
                'company' => $address->getCompany(),
                'line1' => $address->getLine1(),
                'line2' => $address->getLine2(),
                'number' => $address->getNumber(),
            );
            return new Response(json_encode($response));
        } else {
            $addressList = $this->getDoctrine()->getManager()->getRepository('AddressBundle:Address')->findAll();
            $response = array();
            foreach ($addressList as $address) {
                $response[] = array(
                    'name' => $address->getName(),
                    'id' => $address->getId(),
                    'box' => $address->getBox(),
                    'city' => $address->getCity() ? $address->getCity()->getZipName() : 'null',
                    'company' => $address->getCompany(),
                    'line1' => $address->getLine1(),
                    'line2' => $address->getLine2(),
                    'number' => $address->getNumber(),
                );
            }
            return new Response(json_encode($response));
        }
    }

    public function jsonformAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) { // pour vérifier la présence d'une requete Ajax
            $address = new Address();
            $form = $this->get('form.factory')->createBuilder(AddressType::class, $address)->remove('valider')->getForm();

            if ($form->handleRequest($request)->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($address);
                $em->flush();

                $response = array(
                    'name' => $address->getName(),
                    'id' => $address->getId(),
                    'box' => $address->getBox(),
                    'city' => $address->getCity()->getZipName(),
                    'company' => $address->getCompany(),
                    'line1' => $address->getLine1(),
                    'number' => $address->getNumber(),
                    'line2' => $address->getLine2(),
                );

                return new Response(json_encode($response));
            }
            return new Response(json_encode($this->renderView('AddressBundle:SuperAdmin:form.html.twig', array('form' => $form->createView()))));
        }
        return new Response('Ajax Only');
    }

    /* DATATABLE BUNDLE */

    public function indexResultsAction()
    {
        $datatable = $this->get('address_bundle.datatable.address');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);



        return $query->getResponse();

        /*$datatable = $this->get('address_bundle.datatable.address');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);
        $query->buildQuery();
        $qb = $query->getQuery();
        dump($qb->getDQL());
        die();*/
    }

    /* /DATATABLE BUNDLE */
}
