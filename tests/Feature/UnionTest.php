<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class UnionTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([]);

        $result = $collection->union([
            new User(),
        ]);

        $this->assertInstanceOf(UserCollection::class, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrect(): void
    {
        $collection = new UserCollection([]);

        $collection->union([
            new Comment(),
        ]);
    }
}
