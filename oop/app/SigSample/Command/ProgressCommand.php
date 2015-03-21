<?php

namespace SigSample\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ProgressCommand extends Command
{
    protected $pid = null;
    protected $start = 0;
    protected $total = 100;
    protected $current = null;

    protected $input = null;
    protected $output = null;

    protected function configure()
    {
        $this->setName('progress')
            ->setDescription(
                'Progress Command, will show progress using signals.'
            )
            ->setHelp('Progress');
        return;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        declare(ticks = 1);

        pcntl_signal(SIGALRM, [$this, 'progressHandler']);
        pcntl_alarm(5); // SIGALRM after 5 seconds

        $this->pid = getmypid();

        $output->writeln('Progress:');

        $output->writeln('pid: ' . $this->pid);

        for (
            $this->current = $this->start;
            $this->current < $this->total;
            ++$this->current) {
            sleep(1); // NOTE: when a signal arrives this sleep is interupted!
        }

        return;
    }

    protected function progressHandler($signal)
    {
        $pct = (
            ($this->current - $this->start) / ($this->total - $this->start)
        ) * 100;

        if ($this->output instanceof OutputInterface) {
            $this->output->writeln($pct . "%");
        } else {
            echo $pct . "%" . PHP_EOL;
        }

        pcntl_alarm(5); // we want it every 5 seconds so set again
        return;
    }
}
