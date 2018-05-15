<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 15/05/18
 * Time: 8:59
 */

namespace Pccomponentes\BddApiIOContext\Infrastructure\Mink;

use Behat\Gherkin\Node\PyStringNode;
use Symfony\Component\DomCrawler\Crawler;

class MinkSessionRequestAdapter
{
    private $minkIOAdapter;

    public function __construct(MinkSessionAdapter $minkIOAdapter)
    {
        $this->minkIOAdapter = $minkIOAdapter;
    }

    public function sendRequestWithPyStringNode(string $method, string $url, PyStringNode $body)
    {
        $this->request($method, $url, ['content' => $body->getRaw()]);
    }

    public function sendRequest($method, $url, array $optionalParams = [])
    {
        $this->request($method, $url, $optionalParams);
    }

    public function request(string $method, string $url, array $optionalParams = []): Crawler
    {
        return $this->minkIOAdapter->sendRequest($method, $url, $optionalParams);
    }
}
