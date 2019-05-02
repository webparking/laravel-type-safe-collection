<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DiffKeysTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        $result = $collection->diffKeys([
            'test',
        ]);

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
