<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class AddTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection())->add(new User());

        $this->assertInstanceOf(UserCollection::class, $result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrect(): void
    {
        (new UserCollection())->add(new Comment());
    }
}
