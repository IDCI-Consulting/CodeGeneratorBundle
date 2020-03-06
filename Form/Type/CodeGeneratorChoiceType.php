<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use IDCI\Bundle\CodeGeneratorBundle\Generation\CodeGeneratorRegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
        return Types\ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'code_generator_choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
