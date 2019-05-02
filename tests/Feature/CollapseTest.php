<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class CollapseTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        $this->assertInstanceOf(UserCollection::class, $collection->collapse());
    }
}
