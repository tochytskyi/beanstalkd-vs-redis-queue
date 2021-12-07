<?php

$shouldTerm = false;

function sig_handler($signo)
{
    global $sigTerm;

     switch ($signo) {
         case SIGTERM:
             $shouldTerm = true;
             break;
         case SIGHUP:
             //restart
             break;
         default:
     }
}

//pcntl_signal(SIGTERM, "sig_handler");
//pcntl_signal(SIGHUP,  "sig_handler");