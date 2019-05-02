<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class EveryTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $result = $collection->every(function (User $user, $key) {
            return true;
        });

        $this->assertIsBool($result);
    }
}
