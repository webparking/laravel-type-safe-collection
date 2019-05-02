<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class DiffAssocUsingTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        $result = $collection->diffAssocUsing([
            'test' => new Comment(),
        ], function ($original, $other) {
            return true;
        });

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
