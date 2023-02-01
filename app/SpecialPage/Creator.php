<?php

namespace App\SpecialPage;

use App\Models\Client;
use App\Models\SpecialPage;
use Ramsey\Uuid\Guid\Guid;

class Creator
{
    public function __construct(protected Client $client) {}

    public function createNewSpecialPage(): SpecialPage
    {
        /** @var SpecialPage $specialPage */
        $specialPage = $this->client
            ->specialPage()
            ->create(
                [
                    'hash' => Guid::fromDateTime(now())
                ]
            );

        return $specialPage;
    }
}
