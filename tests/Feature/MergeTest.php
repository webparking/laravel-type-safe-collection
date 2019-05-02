<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MergeTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([]);

        $result = $collection->merge([
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

        $collection->merge([
            new Comment(),
        ]);
    }
}
