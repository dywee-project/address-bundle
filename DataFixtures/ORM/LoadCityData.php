<?php

namespace Dywee\AddressBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dywee\AddressBundle\Entity\City;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadCityData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $cityList = $this->loadJson('zipcode-belgium.json');

        $references = array();

        foreach($cityList as $rawCity)
        {
            $city = new City();
            $city->setName($rawCity->city);
            $city->setZip($rawCity->zip);
            $city->setLatitude($rawCity->lat);
            $city->setLongitude($rawCity->lng);
            $city->setCountry($this->getReference('country-be'));

            $references[$city->getZip()][] = $city;

            $manager->persist($city);
        }

        $manager->flush();

        foreach($references as $key => $reference)
        {
            if(count($references[$key]) > 1) {
                $this->addReference('city-' . $reference[0]->getZip(), $reference[0]);
                foreach ($references[$key] as $name => $city)
                    $this->addReference('city-' . $city->getZip() . '-' . strtolower($city->getName()), $city);
            }
            else $this->addReference('city-'.$reference[0]->getZip(), $reference[0]);
        }
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }

    public function loadJson($fileName)
    {
        $kernel = $this->container->get('kernel');
        $path = $kernel->locateResource('@DyweeAddressBundle/Resources/public/json/'.$fileName);
        $json = file_get_contents($path);

        return json_decode($json);
    }
}