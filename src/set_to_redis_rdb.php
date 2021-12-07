<?php

declare(strict_types=1);
declare(ticks = 1);

require_once __DIR__ . '/../vendor/autoload.php';
//require_once __DIR__ . '/listen_signals.php';

$client = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => getenv('REDIS_RDB_HOST'),
    'port'   => getenv('REDIS_RDB_PORT'),
]);

$i = 1;

$start = time();

while ($i < getenv('ITEMS_COUNT')) {
    $client->set("key_{$i}", "value_{$i}");
    $i++;

    if ($shouldTerm ?? false) {
        break;
    }
}

/**
 * 50k - 15 seconds
 * 150k - 43 seconds
 */
$finish = time() - $start;

echo "Write finished {$i} values for {$finish} seconds" . PHP_EOL;

