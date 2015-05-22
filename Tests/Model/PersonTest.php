<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Tests\Model;

use Xidea\Bundle\PersonBundle\Tests\Fixtures\Model\Person;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class PersontTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $person = $this->createPerson();
        $this->assertNull($person->getName());
        
        $name = 'Person 1';
        
        $person->setName($name);
        $this->assertEquals($name, $person->getName());
    }
    
    protected function createPerson()
    {
        return new Person();
    }
}
