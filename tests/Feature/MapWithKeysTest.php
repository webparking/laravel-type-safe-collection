<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MapWithKeysTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->mapWithKeys(function (User $user, $index) {
            return ['key-' . $index => $user];
        });

        $this->assertInstanceOf(Collection::class, $result);
    }
}
