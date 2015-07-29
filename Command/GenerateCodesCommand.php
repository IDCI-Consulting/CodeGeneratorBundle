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
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCodesCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('idci:code-generator:generate')
            ->setDescription('Generate unique codes')
            ->addArgument('quantity', InputArgument::REQUIRED, 'The code quantity to generate')
            ->addOption('generator', 'g', InputOption::VALUE_REQUIRED, 'The generator alias used to the code generation', 'random')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command.

Here is an example to generate 100 codes:
<info>php app/console %command.name% 100</info>

To use a 'custom' generation strategy:
<info>php app/console %command.name% 100 [--generator|-g="custom"]</info>
EOT
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $timeStart = microtime(true);
        $configuration = new GenerationConfiguration();

        $quantity       = $input->getArgument('quantity');
        $generatorAlias = $input->getOption('generator');

        $codes = $this
            ->getContainer()
            ->get('idci_code_generator.manager')
            ->generate($quantity, $configuration, $generatorAlias)
        ;

        $output->writeln($codes);

        $timeEnd = microtime(true);
        $time = $timeEnd - $timeStart;

        $output->writeln(sprintf(
            '<info>Generation done: %d code(s) generated in %0.2f second(s)</info>',
            $quantity,
            $time
        ));
    }
}