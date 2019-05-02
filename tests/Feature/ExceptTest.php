<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class ExceptTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        $result = $collection->except([
            'test',
        ]);

        $this->assertInstanceOf(Usercollection::class, $result);
    }
}
