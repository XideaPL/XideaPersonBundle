<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\PersonBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of RegistrationType
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class PersonType extends AbstractType
{
    /*
     * var string
     */
    protected $class;

    /**
     * @param string $class The Person class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name', null, array(
                    'label' => 'person.name'
                ))
                ->add('save', 'submit', array('label' => 'person_form.submit'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    public function getName()
    {
        return 'xidea_person';
    }

}
