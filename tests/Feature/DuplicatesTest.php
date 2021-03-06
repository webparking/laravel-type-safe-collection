<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DuplicatesTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
            new User(),
        ]);

        if (!method_exists($collection, 'duplicates')) {
            $this->assertTrue(true);

            return;
        }

        $result = $collection->duplicates();

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
