<?php

namespace Webparking\TypeSafeCollection\Tests\Feature;

use Webparking\TypeSafeCollection\Tests\Data\User;
use Webparking\TypeSafeCollection\Tests\Data\UserCollection;
use Webparking\TypeSafeCollection\Tests\TestCase;

class PushTest extends TestCase
{
    public function testCorrect(): void
    {
        $result = (new UserCollection())->push(new User());

        $this->assertInstanceOf(UserCollection::class, $result);
    }
}
