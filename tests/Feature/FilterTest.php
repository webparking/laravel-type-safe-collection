<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class FilterTest extends TestCase
{
    public function testCorrect(): void
    {
        $collection = new UserCollection([
            'test' => new User(),
        ]);

        $result = $collection->filter(function (User $user) {
            return true;
        });

        $this->assertInstanceOf(Usercollection::class, $result);
    }
}
