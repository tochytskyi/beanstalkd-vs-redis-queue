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

$i = 1;

$start = time();

while ($i < (getenv('QUEUE_ITEMS_COUNT') ?? 1)) {
    $pheanstalk->useTube('tasks');
    $pheanstalk->put("value_{$i}");

    $i++;

    if ($shouldTerm ?? false) {
        echo "App terminated" . PHP_EOL;
        break;
    }
}

$finish = time() - $start;

echo "Write finished {$i} values for {$finish} seconds" . PHP_EOL;

print_r($pheanstalk->statsTube('tasks'));

