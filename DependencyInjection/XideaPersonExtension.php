<?php

namespace Xidea\Bundle\PersonBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaPersonExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        list($config, $loader) = $this->setUp($configs, new Configuration($this->getAlias()), $container);

        $loader->load('person.yml');
        $loader->load('person_orm.yml');
        $loader->load('person_controller.yml');
        $loader->load('person_form.yml');

        $this->loadPersonSection($config['person'], $container, $loader);
    }
    
    protected function loadPersonSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_person.person.class', $config['class']);
        $container->setAlias('xidea_person.person.configuration', $config['configuration']);
        $container->setAlias('xidea_person.person.factory', $config['factory']);
        $container->setAlias('xidea_person.person.manager', $config['manager']);
        $container->setAlias('xidea_person.person.loader', $config['loader']);
        
        if (!empty($config['form'])) {
            $this->loadPersonFormSection($config['form'], $container, $loader);
        }
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'person'), $config['template'], $container, $loader);
        }
    }
    
    protected function loadPersonFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_person.person.form.create.factory', $config['create']['factory']);
        $container->setAlias('xidea_person.person.form.create.handler', $config['create']['handler']);
        
        $container->setParameter('xidea_person.person.form.create.type', $config['create']['type']);
        $container->setParameter('xidea_person.person.form.create.name', $config['create']['name']);
        $container->setParameter('xidea_person.person.form.create.validation_groups', $config['create']['validation_groups']);
    }
    
    protected function getConfigurationDirectory()
    {
        return __DIR__.'/../Resources/config';
    }
}