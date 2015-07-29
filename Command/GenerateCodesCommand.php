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
            ->addOption('configuration', 'c', InputOption::VALUE_REQUIRED, 'The generation configuration', null)
            ->addOption('generator', 'g', InputOption::VALUE_REQUIRED, 'The generator alias used to the code generation', 'random')
            ->addOption('validators', 'd', InputOption::VALUE_REQUIRED, 'The validators to used during code generation', null)
            ->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'The output file path', null)
            ->setHelp(<<<EOT
The <info>%command.name%</info> command.

Here is an example to generate 100 codes:
<info>php app/console %command.name% 100</info>

Here is a complete example with a custom generation configuration to generate 1000 codes:
<info>php app/console %command.name% --configuration|-c '{"minLength":6, "maxLength":8, "lowercase":true, "uppercase":false, "digits":false, "punctuation":false, "brackets":false, "space":false, "excludedCharacters":"oO0uUvV"}' 1000</info>

To use a 'custom' generation strategy:
<info>php app/console %command.name% 100 --generator|-g 'custom'</info>

To use 'custom' validators strategies:
<info>php app/console %command.name% 100 --validators|-d '{"validatorAlias":{"opt1": "x", "opt2": "y"}}'</info>

If you wish to store codes in a file:
<info>php app/console %command.name% 100 --output|-o '/path/to/file'</info>
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
        $validators     = null === $input->getOption('validators') ?
            array() :
            json_decode($input->getOption('validators'), true)
        ;

        $this->setupConfiguration($configuration, $input->getOption('configuration'));

        $codes = $this
            ->getContainer()
            ->get('idci_code_generator.manager')
            ->generate($quantity, $configuration, $generatorAlias, $validators)
        ;

        $timeEnd = microtime(true);
        $time = $timeEnd - $timeStart;

        $output->writeln(sprintf(
            '<info>Generation done: %d code(s) generated in %0.2f second(s)</info>',
            $quantity,
            $time
        ));

        if (null === $input->getOption('output')) {
            return 0;
        }

        $filepath = $input->getOption('output');
        if (!$handle = fopen($filepath, 'a')) {
            $output->writeln(sprintf(
                '<error>Could not open the file: %s</error>',
                $filepath
            ));

            return 1;
        }

        foreach ($codes as $code) {
            if (fwrite($handle, $code."\n") === FALSE) {
                $output->writeln(sprintf(
                    '<error>Could not write into the file: %s</error>',
                    $filepath
                ));
            }
        }

        fclose($handle);

        $output->writeln(sprintf('<info>Codes writes in %s</info>', $filepath));
    }

    /**
     * Setup the configuration
     *
     * @param GenerationConfiguration $configuration
     * @param string                  $options
     */
    protected function setupConfiguration(GenerationConfiguration $configuration, $options)
    {
        if (null === $options) {
            return false;
        }

        $reflector = new \ReflectionClass($configuration);
        foreach (json_decode($options, true) as $key => $value) {
            $setter = sprintf("set%s", ucfirst($key));
            if ($reflector->hasMethod($setter)) {
                call_user_func(
                    array($configuration, $setter),
                    $value
                );
            }
        }
    }
}