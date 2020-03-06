<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;

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
            ->add('minLength', Types\IntegerType::class)
            ->add('maxLength', Types\IntegerType::class)
            ->add('lowercase', Types\CheckboxType::class, array(
                'label' => sprintf('Lowercase: %s', $this->charsets['lowercase'])
            ))
            ->add('uppercase', Types\CheckboxType::class, array(
                'label' => sprintf('Uppercase: %s', $this->charsets['uppercase'])
            ))
            ->add('digits', Types\CheckboxType::class, array(
                'label' => sprintf('Digits: %s', $this->charsets['digits'])
            ))
            ->add('punctuation', 'checkbox', array(
                'label' => sprintf('Punctuation: %s', $this->charsets['punctuation'])
            ))
            ->add('brackets', Types\CheckboxType::class, array(
                'label' => sprintf('Brackets: %s', $this->charsets['brackets'])
            ))
            ->add('space', Types\CheckboxType::class)
            ->add('specialCharacters', Types\CheckboxType::class, array(
                'label' => sprintf('Special characters: %s', $this->charsets['special_characters'])
            ))
            ->add('extraCharacters', Types\TextType::class)
            ->add('excludedCharacters', Types\TextType::class)
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
    public function getBlockPrefix()
    {
        return 'code_generation_configuration';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
