<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Controller\Person;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xidea\Component\Person\Loader\PersonLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractShowController;
use Xidea\Component\Person\Model\PersonInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ShowController extends AbstractShowController
{
    /*
     * @var PersonLoaderInterface
     */
    protected $loader;

    /**
     * 
     * @param ConfigurationInterface $configuration
     * @param PersonLoaderInterface $loader
     */
    public function __construct(ConfigurationInterface $configuration, PersonLoaderInterface $loader)
    {
        parent::__construct($configuration);

        $this->loader = $loader;
        $this->showTemplate = 'person_show';
    }

    /**
     * {@inheritdoc}
     */
    protected function loadModel($id)
    {
        $person = $this->loader->load($id);

        if (!$person instanceof PersonInterface) {
            throw new NotFoundHttpException('person.not_found');
        }

        return $person;
    }

    /**
     * {@inheritdoc}
     */
    protected function onPreShow($model, Request $request)
    {
        return;
    }
}
