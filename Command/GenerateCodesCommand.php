<?php

/**
 * @author:  Baptiste BOUCHEREAU <baptiste.bouchereau@idci-consulting.fr>
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\CodeGeneratorBundle\Command;

use IDCI\Bundle\CodeGeneratorBundle\CodeGeneratorManager;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfiguration;
use IDCI\Bundle\CodeGeneratorBundle\Model\GenerationConfigurationIncludedCharacterSets;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCodesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('idci:generate:codes')
            ->setDescription('Generate unique codes')
            ->addArgument('quantity', InputArgument::REQUIRED, 'How many code do you want to generate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $quantity = $input->getArgument('quantity');

        $configuration = $this->getGenerationConfiguration();
        $configuration->setQuantity($quantity);
        $codeGeneratorManager = $this->getContainer()->get('idci.code_generator_manager');
        $codes = $codeGeneratorManager->generate('code_generator_mtrand', $configuration);

        $output->writeln($codes);
    }

    /**
     * Get the generationConfiguration
     *
     * @return GenerationConfiguration
     */
    private function getGenerationConfiguration()
    {
        $generationConfiguration = new GenerationConfiguration();

        $includedCharacterSets = new GenerationConfigurationIncludedCharacterSets();

        $includedCharacterSets
            ->setUppercase(true)
            ->setLowercase(true)
            ->setDigits(true)
            ->setBrackets(false)
            ->setExtraCharacters(array())
            ->setPunctuation(false)
            ->setSpace(false)
            ->setSpecialCharacters(false)
        ;

        $generationConfiguration
            ->setMinLength(5)
            ->setMaxLength(8)
            ->setQuantity(15000)
            ->setExcludedCharacterSets(array())
            ->setIncludedCharacterSets($includedCharacterSets)
        ;

        return $generationConfiguration;
    }
}