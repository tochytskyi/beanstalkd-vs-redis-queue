<?php

$shouldTerm = false;

function sig_handler($signo)
{
    global $shouldTerm;

    echo "received {$signo}" . PHP_EOL;

    switch ($signo) {
        case SIGTERM:
        case SIGINT:
            $shouldTerm = true;
            break;
        case SIGHUP:
            //restart
            break;
        default:
    }
}

pcntl_signal(SIGTERM, "sig_handler");
pcntl_signal(SIGINT, "sig_handler");
pcntl_signal(SIGHUP, "sig_handler");