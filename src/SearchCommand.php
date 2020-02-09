<?php

namespace Will1471\AlphaVantage;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SearchCommand extends Command
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
        $this->setName('av:search')
            ->addArgument('query', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $query = $input->getArgument('query');
        if (!is_string($query) || empty($query)) {
            throw new \InvalidArgumentException('query should be non-empty string');
        }
        foreach ($this->client->search($query) as $r) {
            echo "{$r->symbol()} - {$r->name()} - {$r->type()}\n";
        }
        return 0;
    }
}
