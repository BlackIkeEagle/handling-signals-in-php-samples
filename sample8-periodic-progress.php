<?php

declare(ticks = 1);

pcntl_signal(SIGALRM, 'progresshandler');
pcntl_alarm(5); // SIGALRM after 5 seconds

function progresshandler($signal)
{
    // get variables from global scope
    global $start, $total, $current;
    $pct = (($current - $start) / ($total - $start)) * 100;
    echo "Progress: " . $pct . "%" . PHP_EOL;
    pcntl_alarm(5); // we want it every 5 seconds so set again
    return;
}

$pid = getmypid();
echo $pid . PHP_EOL;

$start = 0;
$total = 100;
$current;

for ($current = $start; $current < $total; ++$current) {
    sleep(1); // NOTE: when a signal arrives this sleep is interupted!
}
