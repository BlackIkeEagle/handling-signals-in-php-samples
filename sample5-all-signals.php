<?php

declare(ticks = 1);

$signals = [
    SIGHUP => 'SIGHUP',
    SIGINT => 'SIGINT',
    SIGUSR1 => 'SIGUSR1',
    SIGUSR2 => 'SIGUSR2',
    SIGQUIT => 'SIGQUIT',
    SIGILL => 'SIGILL',
    SIGABRT => 'SIGABRT',
    SIGFPE => 'SIGFPE',
    SIGSEGV => 'SIGSEGV',
    SIGPIPE => 'SIGPIPE',
    SIGALRM => 'SIGALRM',
    SIGTERM => 'SIGTERM',
    SIGCHLD => 'SIGCHLD',
    SIGCONT => 'SIGCONT',
    SIGTSTP => 'SIGTSTP',
    SIGTTIN => 'SIGTTIN',
    SIGTTOU => 'SIGTTOU',
];

$pid = getmypid();
echo $pid . PHP_EOL;

echo 'Signals we can handle:' . PHP_EOL;
foreach ($signals as $signal => $signalstring) {
    echo $signalstring . PHP_EOL;
    pcntl_signal($signal, 'signalhandler');

}

function signalhandler($signal)
{
    global $signals;
    echo 'Caught signal ' . $signals[$signal] . PHP_EOL;
    return;
}

$x = 0;
while (true) {
    sleep(1);
    $signalids = array_keys($signals);
    $signalkey = array_rand($signalids);
    $signalsend = $signalids[$signalkey];
    echo 'sending ' . $signals[$signalsend] . PHP_EOL;
    posix_kill($pid, $signalsend);    
    if ($x >= 30) {
        posix_kill($pid, SIGKILL);
    }
    ++$x;
}
