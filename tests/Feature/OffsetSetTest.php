<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class OffsetSetTest extends TestCase
{
    /**
     * @doesNotPerformAssertions
     */
    public function testCorrect(): void
    {
        (new UserCollection([
            new User(),
        ]))->offsetSet(0, new User());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrect(): void
    {
        (new UserCollection([
            new User(),
        ]))->offsetSet(0, new Comment());
    }
}
