<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MapTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->map(function (User $user) {
            return $user->toArray();
        });

        $this->assertInstanceOf(Collection::class, $result);
    }
}
