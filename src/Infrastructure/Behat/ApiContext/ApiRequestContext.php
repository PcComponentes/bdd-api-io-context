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
    /**
     * @When I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
    {
        $this->requestAdapter()->sendRequestWithPyStringNode($method, $url, $body);
    }

    /**
     * @When I send a :method request to :url
     */
    public function iSendARequestTo($method, $url)
    {
        $this->requestAdapter()->sendRequest($method, $this->locatePath($url));
    }
}
