<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class LoadPersonData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = $this->loadData();

        $personManager = $this->container->get('xidea_person.person.manager');
        
        foreach($data as $person) {
            $personManager->save($person);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
    /**
     * Returns a person factory.
     * 
     * @return \Xidea\Bundle\PersonBundle\Model\PersonFactory The person factory
     */
    protected function getPersonFactory()
    {
        return $this->container->get('xidea_person.person.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $personFactory = $this->getPersonFactory();
        
        $person1 = $personFactory->create();
        $person1->setName('John Doe');
        $this->setReference('person-johndoe', $person1);
        
        $person2 = $personFactory->create();
        $person2->setName('Jane Doe');
        $this->setReference('person-janedoe', $person2);
        
        return array(
            $person1,
            $person2
        );
    }
 
}
