<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 15/05/18
 * Time: 9:01
 */

namespace Pccomponentes\BddApiIOContext\Infrastructure\Behat\ApiContext;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;

class ApiRequestContext extends ApiIOContext implements Context
{
    private $optionalParams = [];

    /**
     * @When I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
    {
        $this->addHeaderParameter('content', $body->getRaw());
        $this->requestAdapter()->sendRequestWithPyStringNode($method, $url, $this->optionalParams);
        $this->clearParams();
    }

    /**
     * @When I send a :method request to :url
     */
    public function iSendARequestTo($method, $url)
    {
        $this->requestAdapter()->sendRequest($method, $this->locatePath($url), $this->optionalParams);
        $this->clearParams();
    }

    protected function addHeaderParameter($name, $value)
    {
        $this->optionalParams[$name] = $value;
    }

    private function clearParams()
    {
        $this->optionalParams = [];
    }
}
