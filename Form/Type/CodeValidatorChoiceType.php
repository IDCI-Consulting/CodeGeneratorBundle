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
use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorRegistryInterface;

class CodeValidatorChoiceType extends AbstractType
{
    /**
     * @var CodeValidatorRegistryInterface
     */
    protected $registry;

    /**
     * Constructor.
     *
     * @param CodeValidatorRegistryInterface $registry
     */
    public function __construct(CodeValidatorRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choices = array();

        foreach ($this->registry->getCodeValidators() as $alias => $validator) {
            $choices[$alias] = $alias;
        }

        $resolver
            ->setDefaults(array(
                'choices'    => $choices,
                'empty_data' => 'none'
            ));
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
        return 'code_validator_choice';
    }
}
