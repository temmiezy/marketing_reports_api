<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class KpOrganicAppsToDbCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('kp-organic-apps-to-db')
            ->setDescription('...')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('argument');

        if ($input->getOption('option')) {
            // ...
        }
        // access the container using getContainer()
        $report = $this->getContainer()->get('app.report_service');
        $report->kpOrganicAppsToDbAction();

        $output->writeln('Data inserted!');
    }

}
