<?php

declare(strict_types=1);
declare(ticks = 1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/listen_signals.php';

use Pheanstalk\Pheanstalk;

$pheanstalk = Pheanstalk::create(
    getenv('QUEUE_HOST'),
    (int)getenv('QUEUE_PORT')
);

$pheanstalk->watch('tasks');

$i = 1;

$start = time();

while ($job = $pheanstalk->reserveWithTimeout(2)) {
    $i++;

    $pheanstalk->delete($job);

    if ($shouldTerm ?? false) {
        echo "App terminated" . PHP_EOL;
        break;
    }
}

$finish = time() - $start;

echo "Read finished {$i} values for {$finish} seconds" . PHP_EOL;

print_r($pheanstalk->statsTube('tasks'));

