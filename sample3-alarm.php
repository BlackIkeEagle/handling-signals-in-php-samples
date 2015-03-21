<?php

declare(ticks = 1);

pcntl_signal(SIGALRM, 'alarmhandler');
pcntl_alarm(5); // SIGALRM after 5 seconds

function alarmhandler($signal)
{
    echo "Alarm !" . PHP_EOL;
    echo "Periodic progress output ?" . PHP_EOL;
    pcntl_alarm(5); // we want it every 5 seconds so set again
    return;
}

// keep on running so we can actually send a signal ;)
while (true) {
}
