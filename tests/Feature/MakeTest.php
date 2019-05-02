<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MakeTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = UserCollection::make([
            new User(),
        ]);

        $this->assertInstanceOf(UserCollection::class, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrect(): void
    {
        UserCollection::make([
            new Comment(),
        ]);
    }
}
