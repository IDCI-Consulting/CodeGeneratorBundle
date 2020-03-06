<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use IDCI\Bundle\CodeGeneratorBundle\Validation\CodeValidatorRegistryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = array();

        foreach ($this->registry->getCodeValidators() as $alias => $validator) {
            $choices[$alias] = $alias;
        }

        $resolver
            ->setDefaults(array(
                'choices'    => $choices,
                'empty_data' => 'none'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
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
        return 'code_validator_choice';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
