<?php

namespace CaioFRAlmeida\DfXplScanner\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Finder extends Base
{
    protected function configure()
    {
        $this->setName('finder')
            ->setDescription('Greet someone')
            ->addArgument(
                'dork',
                InputArgument::REQUIRED,
                'Expressão a ser buscada'
            )
            ->addOption(
               'limit',
               getenv('RESULTS'),
               InputOption::VALUE_OPTIONAL,
               'Quantidade de resultados'
           )
           ->addOption(
              'output',
              getenv('OUTPUT'),
              InputOption::VALUE_OPTIONAL,
              'Quantidade de resultados'
          );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('jamal');
    }
}
