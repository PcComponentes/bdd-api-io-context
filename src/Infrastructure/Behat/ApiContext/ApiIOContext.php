<?php

namespace Pccomponentes\BddApiIOContext\Infrastructure\Behat\ApiContext;

use Behat\MinkExtension\Context\RawMinkContext;
use Pccomponentes\BddApiIOContext\Infrastructure\Mink\MinkSessionAdapter;
use Pccomponentes\BddApiIOContext\Infrastructure\Mink\MinkSessionRequestAdapter;

abstract class ApiIOContext extends RawMinkContext
{
    private $sessionRequestHelper;

    protected function requestAdapter(): MinkSessionRequestAdapter
    {
        if (null === $this->sessionRequestHelper) {
            $this->sessionRequestHelper = new MinkSessionRequestAdapter(new MinkSessionAdapter($this->getSession()));
        }

        return $this->sessionRequestHelper;
    }
}
