<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DiffUsingTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            new User(),
        ]);

        if (!method_exists($collection, 'diffUsing')) {
            $this->assertTrue(true);

            return;
        }

        $result = $collection->diffUsing([
            new Comment(),
        ], function ($original, $other) {
            return true;
        });

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
