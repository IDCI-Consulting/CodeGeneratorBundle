<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenerationConfigurationType extends AbstractType
{
    /**
     * @var array
     */
    private $charsets;

    /**
     * Constructor.
     *
     * @param array $charsets
     */
    public function __construct(array $charsets)
    {
        $this->charsets = $charsets;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minLength', 'integer')
            ->add('maxLength', 'integer')
            ->add('lowercase', 'checkbox', array(
                'label' => sprintf('Lowercase: %s', $this->charsets['lowercase'])
            ))
            ->add('uppercase', 'checkbox', array(
                'label' => sprintf('Uppercase: %s', $this->charsets['uppercase'])
            ))
            ->add('digits', 'checkbox', array(
                'label' => sprintf('Digits: %s', $this->charsets['digits'])
            ))
            ->add('punctuation', 'checkbox', array(
                'label' => sprintf('Punctuation: %s', $this->charsets['punctuation'])
            ))
            ->add('brackets', 'checkbox', array(
                'label' => sprintf('Brackets: %s', $this->charsets['brackets'])
            ))
            ->add('space', 'checkbox')
            ->add('specialCharacters', 'checkbox', array(
                'label' => sprintf('Special characters: %s', $this->charsets['special_characters'])
            ))
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
        return 'code_generation_configuration';
    }
}