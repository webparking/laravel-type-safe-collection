<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Support\Collection;
use Webparking\TypeSafeCollection\Tests\Data\Comment;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class MapIntoTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection([]))->mapInto(Comment::class);

        $this->assertInstanceOf(Collection::class, $result);
    }
}
