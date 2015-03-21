#!/usr/bin/env php
<?php

declare(ticks = 1);

$_ = $_SERVER['_'];

pcntl_signal(SIGHUP, 'reload');

function reload($signal)
{
    global $_, $argv; 
    pcntl_exec($_, $argv);
}

echo "-- Starting --" . PHP_EOL;

$pid = getmypid();
echo $pid . PHP_EOL;

// keep on running so we can actually send a signal ;)
while (true) {
}
