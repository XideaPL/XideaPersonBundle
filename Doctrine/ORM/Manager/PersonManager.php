<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Doctrine\ORM\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManager;
use Xidea\Component\Base\Doctrine\ORM\Manager\ModelManagerInterface;
use Xidea\Person\ManagerInterface;
use Xidea\Person\PersonInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PersonManager implements ModelManagerInterface, ManagerInterface
{
    /*
     * @var bool
     */
    protected $flushMode;
    
    /*
     * @var EntityManager
     */
    protected $entityManager;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructs a person manager.
     *
     * @param EntityManager The entity manager
     */
    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        
        $this->setFlushMode(true);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFlushMode($flushMode = true)
    {
        $this->flushMode = $flushMode;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isFlushMode()
    {
        return $this->flushMode;
    }

    /**
     * {@inheritdoc}
     */
    public function save(PersonInterface $person)
    {
        $this->entityManager->persist($person);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $person->getId();
    }
    
    public function update(PersonInterface $person)
    {  
        $this->entityManager->persist($person);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $person->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(PersonInterface $person)
    {
        $this->entityManager->remove($person);
    }
    
    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->entityManager->clear();
    }
}
