<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Controller\Person;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Component\Person\Loader\PersonLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractListController;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ListController extends AbstractListController
{
    /*
     * @var PersonLoaderInterface
     */
    protected $personLoader;

    public function __construct(ConfigurationInterface $configuration, PersonLoaderInterface $personLoader)
    {
        parent::__construct($configuration);
        
        $this->personLoader = $personLoader;
        $this->listTemplate = 'person_list';
    }
    
    protected function loadModels(Request $request)
    {
        return $this->personLoader->loadAll();
    }
    
    protected function onPreList($models, Request $request)
    {
        return;
    }
}
