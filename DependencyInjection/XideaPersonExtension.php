<?php

namespace Xidea\Bundle\PersonBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Xidea\Bundle\BaseBundle\DependencyInjection\Helper\ExtensionHelper;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaPersonExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($this->getAlias());
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        $loader->load('person.yml');
        $loader->load('person_orm.yml');
        
        $this->loadPersonSection($config['person'], $container, $loader);
        
        $helper = new ExtensionHelper($this->getAlias());
        $helper->loadTemplateSection($config, $this->getDefaultTemplates(), $container, $loader);
    }
    
    protected function loadPersonSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_person.person.code', $config['code']);
        $container->setParameter('xidea_person.person.class', $config['class']);
        $container->setAlias('xidea_person.person.configuration', $config['configuration']);
        $container->setAlias('xidea_person.person.factory', $config['factory']);
        $container->setAlias('xidea_person.person.manager', $config['manager']);
        $container->setAlias('xidea_person.person.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadPersonFormSection($config['form'], $container, $loader);
        }
    }
    
    protected function loadPersonFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_person.person.form.factory', $config['person']['factory']);
        $container->setAlias('xidea_person.person.form.handler', $config['person']['handler']);
        
        $container->setParameter('xidea_person.person.form.type', $config['person']['type']);
        $container->setParameter('xidea_person.person.form.name', $config['person']['name']);
        $container->setParameter('xidea_person.person.form.validation_groups', $config['person']['validation_groups']);
    }

    protected function getDefaultTemplates()
    {
        return [
            'person_main' => ['path' => '@XideaPerson/main'],
            'person_list' => ['path' => '@XideaPerson/Person/List/list'],
            'person_show' => ['path' => '@XideaPerson/Person/Show/show'],
            'person_create' => ['path' => '@XideaPerson/Person/Create/create'],
            'person_form' => ['path' => '@XideaPerson/Person/Form/form'],
            'person_form_fields' => ['path' => '@XideaPerson/Person/Form/fields']
        ];
    }
}