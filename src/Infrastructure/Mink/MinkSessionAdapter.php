<?php

namespace Pccomponentes\BddApiIOContext\Infrastructure\Mink;

use Behat\Mink\Session;
use Behat\Symfony2Extension\Driver\KernelDriver;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;

final class MinkSessionAdapter
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function sendRequest($method, $url, array $optionalParams = []): Crawler
    {
        $defaultOptionalParams = [
            'parameters' => [],
            'server' => ['HTTP_ACCEPT' => 'application/json', 'CONTENT_TYPE' => 'application/json'],
            'content' => null
        ];

        $optionalParams = array_merge($defaultOptionalParams, $optionalParams);

        $crawler = $this->getClient()->request(
            $method,
            $url,
            $optionalParams['parameters'],
            [],
            $optionalParams['server'],
            $optionalParams['content']
        );

        $this->resetRequestStuff();

        return $crawler;
    }

    private function getClient(): Client
    {
        return $this->getDriver()->getClient();
    }

    private function getDriver(): KernelDriver
    {
        return $this->session->getDriver();
    }

    private function resetRequestStuff()
    {
        $this->session->reset();
        $this->getClient()->setServerParameters([]);
    }

    public function getResponse(): string
    {
        return $this->session->getPage()->getContent();
    }
}
