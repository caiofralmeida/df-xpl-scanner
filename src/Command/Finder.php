<?php

namespace CaioFRAlmeida\DfXplScanner\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use CaioFRAlmeida\DfXplScanner\Finder\Provider as FinderProvider;

class Finder extends Base
{
    /**
     * @var FinderProvider
     */
    protected $finderProvider;

    /**
     * @param  FinderProvider $finderProvider
     * @return null
     */
    public function __construct(FinderProvider $finderProvider)
    {
        $this->finderProvider = $finderProvider;
        parent::__construct();
    }
    /**
     * @return null
     */
    protected function configure()
    {
        $this->setName('finder')
            ->setDescription('Greet someone')
            ->addArgument(
                'term',
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

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this->finderProvider->find($input->getArgument('term'));

        foreach($result as $item) {
            $output->writeln('<info>' . $item->getUrl() . '</info>');
            $output->writeln('');
        }
    }
}
