<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DiffKeysUsingTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        if (!method_exists($collection, 'diffKeysUsing')) {
            $this->assertTrue(true);

            return;
        }

        $result = $collection->diffKeysUsing([
            'test',
        ], function ($key1, $key2) {
            return true;
        });

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
