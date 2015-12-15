<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Tests\Controller;

use Xidea\Bundle\PersonBundle\Tests\Controller\ControllerTestCase;

class ShowControllerTest extends ControllerTestCase
{
    public function testShowAction()
    {
        //$client = $this->logIn();
        $client = $this->createClient();
        $person = $client->getContainer()->get('xidea_person.person.loader')->loadOneBy(array('name'=>'John Doe'));
        
        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('xidea_person_show', array('id'=>$person->getId())));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("John Doe")')->count()
        );
    }
}

