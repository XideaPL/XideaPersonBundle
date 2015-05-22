<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Controller\Person;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Xidea\Component\Base\Factory\ModelFactoryInterface;
use Xidea\Component\Person\Manager\PersonManagerInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractCreateController,
    Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface;
use Xidea\Bundle\PersonBundle\PersonEvents,
    Xidea\Bundle\PersonBundle\Event\GetPersonResponseEvent,
    Xidea\Bundle\PersonBundle\Event\FilterPersonResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CreateController extends AbstractCreateController
{
    /*
     * @var ModelFactoryInterface
     */

    protected $personFactory;

    /*
     * @var PersonManagerInterface
     */
    protected $personManager;

    public function __construct(ConfigurationInterface $configuration, ModelFactoryInterface $personFactory, PersonManagerInterface $modelManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration, $modelManager, $formHandler);

        $this->personFactory = $personFactory;
    }

    protected function createModel()
    {
        return $this->personFactory->create();
    }

    protected function onPreCreate($model, Request $request)
    {
        $this->dispatch(PersonEvents::PRE_CREATE, $event = new GetPersonResponseEvent($model, $request));

        return $event->getResponse();
    }

    protected function onCreateSuccess($model, Request $request)
    {
        $this->dispatch(PersonEvents::CREATE_SUCCESS, $event = new GetPersonResponseEvent($model, $request));

        if (null === $response = $event->getResponse()) {
            $response = $this->redirectToRoute('xidea_person_show', array(
                'id' => $model->getId()
            ));
        }

        return $response;
    }

    protected function onCreateCompleted($model, Request $request, Response $response)
    {
        $this->dispatch(PersonEvents::CREATE_COMPLETED, new FilterPersonResponseEvent($model, $request, $response));
    }
}
