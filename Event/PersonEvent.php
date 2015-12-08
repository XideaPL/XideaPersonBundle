<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Xidea\Person\PersonInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PersonEvent extends Event
{

    /**
     * @var PersonInterface
     */
    protected $person;
    
    /**
     * @var Request
     */
    protected $request;

    /**
     * Constructs an event.
     *
     * @param PersonInterface $person The person
     */
    public function __construct(PersonInterface $person, Request $request = null)
    {
        $this->person = $person;
        $this->request = $request;
    }

    /**
     * @return PersonInterface
     */
    public function getPerson()
    {
        return $this->person;
    }
    
    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
