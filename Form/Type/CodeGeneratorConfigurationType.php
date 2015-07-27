<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use IDCI\Bundle\CodeGeneratorBundle\Form\GenerationConfigurationType;

class CodeGeneratorConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', 'integer')
            ->add('configuration', 'code_generation_configuration')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'code_generator_configuration';
    }
}