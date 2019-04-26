<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Illuminate\Database\Eloquent\Collection;
use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class ChunkTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection([
            new User(),
            new User(),
        ]))->chunk(1);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertInstanceOf(UserCollection::class, $result->first());
    }
}
