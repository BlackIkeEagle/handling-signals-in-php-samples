<?php

pcntl_signal(SIGINT, 'signalhandler');

function signalhandler($signal)
{
    echo 'Caught signal ' . $signal . PHP_EOL;
    return;
}

// keep on running so we can actually send a signal ;)
while (true) {
    pcntl_signal_dispatch();
}
