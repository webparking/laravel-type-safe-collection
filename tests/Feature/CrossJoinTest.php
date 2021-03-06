<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class CrossJoinTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        $result = $collection->crossJoin([
            new Comment(),
        ]);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
