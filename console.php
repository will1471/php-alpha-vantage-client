<?php

require_once __DIR__ . '/vendor/autoload.php';

$client = new \Will1471\AlphaVantage\Client(getenv('AV_KEY'));

$app = new \Symfony\Component\Console\Application();
$app->add(new \Will1471\AlphaVantage\SearchCommand($client));
$app->add(new \Will1471\AlphaVantage\DailyCommand($client));
$app->run();
