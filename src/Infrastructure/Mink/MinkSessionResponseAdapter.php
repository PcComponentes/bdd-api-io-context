<?php

namespace Pccomponentes\BddApiIOContext\Infrastructure\Mink;

class MinkSessionResponseAdapter
{
    private $minkIOAdapter;

    public function __construct(MinkSessionAdapter $minkIOAdapter)
    {
        $this->minkIOAdapter = $minkIOAdapter;
    }

    public function getResponse(): string
    {
        return $this->minkIOAdapter->getResponse();
    }
}
