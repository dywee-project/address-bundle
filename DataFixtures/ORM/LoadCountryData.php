<?php

namespace Dywee\AddressBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dywee\AddressBundle\Entity\Country;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCountryData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $countryList = $this->loadJson('countries.json');

        foreach($countryList as $countryToAdd)
        {
            $country = new Country();
            $country->setName($countryToAdd->name->common);
            $country->setIso($countryToAdd->cca2);
            $country->setVatRate(null);
            $country->setPhonePrefix(intval($countryToAdd->callingCode));

            $manager->persist($country);
            $this->addReference('country-'.strtolower($country->getIso()), $country);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }

    public function loadJson($fileName)
    {
        $kernel = $this->container->get('kernel');
        $path = $kernel->locateResource('@DyweeAddressBundle/Resources/public/json/'.$fileName);
        $json = file_get_contents($path);

        return json_decode($json);
    }
}