<?php

declare(ticks = 1);

pcntl_sigprocmask(SIG_BLOCK, array(SIGINT));

pcntl_signal(SIGINT, 'signalhandler');
pcntl_signal(SIGTERM, 'signalhandler');

function signalhandler($signal)
{
    echo 'Caught signal ' . $signal . PHP_EOL;
    return;
}

$pid = getmypid();
echo $pid . PHP_EOL;

// keep on running so we can actually send a signal ;)
while (true) {
}
