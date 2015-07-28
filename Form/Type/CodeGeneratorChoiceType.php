<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\Options;
use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorRegistryInterface;

class CodeGeneratorChoiceType extends AbstractType
{
    /**
     * @var CodeGeneratorRegistryInterface
     */
    protected $registry;

    /**
     * Constructor.
     *
     * @param CodeGeneratorRegistryInterface $registry
     */
    public function __construct(CodeGeneratorRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choices = array();

        foreach ($this->registry->getCodeGenerators() as $alias => $generator) {
            $choices[$alias] = $alias;
        }

        $resolver->setDefaults(array('choices' => $choices));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'code_generator_choice';
    }
}
