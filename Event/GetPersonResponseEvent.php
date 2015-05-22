<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Event;

use Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

use Xidea\Component\Person\Model\PersonInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class GetPersonResponseEvent extends PersonEvent
{

    private $response;
    
    public function __construct(PersonInterface $person, Request $request)
    {
        parent::__construct($person, $request);
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response|null
     */
    public function getResponse()
    {
        return $this->response;
    }

}
