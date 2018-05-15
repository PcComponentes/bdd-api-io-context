<?php
/**
 * Created by PhpStorm.
 * User: aaron
 * Date: 15/05/18
 * Time: 9:05
 */

namespace Pccomponentes\BddApiIOContext\Infrastructure\Behat\ApiContext;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Pccomponentes\BddApiIOContext\Infrastructure\Mink\MinkSessionAdapter;
use Pccomponentes\BddApiIOContext\Infrastructure\Mink\MinkSessionResponseAdapter;
use PHPUnit\Framework\Assert;

class ApiResponseContext extends ApiIOContext implements Context
{
    private $sessionResponseHelper;
    private $sessionHelper;

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty()
    {
        Assert::assertEmpty(
            $this->getSessionResponseHelper()->getResponse(),
            'Response not empty'
        );
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode)
    {
        Assert::assertSame((int) $expectedResponseCode, $this->getSession()->getStatusCode());
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expected)
    {
        Assert::assertJsonStringEqualsJsonString($expected->getRaw(), $this->getSessionResponseHelper()->getResponse());
    }

    private function getSessionResponseHelper(): MinkSessionResponseAdapter
    {
        return $this->sessionResponseHelper = $this->sessionResponseHelper ?: new MinkSessionResponseAdapter(
            $this->getSessionHelper()
        );
    }

    private function getSessionHelper(): MinkSessionAdapter
    {
        return $this->sessionHelper = $this->sessionHelper ?: new MinkSessionAdapter($this->getSession());
    }
}
