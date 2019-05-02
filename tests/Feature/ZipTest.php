<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class ZipTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->zip([
            new User(),
            new User(),
        ]);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertInstanceOf(UserCollection::class, $result->first());
    }
}
