<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenerationConfigurationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minLength', 'integer')
            ->add('maxLength', 'integer')
            ->add('lowerCase', 'checkbox')
            ->add('upperCase', 'checkbox')
            ->add('digits', 'checkbox')
            ->add('punctuation', 'checkbox')
            ->add('brackets', 'checkbox')
            ->add('space', 'checkbox')
            ->add('specialCharacters', 'text')
            ->add('extraCharacters', 'text')
            ->add('excludedCharacters', 'text')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'idci_code_generator_generation_configuration';
    }
}