<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Doctrine\ORM\Loader;

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\EntityRepository;

use Xidea\Component\Person\Loader\PersonLoaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PersonLoader implements PersonLoaderInterface
{
    /*
     * @var EntityRepository
     */
    protected $personRepository;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(EntityRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->personRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->personRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->personRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->personRepository->findOneBy($criteria, $orderBy);
    }
}
