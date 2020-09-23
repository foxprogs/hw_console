<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MountNotationCommand extends Command
{
    protected static $defaultName = 'mount';

    protected function configure()
    {
        $this
            ->setDescription('Make mOuNt notation.')
            ->setHelp('This command lets you create a string in mOuNt notation')
            ->addArgument('string', InputArgument::REQUIRED, 'string to convert')
            ->addOption(
                'odd',
                'o',
                InputOption::VALUE_OPTIONAL,
                'convert odd characters',
                true
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = '';
        $shift = $input->getOption('odd') ? 1 : 0;
        foreach (mb_str_split($input->getArgument('string')) as $index => $char) {
            if (1 == ($index + $shift) % 2) {
                $result .= mb_strtoupper($char);
            } else {
                $result .= mb_strtolower($char);
            }
        }
        $output->writeln($result);

        return Command::SUCCESS;
    }
}
