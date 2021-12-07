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
    $client->multi();
    $client->get("key_{$i}");
    $client->del("key_{$i}");
    $client->exec();

    $i++;

    if ($shouldTerm ?? false) {
        break;
    }
}

/**
 * 50k - 63 seconds
 * 150k - 178 seconds
 */
$finish = time() - $start;

echo "Read finished {$i} values for {$finish} seconds" . PHP_EOL;

