<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Doctrine\ORM\Repository;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface PersonRepositoryInterface
{
    /*
     * @param int $id
     * 
     * @return \Xidea\Person\Model\PersonInterface
     */
    function find($id);
    
    /*
     * @return array
     */
    function findAll();
    
    /**
     * 
     * @param array $criteria
     * @param array $orderBy
     * @param int $limit
     * @param int $offset
     */
    function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);
    
    /**
     * 
     * @param array $criteria
     * @param array $orderBy
     */
    function findOneBy(array $criteria, array $orderBy = array());
    
    /*
     * @return \Doctrine\ORM\QueryBuilder
     */
    function findQb();
}
