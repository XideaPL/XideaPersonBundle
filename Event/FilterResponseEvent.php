<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Xidea\Person\PersonInterface;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class FilterResponseEvent extends PersonEvent
{

    private $response;

    public function __construct(PersonInterface $person, Request $request, Response $response)
    {
        parent::__construct($person, $request);
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}
