<?php

namespace SigSample\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SimpleCommand extends Command
{
    protected function configure()
    {
        $this->setName('simple')
            ->setDescription('Simple Command, will catch SIGTERM signal.')
            ->setHelp('Simple');
        return;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        declare(ticks = 1);
        pcntl_signal(SIGINT, [$this, 'signalHandler']);

        $output->writeln('Simple:');

        while (true) {
        }

        return;
    }

    protected function signalHandler($signal)
    {
        echo 'Caught signal ' . $signal . PHP_EOL;
        return;
    }
}
