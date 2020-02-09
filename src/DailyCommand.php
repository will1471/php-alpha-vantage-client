<?php

namespace Will1471\AlphaVantage;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DailyCommand extends Command
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function configure(): void
    {
        $this->setName('av:daily')
            ->addArgument('symbol', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $symbol = $input->getArgument('symbol');
        if (!is_string($symbol) || empty($symbol)) {
            throw new \InvalidArgumentException('symbol should be non-empty string');
        }

        $table = new Table($output);
        $table->setHeaders([
            'Date',
            'Open',
            'High',
            'Low',
            'Close',
            'Adjusted Close',
            'Volume',
            'Dividend Amount',
            'Split Coefficient'
        ]);

        $rows = [];
        foreach ($this->client->timeSeriesDailyAdjusted($symbol, true) as $r) {
            $rows[] = [
                $r->datetime(),
                $r->open(),
                $r->high(),
                $r->low(),
                $r->close(),
                $r->adjustedClose(),
                $r->volume(),
                $r->dividendAmount(),
                $r->splitCoefficient(),
            ];
        }
        $table->setRows($rows);
        $table->render();
        return 0;
    }
}
