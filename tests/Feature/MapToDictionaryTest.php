<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MapToDictionaryTest extends TestCase
{
    public function testCorrect(): void
    {
        if (!method_exists(Collection::class, 'mapToDictionary')) {
            $this->assertTrue(true);

            return;
        }

        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->mapToDictionary(function (User $user, $index) {
            return ['index-' . $index => $user];
        });

        $this->assertInstanceOf(Collection::class, $result);
    }
}
